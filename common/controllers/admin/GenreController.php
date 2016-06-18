<?php

class GenreController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //This method outputs all the information for all genres in the database

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
            $like = array('genre', $clean);
        } else {
            $like = array();
        }

        //$perPageSelect variable is used to filter the number of genres per page
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


        //$orderBy variable is used to filter the genres by genre name
        //also used in pagination
        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;

        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('genre', 'ASC');
                break;
            case 2:
                $order = array('genre', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        // $offset is used to determine the number of genres to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of GenreCollection class
        $genresCollection = new GenreCollection();
        //Use getAll() method to fetch all records for all genres using the filters $order & $like
        $rows = (count($genresCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($genresCollection->getAll(array(), -1, 0, $order, $like));
        //Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of genres per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=genre&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all genres from the database using all of the defined filters
        $genres = $genresCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array $data
        $data['genres'] = $genres;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;

        // Load view listing.php from folder genre
        $this->loadView('genre/listing', $data);

    }

    public function create() {

        //This method is used to create genres

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'genre' => '',
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createGenre'])) {

            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method
            $insertInfo = array(
                'genre' => (isset($_POST['genre']))? $this->cleanInput($_POST['genre']) : '',
            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $genreEntity = new GenreEntity();
                $genreEntity->setGenre($insertInfo['genre']);

                $collection = new GenreCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($genreEntity);

                $_SESSION['flashMessage'] = 'You have 1 new genre';
                header('Location: index.php?c=genre&m=index');
            }


        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        // Load view create.php from folder genre
        $this->loadView('genre/create', $data);
    }

    public function update()
    {

        // This method is used to update genres information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no genre id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=genre&m=index');
        }

        //Fetch all records for a user by id
        $genreCollection = new GenreCollection();
        $clean = $this->cleanInput($_GET['id']);
        $genre = $genreCollection->getOne($clean);

        //If no records are fetched for a genre redirect
        if (is_null($genre)) {
            header('Location: index.php?c=genre&m=index');
        }

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'genre' => $genre->getGenre(),
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editGenre'])) {

            //Fetch all user input information and filter it
            $insertInfo = array(
                'genre' => (isset($_POST['genre'])) ? $this->cleanInput($_POST['genre']) : '',
            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors update all records for a genre in the database
            //If the genre id is not passed to the save method a new insert in the database will occur instead of an update operation
            if (empty($errors)) {
                //Filter value of $_GET['id']
                $clean = $this->cleanInput($_GET['id']);

                $entity = new GenreEntity();
                $entity->setId($clean);
                $entity->setGenre($insertInfo['genre']);

                //save() method escapes all data before inserting it in the database
                $genreCollection->save($entity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header('Location: index.php?c=genre&m=index');
            }
        }

        //Pass all data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load view update.php from folder genre
        $this->loadView('genre/update', $data);
    }

    public function delete()
    {
        //This method is used to delete information for a genre in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no genre id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=genre&m=index');
        }

        //Fetch all records for a genre by id
        $genreCollection = new GenreCollection();
        $clean = $this->cleanInput($_GET['id']);
        $genre = $genreCollection->getOne($clean);

        //If no records are fetched for a genre redirect
        if (is_null($genre)) {
            header('Location: index.php?c=genre&m=index');
        }

        //Delete a genre from the database and redirect to genres index page
        $genreCollection->delete($genre->getId());
        header('Location: index.php?c=genre&m=index');
    }

    private function validateUserInput($input)
    {
        //This method validates user input
        $errors = array();

        if ( (empty($input['genre'])) || (strlen($input['genre']) <= 1) || (strlen($input['genre']) >= 255) ) {
            $errors['genre'] = 'Incorrect genre name! Did you fill in the field!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        //This method filters users input
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }

}