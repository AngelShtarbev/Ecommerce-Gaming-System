<?php

class RegisterController extends Controller {

    public function register()
    {
        //Google Recaptch secret key
        $secret = "6LcBkxkTAAAAALkApXRgKTy2L_kjGAYXwSKvaYqj";

       // empty response
        $response = null;

       // check secret key
        $reCaptcha = new ReCaptcha($secret);

        $data = array();

        //Array to be sent to the view
        $registrationInput = array(
            'username' => '',
            'password' => '',
            'email' => '',
            'firstname' => ''
        );

        //User errors array to sent to the view
        $errors = array();
        $fillterArray = array();
        $finalArray = [];

        if (isset($_POST['Register'])) {

            $registrationInput = array(
                'username' => (isset($_POST['username'])) ? $this->cleanSubmitInput($_POST['username']) : '',
                'password' => (isset($_POST['password'])) ? $this->cleanSubmitInput(sha1($_POST['password'])) : '',
                'email' => (isset($_POST['email'])) ? $this->cleanSubmitInput($_POST['email']) : '',
                'firstname' => (isset($_POST['firstname'])) ? $this->cleanSubmitInput($_POST['firstname']) : '',

            );

            //Recaptcha validation
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );

            //Filter again data
            $fillterArray = $this->cleanInput($registrationInput);
            //Validate filtered data
            $errors = $this->validateRegistrationInput($registrationInput);
            //Fill $finalArray with filtered data
            $finalArray = $fillterArray;
            $finalArray['confirm_code'] = sha1(rand(0, 100));
            $finalArray['active'] = 0;

            //If no user errors are made and recaptcha response is successful
            if (empty($errors) && ($response != null) && ($response->success)) {

                $userEntity = new UsersEntity();
                $userEntity->setUsername($finalArray['username']);
                $userEntity->setPassword($finalArray['password']);
                $userEntity->setEmail($finalArray['email']);
                $userEntity->setFirstname($finalArray['firstname']);
                $userEntity->setConfirmCode($finalArray['confirm_code']);
                $userEntity->setActive($finalArray['active']);
                $this->sendConfirmationEmail($finalArray['username'], $finalArray['email'], $finalArray['confirm_code'], $finalArray['active']);

                $collection = new UserCollection();
                //save() escapes data before inserting it in the database
                $collection->save($userEntity);

                header('Location:index.php?c=register&m=success');
                exit;
            }
        }

        //Pass data to the view
        $data['registrationInput'] = $registrationInput;
        $data['errors'] = $errors;

        $this->loadFrontView('register/register', $data);
    }

    public function success() {
        //View to be shown after successful registration
        $this->loadFrontView('register/success');
    }


    private function cleanInput($input) {
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

    private function validateRegistrationInput($input) {

        $errors = array();

        if ( (empty($input['username'])) || (strlen($input['username']) < 3) || (strlen($input['username']) > 255) ) {
            $errors['username'] = 'Incorrect username! Did you fill in the field!';
        }

        if ( (empty($input['password'])) || (strlen($input['password']) < 3) || (strlen($input['password']) > 255) ) {
            $errors['password'] = 'Incorrect password! Did you fill in the field!';
        }

        if ( (empty($input['email'])) || (strlen($input['email']) > 100) || (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['email'] = 'Incorrect email format! Did you fill in the field!';
        }

        if ( (empty($input['firstname'])) || (strlen($input['firstname']) < 3) || (strlen($input['firstname']) > 100 ) ) {
            $errors['firstname'] = 'Incorrect name! Did you fill in the field!';
        }

        return $errors;
    }

    //Send an email to the new user containing a registration verification link
   private function sendConfirmationEmail($name,$email,$confirmCode,$active) {
        $to      = $email; // Send email to our user
        $subject = 'Registration | Verification'; // Give the email a subject
        $message = '

        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

        ------------------------
        Username: '.$name.'

        ------------------------

        Please click this link to activate your account:
        http://localhost/ProjectCourseMVCNew/index.php?c=verify&m=verify&email='.$email.'&confirm_code='.$confirmCode.'&status='.$active.'

        '; // Our message above including the link

        $headers = 'From:noreply@GamesCorner.com' . "\r\n"; // Set from headers
        $mail = mail($to, $subject, $message, $headers); // Send our email

        return $mail;
    }

}
