<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
    <!--Login & Register CSS -->
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/form-elements.css" rel="stylesheet">
    <div class="inner-bg">
        <div class="container">
            <div class="col-sm-5 form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Reset Password</h3>
                        <div class="form-group">
                            <div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                                <h5><strong>Password resetting is irreversible !</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form  action="index.php?c=profile&m=resetPassword&user_id=<?php echo $_GET['user_id'];?>" method="post">
                        <div class="form-group">
                            <?php if(array_key_exists('password', @$errors)) : ?>
                                <div class= 'alert alert-danger' role='alert'>
                                    <?php echo @$errors['password']; ?>
                                </div>
                            <?php endif ;?>
                            <label class="control-label" for="password"><strong>Password</strong></label>
                            <input type="password" name="password"  class="password form-control style" id="password">
                        </div>
                        <div class="form-group">
                            <?php if(array_key_exists('password_confirm', @$errors)) : ?>
                                <div class= 'alert alert-danger' role='alert'>
                                    <?php echo @$errors['password_confirm']; ?>
                                </div>
                            <?php endif ;?>
                            <label class="control-label" for="password"><strong>Repeat Password</strong></label>
                            <input type="password" name="password_confirm"  class="password form-control style" id="password">
                        </div>
                        <button type="submit" name="submit" class="btn style-button">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once __DIR__.'/../include/footer.php'; ?>