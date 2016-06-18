<?php

class ProfileController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function viewProfile() {

        //View user profile

        if(empty($_SESSION['user'])) {
            header('Location: index.php?c=dashboard&m=index');
        }

        $data = array();
        $ordersStatus = array();

        $usersCollection = new UserCollection();
        $ordersCollection = new OrdersCollection();

        $username = stripslashes(htmlentities(trim($_GET['username'])));

        $user = $usersCollection->getAll(array('username' => $username));
        $orders = $ordersCollection->getAll(array('customer_username' => $username));


        //Get only the orders with status equal to 'New'
        foreach($orders as $order) {
            if($order->getStatus() == 'New') {
                $ordersStatus[] = $order;
            }
        }

        $data['user'] = $user;
        $data['orders'] = $orders;
        $data['ordersStatus'] = $ordersStatus;

        $this->loadFrontView('profile/profile',$data);
    }

    public function updateProfile() {

        //Update user profile

        if(empty($_SESSION['user'])) {
            header('Location: index.php?c=dashboard&m=index');
        }

        $usersCollection = new UserCollection();
        $user_id = stripslashes(htmlentities(trim($_GET['user_id'])));
        $user = $usersCollection->getAll(array('id' => $user_id));

        $data = array();

        $errors = array();

        $userInput = array(
            'username' => $user[0]->getUsername(),
            'email' => $user[0]->getEmail(),
            'firstname' => $user[0]->getFirstName()
        );

        $fillterArray = array();

        if(isset($_POST['submit'])) {

            $insertInfo = array(
                'username' => (isset($_POST['username']))? $this->cleanSubmitInput($_POST['username']) : '',
                'email' => (isset($_POST['email']))? $this->cleanSubmitInput($_POST['email']) : '',
                'firstname' => (isset($_POST['firstname']))? $this->cleanSubmitInput($_POST['firstname']) : ''
            );

            $fillterArray = $this->cleanFinalInput($insertInfo);
            $errors = $this->validateUserInput($insertInfo);

            if(empty($errors)) {
                $user_id = stripslashes(htmlentities(trim($_GET['user_id'])));

                $usersEntity = new UsersEntity();
                $usersEntity->setId($user_id);
                $usersEntity->setUsername($fillterArray['username']);
                $usersEntity->setPassword($user[0]->getPassword());
                $usersEntity->setEmail($fillterArray['email']);
                $usersEntity->setFirstName($fillterArray['firstname']);
                $usersEntity->setConfirmCode($user[0]->getConfirmCode());
                $usersEntity->setActive($user[0]->getActive());

                $usersCollection = new UserCollection();
                $usersCollection->save($usersEntity);

                unset($_SESSION['user']);
                unset($_SESSION['front_logged_in']);

                header('Location:index.php?c=profile&m=successUpdate');
                exit;
            }
        }

        $data['errors'] = $errors;
        $data['userInput'] = $userInput;
        $this->loadFrontView('profile/updateProfile',$data);
    }

    public function resetPassword() {

        //Delete old password and set a new one

        if(empty($_SESSION['user'])) {
            header('Location: index.php?c=dashboard&m=index');
        }

        $usersCollection = new UserCollection();
        $user_id = stripslashes(htmlentities(trim($_GET['user_id'])));
        $user = $usersCollection->getAll(array('id' => $user_id));

        $data = array();

        $errors = array();

        $fillterArray = array();

        if(isset($_POST['submit'])) {

            $insertInfo = array(

                'password' => (isset($_POST['password']))? $this->cleanSubmitInput($_POST['password']) : '',
                'password_confirm' => (isset($_POST['password_confirm']))? $this->cleanSubmitInput($_POST['password_confirm']) : ''

            );

            //Filter data again using cleanFinalInput()
            $fillterArray = $this->cleanFinalInput($insertInfo);
            $errors = $this->validateUserInput($insertInfo);

            if(empty($errors)) {
                $user_id = stripslashes(htmlentities(trim($_GET['user_id'])));

                $usersEntity = new UsersEntity();
                $usersEntity->setId($user_id);
                $usersEntity->setUsername($user[0]->getUsername());
                $usersEntity->setPassword(sha1($fillterArray['password']));
                $usersEntity->setEmail($user[0]->getEmail());
                $usersEntity->setFirstName($user[0]->getFirstName());
                $usersEntity->setConfirmCode($user[0]->getConfirmCode());
                $usersEntity->setActive($user[0]->getActive());
                $this->sendNewPasswordEmail($fillterArray['password'],$user[0]->getEmail(),$user[0]->getUsername());

                $usersCollection = new UserCollection();
                $usersCollection->save($usersEntity);

                unset($_SESSION['user']);
                unset($_SESSION['front_logged_in']);

                header('Location:index.php?c=profile&m=successPassword');
                exit;
            }
        }

        $data['errors'] = $errors;
        $this->loadFrontView('profile/resetPassword',$data);
    }

    public function deleteProfile() {
        //Delete user profile

        if (!isset($_GET['user_id'])) {
            header('Location: index.php?c=profile&m=viewProfile');
        }

        $usersCollection = new UserCollection();
        $user_id = stripslashes(htmlentities(trim($_GET['user_id'])));
        //Delete user from table users
        $usersCollection->delete($user_id);

        //Unset all session information about the user
        unset($_SESSION['user']);
        unset($_SESSION['front_logged_in']);
        unset($_SESSION['cart_item']);
        unset($_SESSION['item_total']);
        unset($_SESSION['shipping_status']);

        //View to be shown after successful profile delete
        $this->loadFrontView('profile/after_delete_user');

    }

    public function successUpdate() {
         //View to be shown after successful profile update
        $this->loadFrontView('profile/after_update');
    }

    public function successPassword() {
        //View to be shown after successful password reset
        $this->loadFrontView('profile/after_password_reset');
    }

    private function validateUserInput($input)
    {
        $errors = array();

        if ( (empty($input['password'])) || (strlen($input['password']) < 3) || (strlen($input['password']) > 255) ) {
            $errors['password'] = 'Incorrect password! Did you fill in the field!';
        }


        if ( (empty($input['password_confirm'])) ) {
            $errors['password_confirm'] = 'Please re-enter your password !';
        }

        if ( ($input['password']) != ($input['password_confirm']) ) {
            $errors['password_confirm'] = 'Re-entered password does no\'t match original password !';
        }


        return $errors;
    }

    private function cleanFinalInput($input) {
        $filterkeys = array_map('trim',array_keys($input));
        $filtervalues = array_map('trim',$input);
        $input = array_combine($filterkeys,$filtervalues);
        $input = array_map('stripslashes',$input);
        $input = array_map('htmlentities',$input);
        return $input;
    }

    private function cleanSubmitInput($input) {

        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }

    private function sendNewPasswordEmail($newPassword,$email,$username) {
        //Send the new password to the user
        $to      = $email; // Send email to our user
        $subject = 'Password Resetting'; // Give the email a subject
        $message = '

        Hello '.$username.'
        Your password has been updated, you can login with your new password.

        ------------------------
        Password: '.$newPassword.'

        ------------------------


        '; // Our message above including the link

        $headers = 'From:noreply@GamesCorner.com' . "\r\n"; // Set from headers
        $mail = mail($to, $subject, $message, $headers); // Send our email

        return $mail;
    }
}