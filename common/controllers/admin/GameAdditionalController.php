<?php

class GameAdditionalController extends Controller {

    public function gamesGalleryImages()
    {
        //This method outputs all the gallery images for a game

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }
        //If no log in is performed redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=game&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Fetch single record for a game from table games_additional_info and pass it to the view
        $gamesCollection = new GamesCollection();
        $clean = $this->cleanInput($_GET['id']);
        $game_record = $gamesCollection->getSingleGame($clean);

        //If no records are fetched redirect
        if (is_null($game_record)) {
            header('Location: index.php?c=game&m=index');
        }

        //Fetch ids from games_additional_info table used in the view for the 'input type = "hidden" ' fields
        $gamesAdditionalCollection = new GamesAdditionalCollection();
        $game_additional_ids = $gamesAdditionalCollection->getGameById($_GET['id']);

        //Fetch all records for a game from table games_additional_info and send data to the view
        $gameAdditionalCollection = new GamesAdditionalCollection();
        $game_additional = $gameAdditionalCollection->getAll(array('games_id' => $_GET['id']));

        //Array to be passed to the view
        $game_info = array(
            'id' => $game_record->getId(),
            'name_id' => $game_record->getNameId(),
            'category_id' => $game_record->getCategoryId()
        );

        //Create arrays $errors and $imageErrors and pass them to the view
        //They are used to output all the errors for the validation of all inputs
        $errors = array();
        $imageErrors = array();

        //Perform submit operation
        if (isset($_POST['submit'])) {

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
                'games_id' => (isset($_GET['id']) )? $this->cleanInput($_GET['id']) : '',
                'image' => isset($newNameClean)? ($newNameClean) : '',
                'video' => (isset($_POST['video']))? $this->cleanInput($_POST['video']) : '',
                'video_id' => (isset($_POST['video_id']))? $this->cleanInput($_POST['video_id']) : '',
                'game' => (isset($_POST['game']))? $this->cleanInput($_POST['game']) : '',
                'game_id' => (isset($_POST['game_id']))? $this->cleanInput($_POST['game_id']) : '',
            );

            //After all the input information is filtered it is validated
            $errors = $this->validateInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors) && empty($imageErrors)) {

                //First insert video & gallery images in tables games_videos & games_gallery_images
                $gamesVideosEntity = new GamesVideosEntity();
                $gamesGalleryImagesEntity = new GamesGalleryImagesEntity();

                //Update video column if not inserted in table videos
                $gamesVideosEntity->setId($insertInfo['video_id']);
                $gamesVideosEntity->setVideo($insertInfo['video']);
                $gamesVideosEntity->setGame($insertInfo['game']);
                $gamesGalleryImagesEntity->setImage($insertInfo['image']);
                $gamesGalleryImagesEntity->setGame($insertInfo['game']);

                $gamesVideosCollection = new GamesVideosCollection();
                $gamesGalleryImagesCollection = new GamesGalleryImagesCollection();

                //save() method escapes all data before inserting it in the database
                $gamesVideosCollection->save($gamesVideosEntity);
                $gamesGalleryImagesCollection->save($gamesGalleryImagesEntity);
                //End

                //Fetch records from updated tables games_videos & games_gallery_images
                //and form a row to be inserted in games_additional_info
                $gamesAdditionalEntity = new GamesAdditionalEntity();
                $gamesCollection = new GamesCollection();
                $gamesAdditionalCollection = new GamesAdditionalCollection();

                $games_videos_table = $gamesVideosCollection->getAll();
                $games_gallery_images_table = $gamesGalleryImagesCollection->getAll();
                $games_table = $gamesCollection->getGameById($insertInfo['games_id']);

                $gamesAdditionalEntity->setNameId($games_table->getNameId());
                $gamesAdditionalEntity->setImageId($games_gallery_images_table[0]->getId());
                $gamesAdditionalEntity->setVideoId($games_videos_table[0]->getId());
                $gamesAdditionalEntity->setGamesId($games_table->getId());
                $gamesAdditionalEntity->setCategoryId($games_table->getCategoryId());
                //save() method escapes all data before inserting it in the database
                $gamesAdditionalCollection->save($gamesAdditionalEntity);
                //save uploaded image in folder small_images
                $fileUpload->upload('../small_images/'.$newNameClean);

                header("Location: index.php?c=gameadditional&m=gamesGalleryImages&id=".$clean);
            }
        }

        //Pass all data to the view
        $data['game_info'] = $game_info;
        $data['errors'] = $errors;
        $data['imageErrors'] = $imageErrors;
        $data['game_additional'] = $game_additional;
        $data['game_additional_id'] = $game_additional_ids;

        // Load view gamesAdditional.php from folder games
        $this->loadView('games/gamesAdditional', $data);

    }

    public function deleteGameGalleryImage()
    {
        //This method is used to delete games gallery images

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no game id is provided redirect to login page
        if(!isset($_GET['id'])) {
            header('Location: index.php?c=game&m=index');
        }

        //Filter id before using it in an sql query
        $clean = $this->cleanInput($_GET['id']);

        //Select rows to be deleted from tables games_additional_info , games_gallery_images
        $gamesAdditionalCollection  = new GamesAdditionalCollection();
        $gamesGalleryImagesCollection = new GamesGalleryImagesCollection();

        $games_additional_info = $gamesAdditionalCollection->getGameAdditional($clean);
        $game_gallery_images = $gamesGalleryImagesCollection->getGameGalleryImages($games_additional_info->getImageId());

        //Check for result query in main table 'games_additional_info'
        if(is_null($games_additional_info)) {
            header('Location: index.php?c=game&m=index');
        }

        // Use id from result query stored in '$games_additional_info'
        // to delete records in table games_gallery_images and finally delete image from small_images folder
        unlink('../small_images/'.$game_gallery_images->getImage());
        $gamesGalleryImagesCollection->delete($game_gallery_images->getId());

        //Get games_id from table games_additional_info and use it as id in the header redirect
        $games_id = $games_additional_info->getGamesId();

        //Delete records from table games_additional_info
        $gamesAdditionalCollection->delete($games_additional_info->getId());

        header("Location: index.php?c=gameadditional&m=gamesGalleryImages&id=".$games_id);
    }


    private function validateInput($input)
    {
        //This method is used to delete information for a game in database
        $errors = array();

        if ( empty(($input['video'])) || (!filter_var($input['video'], FILTER_VALIDATE_URL)) ) {
            $errors['video'] = 'Incorrect format or empty field!';
        }

        if ( empty(($input['image']))  ) {
            $errors['image'] = 'Choose an image to be uploaded!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        //This method filters users input
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}