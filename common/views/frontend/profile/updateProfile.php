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
                    <h3>Update Profile</h3>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-bottom">
                <form  action="index.php?c=profile&m=updateProfile&user_id=<?php echo $_GET['user_id'];?>" method="post">
                    <div class="form-group">
                        <?php if(array_key_exists('username', @$errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo @$errors['username']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="control-label" for="username"><strong>Username</strong></label>
                        <input type="text" name="username" placeholder="<?php echo $userInput['username']; ?>" class="username form-control style" id="username">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('email', @$errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo @$errors['email']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="control-label" for="email"><strong>Email</strong></label>
                        <input type="text" name="email" placeholder="<?php echo $userInput['email']; ?>" class="email form-control style" id="email">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('firstname', @$errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo @$errors['firstname']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="control-label" for="firstname"><strong>Firstname</strong></label>
                        <input type="text" name="firstname" placeholder="<?php echo $userInput['firstname']; ?>" class="firstname form-control style" id="firstname">
                    </div>
                    <button type="submit" name="submit" class="btn style-button">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>