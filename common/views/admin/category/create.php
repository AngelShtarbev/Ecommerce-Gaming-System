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
    <form action="" method="post"  class="form-horizontal">
        <fieldset>
            <div class="control-group <?php echo (array_key_exists('category', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Category name</label>
                <div class="controls">
                    <input type="text" id="inputError" name="category" value="<?php echo $insertInfo['category'];?>">
                    <?php if (array_key_exists('category', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['category']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="createCategory" value="Add Category" class="btn btn-primary"/>
            </div>
        </fieldset>
    </form>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>
