<?php

class LoginController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data = array();

        $adminsCollection = new AdminCollection();

        $errors = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username'])) {
                if (isset($_POST['username']) && isset($_POST['password']) && strlen($_POST['username']) > 3 && strlen($_POST['password']) > 3) {
                    $password = stripslashes(htmlentities(trim($_POST['password'])));
                    $cleaned_password = sha1($password);

                    $username = stripslashes(htmlentities(trim($_POST['username'])));
                    $where = array('username' => $username);

                    //Check whether such a user exists in table users
                    $result = $adminsCollection->getAll($where);

                    if ($result != null && $result[0]->getPassword() == $cleaned_password) {
                        $_SESSION['admin'] = $result[0];
                        $_SESSION['logged_in'] = 1;
                        header('Location: index.php?c=dashboard');
                    } else {
                        $errors['login'] = 'Wrong credentials';
                    }

                } else {
                    $errors['login'] = 'Wrong credentials';
                }
            }
        }

        //Pass errors data to the view
        $data['errors'] = $errors;

        //Load view login.php
        $this->loadView('login', $data);
    }


    public function logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['logged_in']);
        header('Location: index.php?c=login&m=login');
    }

}
