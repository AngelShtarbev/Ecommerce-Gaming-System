<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!--Login & Register CSS -->
<link href="css/form-login.css" rel="stylesheet">
<link href="css/form-elements.css" rel="stylesheet">
<div class="inner-bg">
    <div class="container">
        <div class="col-sm-5">
            <div class="form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Login to our site</h3>
                        <p>Enter username and password to log on:</p>
                        <?php if(array_key_exists('login', $errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <i class= 'fa fa-exclamation-triangle fa-2x'></i>
                                <?php echo $errors['login']; ?>
                            </div>
                        <?php endif ;?>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form  action="" method="post">
                        <div class="form-group">
                            <label class="sr-only" for="username">Username</label>
                            <input type="text" name="username" placeholder="Username" class="username form-control style" id="username"
                                   value="">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" class="password form-control style" id="password">
                        </div>
                        <button type="submit" class="btn style-button">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>