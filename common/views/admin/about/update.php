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
            <div class="control-group <?php echo (array_key_exists('location', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Company Location</label>
                <div class="controls">
                    <input type="text" id="inputError" name="location" value="<?php echo $insertInfo['location']; ?>">
                    <?php if (array_key_exists('location', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['location']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('phone', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Company Phone</label>
                <div class="controls">
                    <input type="text" id="inputError" name="phone" value="<?php echo $insertInfo['phone']; ?>">
                    <?php if (array_key_exists('phone', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['phone']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('skype', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Company Skype</label>
                <div class="controls">
                    <input type="text" id="inputError" name="skype" value="<?php echo $insertInfo['skype']; ?>">
                    <?php if (array_key_exists('skype', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['skype']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('email', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Company Email</label>
                <div class="controls">
                    <input type="text" id="inputError" name="email" value="<?php echo $insertInfo['email']; ?>">
                    <?php if (array_key_exists('email', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['email']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Company Description</label>
                <div class="controls">
                    <textarea name="description" class="cleditor" id="textarea2" rows="3">
                        <?php echo $insertInfo['description']; ?>
                    </textarea>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="editInfo" value="Edit Info" class="btn btn-primary"/>
            </div>
        </fieldset>
    </form>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>
