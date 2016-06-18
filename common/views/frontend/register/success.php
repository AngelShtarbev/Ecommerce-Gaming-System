<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
    <link href="css/style1.css" rel="stylesheet">
    <div class="container" id="msg">
        <div class= 'alert alert-success' id="inner-msg" role='alert'>
            <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
            <strong>
            <?php echo 'Registration successful !
            Your account is currently locked.
            We have sent you an account activation email so please check you email';
             ?>
            </strong>
        </div>
    </div>
<?php require_once __DIR__.'/../include/footer.php'; ?>