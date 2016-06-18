<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/sidebar.php'; ?>
<!-- start: Content -->
<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.php">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>
    <form action="" method="post"   class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <div class="control-group <?php echo (array_key_exists('email', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Email</label>
                <div class="controls">
                    <input type="text" id="inputError" name="email" value="<?php echo $insertInfo['email']; ?>">
                    <?php if (array_key_exists('email', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['email']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('subject', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Subject</label>
                <div class="controls">
                    <input type="text" id="inputError" name="subject" value="<?php echo $insertInfo['subject']; ?>">
                    <?php if (array_key_exists('subject', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['subject']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Message</label>
                <div class="controls">
                    <textarea name="message" class="cleditor" id="textarea2" rows="3">
                        <?php echo $insertInfo['message']; ?>
                    </textarea>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="createContact" value="Add Contact" class="btn btn-primary"/>
            </div>
        </fieldset>
    </form>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>
