<?php

class ContactController extends Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        //This method outputs all the information for all contact messages in the database

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
            $like = array('subject', $clean);
        } else {
            $like = array();
        }

        //$perPageSelect variable is used to filter the number of messages per page
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


        //$orderBy variable is used to filter the messages by email , subject , message
        //also used in pagination
        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;
        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('email', 'ASC');
                break;
            case 2:
                $order = array('email', 'DESC');
                break;
            case 3:
                $order = array('subject', 'ASC');
                break;
            case 4:
                $order = array('subject', 'DESC');
                break;
            case 5:
                $order = array('message', 'ASC');
                break;
            case 6:
                $order = array('message', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        //$offset is used to determine the number of messages to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of ContactCollection class
        $contactsCollection = new ContactCollection();
        //Use getAll() method to fetch all records for all messages using the filters $order & $like
        $rows = (count($contactsCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($contactsCollection->getAll(array(), -1, 0, $order, $like));
        //Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of messages per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=contact&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all messages from the database using all of the defined filters
        $contacts = $contactsCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array $data
        $data['contacts'] = $contacts;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;

        // Load view listing.php from folder contacts
        $this->loadView('contacts/listing', $data);

    }

    public function create()
    {
        //This method is used to create contact messages

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        $insertInfo = array(
            'email' => '',
            'subject' => '',
            'message' => '',

        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createContact'])) {
            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method

            $insertInfo = array(
                'email' => (isset($_POST['email'])) ? $this->cleanInput($_POST['email']) : '',
                'subject' => (isset($_POST['subject'])) ? $this->cleanInput($_POST['subject']) : '',
                'message' => (isset($_POST['message'])) ? $this->cleanInput($_POST['message']) : '',

            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $contactsEntity = new ContactEntity();
                $contactsEntity->setEmail($insertInfo['email']);
                $contactsEntity->setSubject($insertInfo['subject']);
                $contactsEntity->setMessage($insertInfo['message']);

                $collection = new ContactCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($contactsEntity);

                $_SESSION['flashMessage'] = 'You have 1 new contact';
                header("Location: index.php?c=contact&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        // Load view create.php from folder contacts
        $this->loadView('contacts/create', $data);

    }

    public function update() {
        // This method is used to update contact messages

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no contact message id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=contact&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();

        $contactCollection = new ContactCollection();
        $clean = $this->cleanInput($_GET['id']);
        $contacts = $contactCollection->getOne($clean);

        //If no records are fetched for a contact message redirect
        if (is_null($contacts)) {
            header('Location: index.php?c=contact&m=index');
        }

        //Create array $insertInfo and pass it to the view
        $insertInfo = array(
            'email' => $contacts->getEmail(),
            'subject' => $contacts->getSubject(),
            'message' => $contacts->getMessage(),

        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editContact'])) {

            $insertInfo = array(

                'email' => (isset($_POST['email'])) ? $this->cleanInput($_POST['email']) : '',
                'subject' => (isset($_POST['subject'])) ? $this->cleanInput($_POST['subject']) : '',
                'message' => (isset($_POST['message'])) ? $this->cleanInput($_POST['message']) : '',

            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            if (empty($errors)) {
                //If there are no validation errors update all records for a contact message in the database
                $clean = $this->cleanInput($_GET['id']);

                $contactEntity = new ContactEntity();
                $contactEntity->setId($clean);
                $contactEntity->setEmail($insertInfo['email']);
                $contactEntity->setSubject($insertInfo['subject']);
                $contactEntity->setMessage($insertInfo['message']);

                $collection = new ContactCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($contactEntity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header("Location: index.php?c=contact&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        //Load view update.php from folder contacts
        $this->loadView('contacts/update', $data);
    }

    public function delete() {

        //This method is used to delete information for a contact message in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no contact message id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=contact&m=index');
        }

        $clean = $this->cleanInput($_GET['id']);

        //Select row to be deleted from table contact
        $contactCollection = new ContactCollection();
        $contact = $contactCollection->getOne($clean);

        //Check for result query from table contact
        //If no records are fetched for a contact message redirect
        if (is_null($contact)) {
            header('Location: index.php?c=contact&m=index');
        }

        //delete records from table contact
        $contactCollection->delete($contact->getId());

        header('Location: index.php?c=contact&m=index');
    }

    private function validateUserInput($input)
    {
        $errors = array();

        if ( (empty($input['email'])) || (strlen($input['email']) <= 3) || (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['email'] = 'Incorrect format! Did you fill in the field!';
        }

        if ( (empty($input['subject'])) || (strlen($input['subject']) <= 3) || (strlen($input['subject']) >= 255) ) {
            $errors['subject'] = 'Incorrect format! Did you fill in the field!';
        }

        if ( (empty($input['message'])) || (strlen($input['message']) <= 3) ) {
            $errors['message'] = 'Incorrect format! Did you fill in the field!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}