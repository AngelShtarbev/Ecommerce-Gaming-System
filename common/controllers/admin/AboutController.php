<?php

class AboutController extends Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        //This method outputs all the information for all about information in the database
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        $aboutCollection = new AboutCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = count($aboutCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=about&m=index");

        $about = $aboutCollection->getAll(array(), $offset, $perPage);

        $data['about'] = $about;
        $data['pagination'] = $pagination;


        $this->loadView('about/listing', $data);
    }

    public function create() {

        //This method is used to create about information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        $insertInfo = array(
            'location' => '',
            'email' => '',
            'phone' => '',
            'skype' => '',
            'description' => ''
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createInfo'])) {
            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method

            $insertInfo = array(
                'location' => (isset($_POST['location'])) ? $this->cleanInput($_POST['location']) : '',
                'email' => (isset($_POST['email'])) ? $this->cleanInput($_POST['email']) : '',
                'phone' => (isset($_POST['phone'])) ? ($_POST['phone']) : '',
                'skype' => (isset($_POST['skype'])) ? $this->cleanInput($_POST['skype']) : '',
                'description' => (isset($_POST['description'])) ? $this->cleanInput($_POST['description']) : '',
            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $aboutEntity = new AboutEntity();
                $aboutEntity->setLocation($insertInfo['location']);
                $aboutEntity->setEmail($insertInfo['email']);
                $aboutEntity->setPhone($insertInfo['phone']);
                $aboutEntity->setSkype($insertInfo['skype']);
                $aboutEntity->setDescription($insertInfo['description']);

                $collection = new AboutCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($aboutEntity);

                $_SESSION['flashMessage'] = 'You have 1 new company info';
                header("Location: index.php?c=about&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        //Load view create.php from folder about
        $this->loadView('about/create', $data);

    }

    public function update() {

        // This method is used to update about information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no about id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=about&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();

        $aboutCollection = new AboutCollection();
        $clean = $this->cleanInput($_GET['id']);
        $about = $aboutCollection->getOne($clean);

        //If no records are fetched for the about message
        if (is_null($about)) {
            header('Location: index.php?c=about&m=index');
        }

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'location' => $about->getLocation(),
            'email' => $about->getEmail(),
            'phone' => $about->getPhone(),
            'skype' => $about->getSkype(),
            'description' => $about->getDescription()
        );

        $errors = array();

        if (isset($_POST['editInfo'])) {

            $insertInfo = array(
                'location' => (isset($_POST['location'])) ? $this->cleanInput($_POST['location']) : '',
                'email' => (isset($_POST['email'])) ? $this->cleanInput($_POST['email']) : '',
                'phone' => (isset($_POST['phone'])) ? $this->cleanInput($_POST['phone']) : '',
                'skype' => (isset($_POST['skype'])) ? $this->cleanInput($_POST['skype']) : '',
                'description' => (isset($_POST['description'])) ? $this->cleanInput($_POST['description']) : '',
            );

            //Validate filtered information
            $errors = $this->validateInput($insertInfo);

            //If there are no validation errors update all records for the about info in database
            if(empty($errors)) {
                $clean = $this->cleanInput($_GET['id']);

                $aboutEntity = new AboutEntity();
                $aboutEntity->setId($clean);
                $aboutEntity->setLocation($insertInfo['location']);
                $aboutEntity->setEmail($insertInfo['email']);
                $aboutEntity->setPhone($insertInfo['phone']);
                $aboutEntity->setSkype($insertInfo['skype']);
                $aboutEntity->setDescription($insertInfo['description']);

                $collection = new AboutCollection();
                $collection->save($aboutEntity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header("Location: index.php?c=about&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        //Load view update.php from folder about
        $this->loadView('about/update', $data);
    }

    public function delete() {

        //This method is used to delete information for the about info in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no about id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=about&m=index');
        }

        $clean = $this->cleanInput($_GET['id']);

        $aboutCollection = new AboutCollection();
        $about = $aboutCollection->getOne($clean);

        //Check for result query from table about
        //If no records are fetched for about info redirect
        if (is_null($about)) {
            header('Location: index.php?c=about&m=index');
        }

        //delete records from table about
        $aboutCollection->delete($about->getId());
        header('Location: index.php?c=about&m=index');
    }

    private function validateInput($input)
    {
        $errors = array();

        if ( (empty($input['description'])) || (strlen($input['description']) <= 3) || (strlen($input['description']) >= 255) ) {
            $errors['description'] = 'Incorrect description! Did you fill in the field!';
        }

        if ( (empty($input['skype'])) || (strlen($input['skype']) <= 3) || (strlen($input['skype']) >= 255) ) {
            $errors['skype'] = 'Incorrect skype name! Did you fill in the field!';
        }

        if ( (empty($input['phone'])) || (strlen($input['phone']) <= 3) || (strlen($input['phone']) >= 100) || (!ctype_digit($input['phone'])) ) {
            $errors['phone'] = 'Incorrect format! Did you fill in the field!';
        }

        if ( (empty($input['location'])) || (strlen($input['location']) <= 3) || (strlen($input['location']) >= 255) ) {
            $errors['location'] = 'Incorrect location info! Did you fill in the field!';
        }

        if ( (empty($input['email'])) || (strlen($input['email']) <= 3) || (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['email'] = 'Incorrect format! Did you fill in the field!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}
