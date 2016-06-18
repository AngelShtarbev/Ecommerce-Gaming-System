<?php

class VerifyController extends Controller {

    public function verify() {

     //Verify registered users and set their status to active - from '0' to '1'

    $code = $this->clean($_GET['confirm_code']);
    $status = $this->clean($_GET['status']);
    $email = $this->clean($_GET['email']);

    $userCollection = new UserCollection();
    $userVerify = $userCollection->getAll(array('confirm_code' => $code));

  if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['confirm_code']) && !empty($_GET['confirm_code']) && isset($_GET['status'])) {

      if (($userVerify[0]->getEmail() == $email) && ($userVerify[0]->getConfirmCode() == $code) && ($userVerify[0]->getActive() == $status)) {

          $userCollection->updateStatus($code, $status);
          $this->loadFrontView('verify/success');

      } elseif (($userVerify[0]->getActive()) != $status) {

          $this->loadFrontView('verify/active');

      } elseif (($userVerify[0]->getEmail() != $email) && ($userVerify[0]->getConfirmCode() != $code) && ($userVerify[0]->getActive() != $status)) {

          $this->loadFrontView('verify/error');

      }
  }

  else {
      $this->loadFrontView('verify/error');
  }

    }

    private function clean($input) {
        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}