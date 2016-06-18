<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/sidebar.php'; ?>
<link id="bootstrap-style" href="css/images.css" rel="stylesheet">
<!-- start: Content -->
<div id="content" class="span10" xmlns="http://www.w3.org/1999/html">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.php">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#"></a></li>
    </ul>
<form action="index.php?c=gameadditional&m=gamesGalleryImages&id=<?php echo $game_info['id']; ?>" method="post"  class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="disabledInput">Game & Category</label>
            <div class="controls">
                <input name="game" type="hidden" value="<?php echo $game_info['name_id'];?>">
                <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $game_info['name_id']; ?>" disabled>
                <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $game_info['category_id'];?>" disabled>
            </div>
        </div>
        <div class="control-group <?php echo (array_key_exists('video', $errors))? 'error' : ''; ?>">
            <label class="control-label" for="inputError">Add Video</label>
            <div class="controls">
                <?php if(empty($game_additional)): ?>
                   <input type="text" id="inputError" name="video" value="">
                <?php endif ; ?>
                <?php if(!empty($game_additional) && (!empty($game_additional_id))): ?>
                    <input name="game_id" type="hidden" value="<?php echo $game_additional_id->getId();?>">
                    <input name="video_id" type="hidden" value="<?php echo $game_additional_id->getVideoId();?>">
                    <input type="text" id="inputError" name="video" value="<?php echo $game_additional[0]->getVideoId();?>">
                    <?php if (array_key_exists('video', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['video']; ?></span>
                    <?php  endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="control-group <?php echo (array_key_exists('image', $errors))? 'error' : ''; ?>">
            <label class="control-label" for="inputError">Upload Gallery Images</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileInput" name="image" type="file">
                <input type="submit" name="submit" id="fileInput" value="Add Info" class="btn btn-primary"/>
                <?php if (array_key_exists('image', $errors)): ?>
                    <span id="inputError" class="help-inline"><?php echo $errors['image']; ?></span>
                <?php  endif; ?>
            </div>
        </div>
    </fieldset>
</form>
<?php if(!empty($game_additional)): ?>
<div class="container">
    <div class="row">
        <?php foreach($game_additional as $game): ?>
            <div class="span3 ">
                <a href="index.php?c=gameadditional&m=deleteGameGalleryImage&id=<?php echo $game->getId(); ?>" class="btn btn-mini btn-danger ">Delete</a>
                <img style="width:100px; height:80px;" class="img-responsive" src="../small_images/<?php echo  $game->getImageId(); ?>" />
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
<?php endif; ?>
<?php require_once __DIR__.'/../include/footer.php'; ?>