<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/sidebar.php'; ?>
<!-- start: Content -->
<div id="content" class="span10" xmlns="http://www.w3.org/1999/html">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.php">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>
    <form action="" method="post"  class="form-horizontal">
        <fieldset>
            <div class="control-group <?php echo (array_key_exists('username', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Username</label>
                <div class="controls">
                    <input type="text" id="inputError" name="username" value="<?php echo $insertInfo['username']; ?>">
                    <?php if (array_key_exists('username', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['username']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('password', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Password</label>
                <div class="controls">
                    <input type="password" id="inputError" name="password">
                    <?php if (array_key_exists('password', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['password']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('email', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Email</label>
                <div class="controls">
                    <input type="text" id="inputError" name="email" value="<?php echo $insertInfo['email']; ?>">
                    <?php if (array_key_exists('email', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['email']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('firstname', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Firstname</label>
                <div class="controls">
                    <input type="text" id="inputError" name="firstname" value="<?php echo $insertInfo['firstname']; ?>">
                    <?php if (array_key_exists('firstname', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['firstname']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="createAdmin" value="Create Admin" class="btn btn-primary"/>
            </div>
        </fieldset>
    </form>
</div>

<?php require_once __DIR__.'/../include/footer.php'; ?>
