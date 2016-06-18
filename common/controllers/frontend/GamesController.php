<?php

class GamesController extends Controller {


    public function index()
    {
        //Select all games from all categories - option 'All Categories' from games dropdown in nav
        $data = array();

        $gameCollection = new GamesCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = count($gameCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/index.php?c=games&m=index&id=0");

        $games = $gameCollection->getAll(array(), $offset , $perPage);

        //Pass data to the view
        $data['games'] = $games;
        $data['pagination'] = $pagination;

        //Load games view listing.php in folder games
        $this->loadFrontView('games/listing', $data);
    }

    public function show()
    {
        // Show single game category - option 'PC' & 'Xbox 360' and etc. from games dropdown in nav

        $data = array();

        $clean = stripslashes(htmlentities(trim($_GET['category_id'])));

        $gameCollection = new GamesCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = count($gameCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/index.php?c=games&m=show&category_id={$clean}");


        $games_category = $gameCollection->getCategory($clean , $offset , $perPage);


        if ($games_category === null) {
            header("Location: index.php?c=games&m=index&id=0");
        }

        $data['pagination'] = $pagination;
        $data['games_category'] = $games_category;

        $this->loadFrontView('games/show_category', $data);
    }

    public function showGame() {

        //Show single game from any category
        if(!isset($_GET['id'])) {
            header('Location: index.php?c=games&m=index&id=0');
        }

        $data = array();

        $gameCollection = new GamesCollection();
        $gameAdditionalCollection = new GamesAdditionalCollection();

        $clean = stripslashes(htmlentities(trim($_GET['id'])));
        $selected_game = $gameCollection->getSingleGame($clean);
        $gallery_images = $gameAdditionalCollection->getAll(array('games_id' => $clean));

        if ($selected_game === null && $gallery_images === null) {
            header("Location: index.php?c=games&m=index&id=0");
        }

        //Get gallery images and send them to the view
        $images = array();
        foreach($gallery_images as $image) {
            $images[] = $image->getImageId();
        }

        $data['selected_game'] = $selected_game;
        $data['gallery_images'] = $gallery_images;
        $data['images'] = $images;

        $this->loadFrontView('games/show_game', $data);

    }

    public function searchGame() {

        //Search engine method
        $data = array();

        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        $clean = stripslashes(htmlentities(trim($search)));

        $gamesCollection = new GamesCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = (count($gamesCollection->getAll()));

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/index.php?c=games&m=searchGame&search={$clean}");

        $games = $gamesCollection->getSearchedGame($clean,$offset, $perPage);

        //If no game is found after a search
        if(empty($games)) {
            $this->loadFrontView('games/searchEmpty');
        }

        //If a game was found
        if(!empty($games)) {

            $data['games'] = $games;
            $data['pagination'] = $pagination;

            $this->loadFrontView('games/searchFound', $data);

        }

    }
}