<?php

class UserController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //This method outputs all the information for all users in the database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        //Filter value of $search variable
        $clean = $this->cleanInput($search);

        //$like variable is used in search filter
        //used in pagination
        if ( ($clean) != '') {
            $like = array('username', $clean);
        } else {
            $like = array();
        }

        //$perPageSelect variable is used to filter the number of users per page
        //also used in pagination
        $perPageSelect = (isset($_GET['perPage'])) ? (int)$_GET['perPage'] : 0;
        switch ($perPageSelect) {
            case 0:
                $perPage = 10;
                break;
            case 1:
                $perPage = 5;
                break;
            case 2:
                $perPage = 10;
                break;
            case 3:
                $perPage = 20;
                break;
            case 4:
                $perPage = 50;
                break;
            default:
                $perPage = 10;
        }


        //$orderBy variable is used to filter the users by username , email , firstname , confirm_code , active
        //also used in pagination
        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;
        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('username', 'ASC');
                break;
            case 2:
                $order = array('username', 'DESC');
                break;
            case 3:
                $order = array('email', 'ASC');
                break;
            case 4:
                $order = array('email', 'DESC');
                break;
            case 5:
                $order = array('firstname', 'ASC');
                break;
            case 6:
                $order = array('firstname', 'DESC');
                break;
            case 7:
                $order = array('confirm_code', 'ASC');
                break;
            case 8:
                $order = array('confirm_code', 'DESC');
                break;
            case 9:
                $order = array('active', 'ASC');
                break;
            case 10:
                $order = array('active', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        // $offset is used to determine the number of users to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of UserCollection class
        $usersCollection = new UserCollection();
        //Use getAll() method to fetch all records for all users using the filters $order & $like
        $rows = (count($usersCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($usersCollection->getAll(array(), -1, 0, $order, $like));
        //Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of users per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=user&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all users from the database using all of the defined filters
        $users = $usersCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array $data
        $data['users'] = $users;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;

        // Load view listing.php from folder users
        $this->loadView('users/listing', $data);

    }

    public function create()
    {
        //This method is used to create users

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'username' => '',
            'password' => '',
            'email'    => '',
            'firstname' => '',
            'confirm_code' => '',
            'active' => ''
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createUser'])) {

            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method
            $insertInfo = array(
                'username' => (isset($_POST['username']))? $this->cleanInput($_POST['username']) : '',
                'password' => (isset($_POST['password']))? $this->cleanInput(sha1($_POST['password'])) : '',
                'email'    => (isset($_POST['email']))? $this->cleanInput($_POST['email']) : '',
                'firstname' => (isset($_POST['firstname']))? $this->cleanInput($_POST['firstname']) : '',
                'confirm_code' => (isset($_POST['confirm_code']))? $this->cleanInput($_POST['confirm_code']) : '',
                'active' => (isset($_POST['active']))? $this->cleanInput($_POST['active']) : ''
            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $userEntity = new UsersEntity();
                $userEntity->setUsername($insertInfo['username']);
                $userEntity->setEmail($insertInfo['email']);
                $userEntity->setPassword($insertInfo['password']);
                $userEntity->setFirstname($insertInfo['firstname']);
                $userEntity->setConfirmCode($insertInfo['confirm_code']);
                $userEntity->setActive($insertInfo['active']);

                $collection = new UserCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($userEntity);

                $_SESSION['flashMessage'] = 'You have 1 new user';
                header('Location: index.php?c=user&m=index');
            }
        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        // Load view create.php from folder users
        $this->loadView('users/create', $data);
    }


    public function update()
    {
        // This method is used to update users information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no user id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=user&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Fetch all records for a user by id
        $userCollection = new UserCollection();
        $clean = $this->cleanInput($_GET['id']);
        $user = $userCollection->getOne($clean);

        //If no records are fetched for a user redirect
        if (is_null($user)) {
            header('Location: index.php?c=user&m=index');
        }

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'username' => $user->getUsername(),
            'password' => '',
            'email'    => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'confirm_code' => $user->getConfirmCode(),
            'active' => $user->getActive()
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editUser'])) {
            //Fetch all user input information and filter it
            $insertInfo = array(
                'username'    => (isset($_POST['username'])) ? $this->cleanInput($_POST['username']) : '',
                'password'    => (isset($_POST['password'])) ? $this->cleanInput(sha1($_POST['password'])) : '',
                'email'       => (isset($_POST['email'])) ? $this->cleanInput($_POST['email']) : '',
                'firstname' => (isset($_POST['firstname'])) ? $this->cleanInput($_POST['firstname']) : '',
                'confirm_code' => (isset($_POST['confirm_code'])) ? $this->cleanInput($_POST['confirm_code']) : '',
                'active' => (isset($_POST['active'])) ? $this->cleanInput($_POST['active']) : ''
            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors update all records for a user in the database
            //If the user id is not passed to the save method a new insert in the table will occur instead of an update operation
            if (empty($errors)) {
                //Filter id value
                $clean = $this->cleanInput($_GET['id']);

                $entity = new UsersEntity();
                $entity->setId($clean);
                $entity->setUsername($insertInfo['username']);
                $entity->setPassword($insertInfo['password']);
                $entity->setEmail($insertInfo['email']);
                $entity->setFirstname($insertInfo['firstname']);
                $entity->setConfirmCode($insertInfo['confirm_code']);
                $entity->setActive($insertInfo['active']);

                //save() method escapes all data before inserting it in the database
                $userCollection->save($entity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header('Location: index.php?c=user&m=index');
            }
        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load view update.php from folder users
        $this->loadView('users/update', $data);
    }

    public function delete()
    {
        //This method is used to delete information for a user in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no user id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=user&m=index');
        }

        //Fetch all records for a user by id
        $userCollection = new UserCollection();
        $clean = $this->cleanInput($_GET['id']);
        $user = $userCollection->getOne($clean);

        //If no records are fetched for a user redirect
        if (is_null($user)) {
            header('Location: index.php?c=user&m=index');
        }

        //Delete a user from the database and redirect to users index page
        $userCollection->delete($user->getId());
        header('Location: index.php?c=user&m=index');
    }

    private function validateUserInput($input)
    {
        //This method validates user input
        $errors = array();

        if ( (empty($input['username'])) || (strlen($input['username']) <= 3) || (strlen($input['username']) >= 255) ) {
            $errors['username'] = 'Incorrect username! Did you fill in the field!';
        }


        if ( (empty($input['email'])) || (strlen($input['email']) <= 3) || (strlen($input['email']) >= 100) || (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['email'] = 'Incorrect email format! Did you fill in the field!';
        }

        if ( (empty($input['firstname'])) || (strlen($input['firstname']) <= 3) || (strlen($input['firstname']) >= 100 ) ) {
            $errors['firstname'] = 'Incorrect name! Did you fill in the field!';
        }

        if ( ($input['active'] < 0) || ($input['active'] > 1) || (!ctype_digit($input['active'])) ) {
            $errors['active'] = 'Must be 0 or 1 !';
        }


        return $errors;
    }

    private function cleanInput($input) {

        //This method filters users input
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}