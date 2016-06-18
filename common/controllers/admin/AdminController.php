<?php

class AdminController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //This method outputs all the information for all administrators in the database

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

        //$perPageSelect variable is used to filter the number of admins per page
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

        //$orderBy variable is used to filter the admins by username , email , firstname
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
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        //$offset is used to determine the number of admins to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of AdminCollection class
        $adminsCollection = new AdminCollection();
        //Use getAll() method to fetch all records for all games using the filters $order & $like
        $rows = (count($adminsCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($adminsCollection->getAll(array(), -1, 0, $order, $like));
        //Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of games per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=admin&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all admins from the database using all of the defined filters
        $admins = $adminsCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array $data
        $data['admins'] = $admins;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;

        // Load view listing.php from folder admins
        $this->loadView('admins/listing', $data);

    }

    public function create()
    {
        //This method is used to create admins

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        $insertInfo = array(
            'username' => '',
            'password' => '',
            'email'    => '',
            'firstname' => ''
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createAdmin'])) {
            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method

            $insertInfo = array(
                'username' => (isset($_POST['username']))? $this->cleanInput($_POST['username']) : '',
                'password' => (isset($_POST['password']))? $this->cleanInput(sha1($_POST['password'])) : '',
                'email'    => (isset($_POST['email']))? $this->cleanInput($_POST['email']) : '',
                'firstname' => (isset($_POST['firstname']))? $this->cleanInput($_POST['firstname']) : ''
            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $adminEntity = new AdminsEntity();
                $adminEntity->setUsername($insertInfo['username']);
                $adminEntity->setEmail($insertInfo['email']);
                $adminEntity->setPassword($insertInfo['password']);
                $adminEntity->setFirstname($insertInfo['firstname']);

                $collection = new AdminCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($adminEntity);

                $_SESSION['flashMessage'] = 'You have 1 new admin';
                header('Location: index.php?c=admin&m=index');
            }
        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load view create.php from folder admins
        $this->loadView('admins/create', $data);
    }


    public function update()
    {
        // This method is used to update admins information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no admin id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=admin&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();

        $adminCollection = new AdminCollection();
        $clean = $this->cleanInput($_GET['id']);
        $admin = $adminCollection->getOne($clean);

        //If no records are fetched for an admin redirect
        if (is_null($admin)) {
            header('Location: admins.php');
        }

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'username' => $admin->getUsername(),
            'password' => '',
            'email'    => $admin->getEmail(),
            'firstname' => $admin->getFirstname()
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editAdmin'])) {
            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method

            $insertInfo = array(
                'username'    => (isset($_POST['username'])) ? $this->cleanInput($_POST['username']) : '',
                'password'    => (isset($_POST['password'])) ? $this->cleanInput(sha1($_POST['password'])) : '',
                'email'       => (isset($_POST['email'])) ? $this->cleanInput($_POST['email']) : '',
                'firstname' => (isset($_POST['firstname'])) ? $this->cleanInput($_POST['firstname']) : ''
            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors update all records for a game in the database
            if (empty($errors)) {
                $entity = new AdminsEntity();
                $clean = $this->cleanInput($_GET['id']);
                $entity->setId($clean);
                $entity->setUsername($insertInfo['username']);
                $entity->setPassword($insertInfo['password']);
                $entity->setEmail($insertInfo['email']);
                $entity->setFirstname($insertInfo['firstname']);

                //save() method escapes all data before inserting it in the database
                $adminCollection->save($entity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header('Location: index.php?c=admin&m=index');
            }
        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load view update.php from folder admins
        $this->loadView('admins/update', $data);
    }

    public function delete()
    {
        //This method is used to delete information for an admin in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no admin id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=admin&m=index');
        }

        $clean = $this->cleanInput($_GET['id']);

        $adminCollection = new AdminCollection();
        $admin = $adminCollection->getOne($clean);

        //Check for result query from table admins
        //If no records are fetched for an admin redirect
        if (is_null($admin)) {
            header('Location: index.php?c=admin&m=index');
        }

        //delete records from table admins
        $adminCollection->delete($admin->getId());
        header('Location: index.php?c=admin&m=index');
    }

    private function validateUserInput($input)
    {
        $errors = array();

        if ( (empty($input['username'])) || (strlen($input['username']) <= 3) || (strlen($input['username']) >= 255) ) {
            $errors['username'] = 'Incorrect username! Did you fill in the field!';
        }


        if ( (empty($input['email'])) || (strlen($input['email']) >= 100) || (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['email'] = 'Incorrect email format! Did you fill in the field!';
        }

        if ( (empty($input['firstname'])) || (strlen($input['firstname']) <= 3) || (strlen($input['firstname']) >= 100 ) ) {
            $errors['firstname'] = 'Incorrect name! Did you fill in the field!';
        }


        return $errors;
    }

    private function cleanInput($input) {

        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}


