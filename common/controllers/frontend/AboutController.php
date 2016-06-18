<?php

class AboutController extends Controller {


    public function index()
    {
        //Output about information
        $data = array();

        $aboutCollection = new AboutCollection();
        $about = $aboutCollection->getAll();

       $data['about'] = $about;
       $this->loadFrontView('about/about',$data);
    }
}