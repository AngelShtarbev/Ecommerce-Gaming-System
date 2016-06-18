<?php

class FrontLoginController extends Controller {

    public function __construct() {

        parent::__construct();
    }


    public function login()
    {

        $data = array();
        $result = array();

        $usersCollection = new UserCollection();
        $ordersCollection = new OrdersCollection();

        $errors = array();

        // If fields username & password are left empty
        if(isset($_POST['username']) && isset($_POST['password']) && empty($_POST['username']) && empty($_POST['password'])) {
            $errors['login'] = 'Wrong username or password !';
        }

        // If field username is filled but password left empty
        if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && empty($_POST['password'])) {
            $errors['login'] = 'Wrong username or password !';
        }

        // If field password is filled but username left empty
        if(isset($_POST['username']) && isset($_POST['password']) && empty($_POST['username']) && !empty($_POST['password'])) {
            $errors['login'] = 'Wrong username or password !';
        }

        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            $input_password = stripslashes(htmlentities(trim($_POST['password'])));
            $password = sha1($input_password);

            $username = stripslashes(htmlentities(trim($_POST['username'])));
            $where = array('username' => $username);

            $result = $usersCollection->getAll($where);

            $orders = $ordersCollection->getAll(array('customer_username' => $username));

            switch($result) {
                case (empty($result)):
                    $errors['login'] = 'Wrong username or password !';
                    break;
                case ( ($result != null) && ($result[0]->getPassword() == $password) && ($result[0]->getActive()== 1) ) :
                    $_SESSION['user'] = $result[0];
                    $_SESSION['new_orders'] = $orders;
                    $_SESSION['front_logged_in'] = 1;
                    header('Location: index.php?c=dashboard&m=index');
                    break;
                case ( ($result != null) && ($result[0]->getPassword() == $password) && ($result[0]->getActive() != 1) ) :
                    $errors['login'] = 'Your account is not activated !';
                    break;
                case ( ($result != null) && ($result[0]->getPassword() != $password) && ($result[0]->getActive() == 1) ) :
                    $errors['login'] = 'Wrong username or password !';
                    break;

            }
        }


        $data['errors'] = $errors;
        $data['results'] = $result;

        $this->loadFrontView('login/login', $data);
    }

    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['front_logged_in']);
        unset($_SESSION['item_total']);
        unset($_SESSION['shipping_status']);
        unset($_SESSION['cart_item']);
        unset($_SESSION['new_orders']);
        header('Location: index.php?c=dashboard&m=index');
    }
}