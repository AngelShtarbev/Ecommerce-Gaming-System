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

    <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <div class="control-group <?php echo (array_key_exists('title', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Title</label>
                <div class="controls">
                    <input type="text" id="inputError" name="title" value="">
                    <?php if (array_key_exists('title', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['title']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('description', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Description</label>
                <div class="controls">
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    <?php if (array_key_exists('description', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['description']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="fileInput">File input</label>
                <div class="controls">
                    <input class="input-file uniform_on" name="image" id="fileInput" type="file">
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" name="addBlogPost" value="Add Blog Post" class="btn btn-primary"/>
            </div>
        </fieldset>
    </form>


</div>


<?php require_once __DIR__.'/../include/footer.php'; ?>
