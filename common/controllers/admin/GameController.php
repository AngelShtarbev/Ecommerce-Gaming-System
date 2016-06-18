<?php

class GameController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //This method outputs all the information for all games in the database

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
            $like = array('game', $clean);
        } else {
            $like = array();
        }

        //$perPageSelect variable is used to filter the number of games per page
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


        //$orderBy variable is used to filter the games by name , category , year , price , active
        //also used in pagination
        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;
        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('name_id', 'ASC');
                break;
            case 2:
                $order = array('name_id', 'DESC');
                break;
            case 3:
                $order = array('category_id', 'ASC');
                break;
            case 4:
                $order = array('category_id', 'DESC');
                break;
            case 5:
                $order = array('year_id', 'ASC');
                break;
            case 6:
                $order = array('year_id', 'DESC');
                break;
            case 7:
                $order = array('price', 'ASC');
                break;
            case 8:
                $order = array('price', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        //$offset is used to determine the number of games to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of GamesCollection class
        $gamesCollection = new GamesCollection();
        //Use getAll() method to fetch all records for all games using the filters $order & $like
        $rows = (count($gamesCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($gamesCollection->getAll(array(), -1, 0, $order, $like));
        //Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of games per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=game&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all games from the database using all of the defined filters
        $games = $gamesCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array $data
        $data['games'] = $games;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;


        // Load view listing.php from folder games
        $this->loadView('games/listing', $data);
    }

    public function create() {

        //This method is used to create games

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        /*Create array $insertInfo and pass it to the view
        Also use methods getAll() of classes CategoryCollection & GenreCollection
        to fetch all records from tables games_categories & games_genre
        and store the records in variables $genres and $categories
        These variables are also passed to the view
        */

        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->getAll();

        $genreCollection = new GenreCollection();
        $genres = $genreCollection->getAll();


        $insertInfo = array(
            'name' => '',
            'category_name' => '',
            'description' => '',
            'year' => '',
            'genre' => '',
            'image' => '',
            'price' => ''

        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createGame'])) {

            //Make an instance of class fileUpload
            //It is used for the file upload of an image
            $fileUpload = new fileUpload('image');
            $file = $fileUpload->getFilename();
            $fileExtention = $fileUpload->getFileExtention();

            $imageErrors = array();

            //Every uploaded image name is hashed using sha1() for security reasons
            if ($file != '') {
                $imageErrors =  $fileUpload->validate();
                $newName = $this->cleanInput($fileExtention);
                $newNameClean = sha1(time()).'.'.$newName;
            } else {
                $newNameClean = '';
            }

            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method
            $insertInfo = array(
                'name' => (isset($_POST['name']))? $this->cleanInput($_POST['name']) : '',
                'image' => isset($newNameClean)? $newNameClean : '',
                'category' => (isset($_POST['categories']))? ($_POST['categories']) : '',
                'description' => (isset($_POST['description']))? $this->cleanInput($_POST['description']) : '',
                'year' => (isset($_POST['year']))? ($_POST['year']) : '',
                'genre' => (isset($_POST['genre']))? ($_POST['genre']) : '',
                'price' => (isset($_POST['price']))? $this->cleanInput($_POST['price']) : '',

            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($imageErrors) && empty($errors)) {

                $gamesNamesEntity = new GamesNamesEntity();
                $gamesDescriptionEntity = new GamesDescriptionEntity();
                $gamesYearEntity = new GamesYearEntity();

                //Insert into games , games_names , games_description , games_year
                $gamesNamesEntity->setGame($insertInfo['name']);
                $gamesDescriptionEntity->setDescription($insertInfo['description']);
                $gamesDescriptionEntity->setGame($insertInfo['name']);
                $gamesYearEntity->setYear($insertInfo['year']);
                $gamesYearEntity->setGame($insertInfo['name']);


                $gamesNamesCollection = new GamesNamesCollection();
                $gamesDescriptionCollection = new GamesDescriptionCollection();
                $gamesYearCollection = new GamesYearCollection();

                //Insert into games_names,games_description,games_year
                //save() method escapes all data before inserting it in the database
                $gamesNamesCollection->save($gamesNamesEntity);
                $gamesDescriptionCollection->save($gamesDescriptionEntity);
                $gamesYearCollection->save($gamesYearEntity);

                //Fetch rows from tables games_name , games_description, games_year
                $gamesEntity = new GamesEntity();
                $gamesCollection = new GamesCollection();
                $gamesNames = $gamesNamesCollection->getAll();
                $gamesDescription = $gamesDescriptionCollection->getAll();
                $gamesYear = $gamesYearCollection->getAll();

                //Insert into games table
                //Get values of objects in array - gamesNames[0]->getId()
                $gamesEntity->setNameId($gamesNames[0]->getId());
                $gamesEntity->setCategoryId($insertInfo['category']);
                $gamesEntity->setDescriptionId($gamesDescription[0]->getId());
                $gamesEntity->setYearId($gamesYear[0]->getId());
                $gamesEntity->setGenreId($insertInfo['genre']);
                $gamesEntity->setPrice($insertInfo['price']);
                $gamesEntity->setImage($insertInfo['image']);
                //save uploaded image in folder images
                $fileUpload->upload('../images/'.$newNameClean);

                //save() method escapes all data before inserting it in the database
                $gamesCollection->save($gamesEntity);


                $_SESSION['flashMessage'] = 'You have 1 new game';
                header("Location: index.php?c=game&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['categories'] = $categories;
        $data['genres'] = $genres;
        $data['insertInfo'] = $insertInfo;

        // Load view create.php from folder games
        $this->loadView('games/create', $data);

    }

    public function update() {

        // This method is used to update games information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no game id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=game&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();

        $gamesCollection = new GamesCollection();
        $clean = $this->cleanInput($_GET['id']);

        //Fetch all records for a game by id
        $games = $gamesCollection->getSingleGame($clean);

        //If no records are fetched for a game redirect
        if (is_null($games)) {
            header('Location: index.php?c=game&m=index');
        }

        //Fetch records as ids from table games and pass them to the view
        $game_row = $gamesCollection->getGameById($clean);

        //Fetch categories & genres from tables games_categories & games_genres
        //They are used for all inputs in the view
        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->getAll();

        $genreCollection = new GenreCollection();
        $genres = $genreCollection->getAll();


        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'name' => $games->getNameId(),
            'category_name' => $games->getCategoryId(),
            'description' => $games->getDescriptionId(),
            'year' => $games->getYearId(),
            'genre' => $games->getGenreId(),
            'image' => $games->getImage(),
            'price' => $games->getPrice()

        );
        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editGame'])) {
            //Make an instance of class fileUpload
            //It is used for the file upload of an image
            $fileUpload = new fileUpload('image');
            $file = $fileUpload->getFilename();
            $fileExtention = $fileUpload->getFileExtention();

            $imageErrors = array();
            //Every uploaded image name is hashed using sha1() for security reasons
            if ($file != '') {
                $imageErrors =  $fileUpload->validate();
                $newName = $this->cleanInput($fileExtention);
                $newNameClean = sha1(time()).'.'.$newName;
            } else {
                $newNameClean = '';
            }

            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method
            $insertInfo = array(
                'name' => (isset($_POST['name']))? $this->cleanInput($_POST['name']) : '',
                'game_name' => (isset($_POST['game_name']))? $this->cleanInput($_POST['game_name']) : '',
                'image' => isset($newNameClean)? ($newNameClean) : '',
                'category' => (isset($_POST['categories']))? $this->cleanInput($_POST['categories']) : '',
                'description' => (isset($_POST['description']))? $this->cleanInput($_POST['description']) : '',
                'game_description' => (isset($_POST['game_description']))? $this->cleanInput($_POST['game_description']) : '',
                'year' => (isset($_POST['year']))? $this->cleanInput($_POST['year']) : '',
                'game_year' => (isset($_POST['game_year']))? $this->cleanInput($_POST['game_year']) : '',
                'genre' => (isset($_POST['genre']))? $this->cleanInput($_POST['genre']) : '',
                'price' => (isset($_POST['price']))? $this->cleanInput($_POST['price']) : '',

            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors update all records for a game in the database
            //If ids are not passed to the save method a new insert in all tables will occur instead of an update operation
            if (empty($errors) && empty($imageErrors)) {

                $gamesNamesEntity = new GamesNamesEntity();
                $gamesDescriptionEntity = new GamesDescriptionEntity();
                $gamesYearEntity = new GamesYearEntity();

                //First set values of rows to be inserted into tables games_names , games_description , games_year
                $gamesNamesEntity->setId($insertInfo['game_name']);
                $gamesNamesEntity->setGame($insertInfo['name']);
                $gamesDescriptionEntity->setId($insertInfo['game_description']);
                $gamesDescriptionEntity->setDescription($insertInfo['description']);
                $gamesDescriptionEntity->setGame($insertInfo['name']);
                $gamesYearEntity->setId($insertInfo['game_year']);
                $gamesYearEntity->setYear($insertInfo['year']);
                $gamesYearEntity->setGame($insertInfo['name']);
                //End

                //Finally insert records into tables games_names,games_description,games_year and later insert them into main table 'games'
                $gamesNamesCollection = new GamesNamesCollection();
                $gamesDescriptionCollection = new GamesDescriptionCollection();
                $gamesYearCollection = new GamesYearCollection();

                //save() method escapes all data before inserting it in the database
                $gamesNamesCollection->save($gamesNamesEntity);
                $gamesDescriptionCollection->save($gamesDescriptionEntity);
                $gamesYearCollection->save($gamesYearEntity);
                //End

                //Fetch created records from tables games_name , games_description, games_year
                $gamesEntity = new GamesEntity();
                $gamesCollection = new GamesCollection();
                $gamesNames = $gamesNamesCollection->getAll();
                $gamesDescription = $gamesDescriptionCollection->getAll();
                $gamesYear = $gamesYearCollection->getAll();
                //End

                //Filter id sent by $_GET
                $clean = $this->cleanInput($_GET['id']);

                //Finally insert them into main games table
                $gamesEntity->setId($clean);
                $gamesEntity->setNameId($gamesNames[0]->getId());
                $gamesEntity->setCategoryId($insertInfo['category']);
                $gamesEntity->setDescriptionId($gamesDescription[0]->getId());
                $gamesEntity->setYearId($gamesYear[0]->getId());
                $gamesEntity->setGenreId($insertInfo['genre']);
                $gamesEntity->setPrice($insertInfo['price']);
                $gamesEntity->setImage($insertInfo['image']);
                //save new image in folder images
                $fileUpload->upload('../images/'.$newNameClean);
                $gamesCollection->save($gamesEntity);

                unlink('../images/'.$game_row->getImage()); // delete old image from images folder
                //End

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header("Location: index.php?c=game&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['categories'] = $categories;
        $data['genres'] = $genres;
        $data['games'] = $game_row;
        $data['insertInfo'] = $insertInfo;

        //Load view update.php from folder games
        $this->loadView('games/update', $data);
    }


    public function delete()
    {
        //This method is used to delete information for a game in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no game id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=game&m=index');
        }

        $clean = $this->cleanInput($_GET['id']);

        //Select row to be deleted from games table
        $gamesCollection = new GamesCollection();
        $game = $gamesCollection->getGameById($clean);

        //Check for result query in main table 'games'
        //If no records are fetched for a game redirect
        if (is_null($game)) {
            header('Location: index.php?c=game&m=index');
        }

        //Select rows to be deleted from tables games_names , games_description and games_year
        $gamesNamesCollection = new GamesNamesCollection();
        $gameName = $gamesNamesCollection->getGameName($game->getNameId());

        $gamesDescriptionCollection = new GamesDescriptionCollection();
        $gameDescription = $gamesDescriptionCollection->getGameDescription($game->getDescriptionId());

        $gamesYearCollection = new GamesYearCollection();
        $gameYear = $gamesYearCollection->getGameYear($game->getYearId());


        // Use name , id , description , year from result query stored in '$game'
        // and delete records in tables games_names , games_description , games_year
        $gamesNamesCollection->delete($gameName->getId());
        $gamesDescriptionCollection->delete($gameDescription->getId());
        $gamesYearCollection->delete($gameYear->getId());

        //Delete game column from games table and delete image from folder
        unlink('../images/'.$game->getImage());
        $gamesCollection->delete($game->getId());

        //Assign a value to a variable containing the video id of the selected video_id column and later use this value to
        //delete records from table games_videos
        $gamesAdditionalCollection = new GamesAdditionalCollection();
        $gameVideo = $gamesAdditionalCollection->getGameVideoById($clean);

        //Assign a value to a  variable containing the image id of the selected image_id column and later use this value to
        //delete records from table games_gallery_images
        $gameImage = $gamesAdditionalCollection->getGameImageById(array('games_id' => $clean));

        //Delete records from table games_additional_info
        $gamesAdditionalCollection->delete($clean);

        //Delete records from table games_videos
        $gamesVideosCollection = new GamesVideosCollection();
        $gamesVideosCollection->delete($gameVideo->getVideoId());

        //First select image_id from table games_additional_info and use it to delete records
        //from table games_gallery_images and  image files from folder small_images
        $imageCollection = new GamesGalleryImagesCollection();

        //Fill an array with an image_id for an image or images
        $imagesIdArray = array();
        $imagesNamesArray = array();
        foreach($gameImage as $img) {
            $imagesIdArray[] = $img->getImageId();
        }
        //End

        //$imagesIdArray contains ids and they are used to fetch the images names from
        // table games_gallery_images and store them in $imageNamesArray array
        foreach($imagesIdArray as $imageId) {
            $imagesNamesArray[] = $imageCollection->getGameImage(array('id' => $imageId));
        }
        //End

        //$imagesNameArray array contains the images names and they are used to delete
        //the actual images from the folder small_images
        foreach($imagesNamesArray as $imageName) {
            unlink('../small_images/'.$imageName[0]->getImage());
        }

        ///Delete records from table games_gallery images using the ids stored in $imagesIdArray
        foreach($imagesIdArray as $imageGallery) {
            $imageCollection->delete($imageGallery);
        }

        header('Location: index.php?c=game&m=index');
    }



    private function validateUserInput($input)
    {
        //This method validates user input

        $errors = array();

        if ( (empty($input['name'])) || (strlen($input['name']) <= 1) || (strlen($input['name']) >= 255) ) {
            $errors['name'] = 'Incorrect name! Did you fill in the field!';
        }

        if ( (empty($input['description'])) || (strlen($input['description']) <= 1) || (strlen($input['description']) >= 255) ) {
            $errors['description'] = 'Incorrect description! Did you fill in the field!';
        }


        if ( (empty($input['price'])) || (!filter_var($input['price'], FILTER_VALIDATE_FLOAT)) ) {
            $errors['price'] = 'Incorrect format! Did you fill in the field!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        //This method filters users input
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }


}