<?php


function loggedIn() {
    if (isset($_SESSION['front_logged_in']) && $_SESSION['front_logged_in'] == 1 && isset($_SESSION['user']) ) {
        return true;
    }
    else {
        return false;
    }

}

function userLogInOutReg() {

    if(loggedIn()) {
        echo '<li class="dropdown">';
        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
        echo 'Welcome ';
        echo  $_SESSION['user']->getUsername();
        echo  (empty($_SESSION['new_orders']) || ($_SESSION['new_orders'][0]->getStatus() != 'New'))? '' : '&nbsp;<i class="fa fa-exclamation-circle" aria-hidden="true"></i>';
        echo '<span class=""></span></a>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a href="index.php?c=frontlogin&m=logout">';  echo'&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>';
        echo '<li><a href="index.php?c=Profile&m=viewProfile&username='.$_SESSION['user']->getUsername();'';
        echo ' ">';
        echo '&nbsp;<i class="fa fa-user" aria-hidden="true"></i>View Profile</a></li>';
        echo '</ul>';
        echo '</li>';
    }

    if(!loggedIn()) {
        echo '<li><a href="index.php?c=frontlogin&m=login">'; echo'&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Log In</a></li>';
        echo '<li><a href="index.php?c=register&m=register">'; echo'&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Register</a></li>';
    }


}