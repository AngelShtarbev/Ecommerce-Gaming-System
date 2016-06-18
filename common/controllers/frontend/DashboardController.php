<?php

class DashboardController extends Controller {


public function index()
{
    $data = array();

    //Output random 6 games
    $gamesCollection = new GamesCollection();
    $randomGames = $gamesCollection->getAll(array(), 6, 0, array('id', 'desc'), array(), 1);

    $data['randomGames']   = $randomGames;
    
    $this->loadFrontView('landingPage', $data);

 }

}