<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!-- Custom CSS -->
<link href="css/style1.css" rel="stylesheet">
<!-- Custom CSS -->
<div class="container" id="category">
    <div class="row">
        <div class="col-md-4" id="gameImg">
            <div class="thumbnail">
                <img src="images/<?php echo $selected_game->getImage(); ?>" style="width:400px;height:430px;" alt="">
            </div>
        </div>
        <div class="col-md-8" id="gameInfo">
            <div class="caption">
                <h4 class="pull-right">Price: $<?php echo sprintf("%01.2f",$selected_game->getPrice());?></h4>
                <h4 id="gameName"><?php echo $selected_game->getNameId()." (".$selected_game->getCategoryId().")";?></h4>
                <?php if(!loggedIn()) : ?>
                    <a class="pull-right" href="#">
                        <button type="button" class="btn btn-primary" disabled="disabled" data-toggle="tooltip" title="Log in to your account !">Add to cart</button>
                    </a>
                <?php endif; ?>
                <?php if(loggedIn()) : ?>
                    <a class="pull-right" href="index.php?c=cart&m=index&id=<?php echo $_GET['id']; ?>">
                        <button type="button" class="btn btn-primary">Add to cart</button>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-xs-12 .col-md-8">
                <div class="row">
                    <div class="col-xs-12 .col-md-8">
                        <div class="col-md-4 descStyle">
                            <h4>Game Description:</h4>
                        </div>
                        <div class="col-xs-12 .col-md-8 descStyle">
                            <p id="desc"><?php echo $selected_game->getDescriptionId(); ?></p>
                        </div>

                        <div class="col-md-4">
                            <h4>Category: <?php echo $selected_game->getCategoryId();?></h4>
                            <h4>Genre: <?php echo $selected_game->getGenreId(); ?></h4>
                            <h4>Year: <?php echo $selected_game->getYearId(); ?></h4>
                        </div>
                        <div class="col-md-8">
                        <?php foreach($images as $img) : ?>
                            <a href="small_images/<?php echo $img; ?>" data-lightbox="roadtrip">
                                <img src="small_images/<?php echo $img; ?>" style="width:80px;height:80px;" alt="">
                            </a>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <div class="row">
        <div class="col-xs-12 .col-md-8">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" width="500" height="315" src="<?php echo $gallery_images[0]->getVideoId(); ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>