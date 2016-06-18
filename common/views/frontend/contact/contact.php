<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!-- Custom CSS -->
<link href="css/form-login.css" rel="stylesheet">
<link href="css/form-elements.css" rel="stylesheet">
<!-- Custom CSS -->
<div class="inner-bg">
    <div class="container">
        <div class="col-sm-5">
            <div class="form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Contact us</h3>
                        <p>Fill in the form below to send us a message:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form  action="" method="post">
                            <div class="form-group">
                                <?php if(array_key_exists('email', $errors)) : ?>
                                    <div class= 'alert alert-danger' role='alert'>
                                        <?php echo $errors['email']; ?>
                                    </div>
                                <?php endif ;?>
                                <label class="sr-only" for="email">Email</label>
                                <input type="text" name="email" placeholder="Email" class="email form-control style" id="email"
                                       value="<?php echo $insertInfo['email']; ?>">
                            </div>
                            <div class="form-group">
                                <?php if(array_key_exists('subject', $errors)) : ?>
                                    <div class= 'alert alert-danger' role='alert'>
                                        <?php echo $errors['subject']; ?>
                                    </div>
                                <?php endif ;?>
                                <label class="sr-only" for="subject">Subject</label>
                                <input type="text" name="subject" placeholder="Subject" class="subject form-control style" id="subject"
                                       value="<?php echo $insertInfo['subject']; ?>">
                            </div>
                            <div class="form-group">
                                <?php if(array_key_exists('message', $errors)) : ?>
                                    <div class= 'alert alert-danger' role='alert'>
                                        <?php echo $insertInfo['message']; ?>
                                    </div>
                                <?php endif ;?>
                                <label class="sr-only" for="message">Message</label>
                                <textarea name="message" placeholder="Message" class="message form-control style" id="message" rows="3">
                                <?php echo $insertInfo['message'];?>
                                </textarea>
                            </div>
                            <button type="submit" name="Contact" class="btn style-button">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once __DIR__.'/../include/footer.php'; ?>