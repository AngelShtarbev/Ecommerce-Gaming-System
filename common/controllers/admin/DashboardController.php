<?php

class DashboardController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //This method fetches all the necessary data from the database and sends it to the view

        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        $data = array();

        //admins
        $adminCollection = new AdminCollection();
        $admins = count($adminCollection->getAll());

        //users
        $userCollection = new UserCollection();
        $users = count($userCollection->getAll());

        //orders
        $orderCollection = new OrdersCollection();
        $orders = count($orderCollection->getAll());

        //games
        $gamesCollection = new GamesCollection();
        $games = count($gamesCollection->getAll());

        //contacts
        $contactsCollection = new ContactCollection();
        $contacts = count($contactsCollection->getAll());


        $data['admins'] = $admins;
        $data['users'] = $users;
        $data['orders'] = $orders;
        $data['games'] = $games;
        $data['contacts'] = $contacts;

        $this->loadView('dashboard', $data);
    }


}