
<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!--Login & Register CSS -->
<link href="css/form-login.css" rel="stylesheet">
<link href="css/form-elements.css" rel="stylesheet">
<div class="inner-bg">
    <div class="container">
        <div class="col-sm-5 form-box">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Register to our site</h3>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-user-plus"></i>
                </div>
            </div>
            <div class="form-bottom">
                <form  action="" method="post">
                    <div class="form-group">
                        <?php if(array_key_exists('username', $errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo $errors['username']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="sr-only" for="username">Username</label>
                        <input type="text" name="username" placeholder="Username" class="username form-control style" id="username"
                               value="<?php echo $registrationInput['username']; ?>">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('password', $errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo $errors['password']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="sr-only" for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" class="password form-control style" id="password"
                               value="">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('email', $errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo $errors['email']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="sr-only" for="email">Email</label>
                        <input type="text" name="email" placeholder="Email" class="email form-control style" id="email"
                               value="<?php echo $registrationInput['email']; ?>">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('firstname', $errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo $errors['firstname']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="sr-only" for="firstname">Firstname</label>
                        <input type="text" name="firstname" placeholder="Firstname" class="firstname form-control style" id="firstname"
                               value="<?php echo $registrationInput['firstname']; ?>">
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcBkxkTAAAAAFsHi_75ZXOY0jZOnj9h6zaODL9z">
                        </div>
                    </div>
                    <button type="submit" name="Register" class="btn style-button">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>