<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!-- Custom CSS -->
<link href="css/style1.css" rel="stylesheet">
<!-- Custom CSS -->
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
            </thead>
            <tbody>
            <?php foreach($games_category as $game):?>
                <tr id="category">
                    <td>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="images/<?php echo $game->getImage();?>" style="width:300px;height:330px;" alt="">
                            </div>
                        </div>
                        <div class="caption">
                            <h4 class="pull-right">$<?php echo sprintf("%01.2f",$game->getPrice());?></h4>
                            <h4><?php echo $game->getNameId()." (".$game->getCategoryId().")";?></h4>
                        </div>
                        <p id="desc"><?php echo $game->getDescriptionId(); ?></p>
                        <br/>
                        <a class="pull-right" href="index.php?c=games&m=showGame&id=<?php echo $game->getId(); ?>"><button type="button" class="btn btn-primary">Add to cart</button></a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="row text-center">
        <?php echo $pagination->create(); ?>
    </div>
    <!-- /Pagination -->
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>

