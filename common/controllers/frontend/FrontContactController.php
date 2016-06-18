<?php

class FrontContactController extends Controller
{

    public function contact()
    {
        //This is the method for the contact form
        $data = array();

        $insertInfo = array(
            'email' => '',
            'subject' => '',
            'message' => '',
        );

        $errors = array();
        $fillterArray = array();
        $finalArray = [];

        if (isset($_POST['Contact'])) {

            $insertInfo = array(
                'email' => (isset($_POST['email'])) ? $this->cleanSubmitInput($_POST['email']) : '',
                'subject' => (isset($_POST['subject'])) ? $this->cleanSubmitInput($_POST['subject']) : '',
                'message' => (isset($_POST['message'])) ? $this->cleanSubmitInput($_POST['message']) : '',

            );

            //Filter data again using cleanInput()
            $fillterArray = $this->cleanInput($insertInfo);
            //Validate data after filtering
            $errors = $this->validateInput($insertInfo);
            $finalArray = $fillterArray;

            if(empty($errors)) {

             $contactEntity = new ContactEntity();
             $contactEntity->setEmail($finalArray['email']);
             $contactEntity->setSubject($finalArray['subject']);
             $contactEntity->setMessage($finalArray['message']);

             $collection = new ContactCollection();
             //save() sends the data to the database
             $collection->save($contactEntity);

            header('Location:index.php?c=frontcontact&m=sent');
            exit;

            }
        }

        //Pass data to the view
        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        //Load the view contact.php in folder contact
        $this->loadFrontView('contact/contact', $data);
    }

    public function sent() {

        //View to be shown after successful contact form submission
        $this->loadFrontView('contact/contact_sent');
    }

    private function cleanInput($input) {
        $filterkeys = array_map('trim',array_keys($input));
        $filtervalues = array_map('trim',$input);
        $input = array_combine($filterkeys,$filtervalues);
        $input = array_map('stripslashes',$input);
        $input = array_map('htmlentities',$input);
        return $input;
    }


    private function cleanSubmitInput($input) {
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }

    private function validateInput($input) {

        $errors = array();

        if ( (empty($input['subject'])) ) {
            $errors['subject'] = 'Please fill in this field !';
        }

        if ( (empty($input['message'])) ) {
            $errors['message'] = 'Please fill in this field !';
        }

        if ( (empty($input['email'])) ) {
            $errors['email'] = 'Please fill in this field !';
        }

        if((!filter_var($input['email'], FILTER_VALIDATE_EMAIL))) {
            $errors['email'] = 'This email appears to be invalid , please fill in the field again !';

        }

        return $errors;
    }
}