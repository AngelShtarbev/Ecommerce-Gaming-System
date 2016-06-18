<?php

class CategoryController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //This method outputs all the information for all categories in the database

        //Create array $data and pass it to the view
        $data = array();

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        //Filter value of $search variable
        $clean = $this->cleanInput($search);

        //$like variable is used in search filter
        //used in pagination
        if ( ($clean) != '') {
            $like = array('category', $clean);
        } else {
            $like = array();
        }

        //$perPageSelect variable is used to filter the number of categories per page
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

         //$orderBy variable is used to filter the categories by category name
        //also used in pagination
        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;

        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('category', 'ASC');
                break;
            case 2:
                $order = array('category', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        //$offset is used to determine the number of categories to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of CategoryCollection class
        $categoriesCollection = new CategoryCollection();
        //Use getAll() method to fetch all records for all categories using the filters $order & $like
        $rows = (count($categoriesCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($categoriesCollection->getAll(array(), -1, 0, $order, $like));
        // Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of categories per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=category&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all categories from the database using all of the defined filters
        $categories = $categoriesCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array data
        $data['categories'] = $categories;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;

        // Load view listing.php from folder category
        $this->loadView('category/listing', $data);

    }

    public function create() {

        //This method is used to create users

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        //It is used for the category name input in the view
        $insertInfo = array(
            'category' => '',
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createCategory'])) {

            //Fetch all input information and store in array $insertInfo
            //Filter all the input information using cleanInput() method
            $insertInfo = array(
                'category' => (isset($_POST['category']))? $this->cleanInput($_POST['category']) : '',
            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $categoryEntity = new CategoryEntity();
                $categoryEntity->setCategory($insertInfo['category']);

                $collection = new CategoryCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($categoryEntity);

                $_SESSION['flashMessage'] = 'You have 1 new category';
                header('Location: index.php?c=category&m=index');
            }


        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load view create.php from folder category
        $this->loadView('category/create', $data);
    }

    public function update()
    {
        //This method is used to update all records for a category in the database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no category id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=category&m=index');
        }

        //Fetch all records for a user by id
        $categoryCollection = new CategoryCollection();
        $clean = $this->cleanInput($_GET['id']);
        $category = $categoryCollection->getOne($clean);

        //If no records are fetched for a user redirect
        if (is_null($category)) {
            header('Location: index.php?c=category&m=index');
        }

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'category' => $category->getCategory(),
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editCategory'])) {

            //Fetch all user input information and filter it
            $insertInfo = array(
                'category' => (isset($_POST['category'])) ? $this->cleanInput($_POST['category']) : '',
            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors update all records for a category in the database
            if (empty($errors)) {
                //Filter value of $_GET['id']
                $clean = $this->cleanInput($_GET['id']);

                $entity = new CategoryEntity();
                $entity->setId($clean);
                $entity->setCategory($insertInfo['category']);

                //save() method escapes all data before inserting it in the database
                $categoryCollection->save($entity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header('Location: index.php?c=category&m=index');
            }
        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load view update.php from folder category
        $this->loadView('category/update', $data);
    }

    public function delete()
    {
        //This method is used to delete information for a category in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no category id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=category&m=index');
        }

        //Fetch all records for a category by id
        $categoryCollection = new CategoryCollection();
        $clean = $this->cleanInput($_GET['id']);
        $category = $categoryCollection->getOne($clean);

        //If no records are fetched for a category redirect
        if (is_null($category)) {
            header('Location: index.php?c=category&m=index');
        }

        //Delete a category from the database and redirect to categories index page
        $categoryCollection->delete($category->getId());
        header('Location: index.php?c=category&m=index');
    }

    private function validateUserInput($input)
    {
        //This method validates user input

        $errors = array();

        if ( (empty($input['category'])) || (strlen($input['category']) <= 1) || (strlen($input['category']) >= 255) ) {
            $errors['category'] = 'Incorrect category name! Did you fill in the field!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        //This method filters users input
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }

}