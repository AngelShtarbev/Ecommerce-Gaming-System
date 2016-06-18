<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!-- Custom CSS -->
<link href="css/style1.css" rel="stylesheet">
<div class="container" id="category">
    <div class="row">
        <div class="col-xs-8 col-sm-6">
            <?php
            if (!empty($game)) {
                    ?>
                    <form class="form-inline" method="post" action="index.php?c=cart&m=index&action=add&id=<?php echo $game->getId(); ?>">
                        <div class="form-group">
                            <div class="col-md-6 .col-md-offset-4 pull-left">
                                <img src="images/<?php echo $game->getImage();?>" style="width:150px;height:200px;" alt="">
                            </div>
                            <div class="col-md-6 .col-md-offset-6 pull-right">
                                <p id="desc"><?php echo $game->getNameId().' '.$game->getCategoryId(); ?></p>
                                <p id="desc"><?php echo "$".sprintf("%01.2f",$game->getPrice()); ?></p>
                                <div class="input-group">
                                    <select name="quantity" class="form-control">
                                     <?php for($i= 1; $i <= 10; $i++) : ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                     <?php endfor;?>
                                    </select>
                                </div>
                                <br/>
                                <br/>
                                <button type="submit" class="btn btn-primary">Add to cart</button>
                            </div>
                        </div>
                    </form>
                    <?php
             }
            ?>
    </div>
        <div class="col-xs-6 col-sm-6" id="gameInfo">
            <div class="table-responsive">
                <?php
                if(isset($_SESSION['cart_item'])){
                    $item_total = 0;
                    $_SESSION['cart_item'];
                    ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th><p id="desc">Name</p></th>
                            <th><p id="desc">Quantity</p></th>
                            <th><p id="desc">Price</p></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (@$_SESSION['cart_item'] as $item) {
                            ?>
                            <tr>
                                <td><p id="desc"><?php echo $item['name'].' '.$item['category_name']; ?></p></td>
                                <td><p id="desc"><?php echo $item['quantity']; ?></p></td>
                                <td><p id="desc"><?php echo "$" . sprintf("%01.2f",$item['price']); ?></p></td>
                                <td>
                                    <a class="pull-left" href="index.php?c=cart&m=index&action=remove&id=<?php echo $item['id']; ?>">
                                        <button type="button" class="btn btn-primary">Remove Item</button>
                                    </a>
                                </td>
                                <td>
                                    <a class="pull-left" href="index.php?c=cart&m=index&action=add&id=<?php echo $item['id']; ?>">
                                        <button type="button" class="btn btn-primary">Update Quantity</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $item_total += ($item['price'] * $item['quantity']);
                            $_SESSION['item_total'] = $item_total;

                        }
                        ?>
                        <tr>
                            <?php
                            if(isset($_SESSION['cart_item'])) {
                                echo '<td colspan="4">';
                                echo '<p id="desc">';
                                echo  'Total:';
                                echo '$'. sprintf("%01.2f",$item_total);
                                echo '</p>';
                                echo '</td>';

                               echo '<td>';
                               echo '<a class="pull-right" href="index.php?c=cart&m=index&action=empty">';
                               echo '<button type="button" class="btn btn-primary">Empty Cart</button>';
                               echo '</a>';
                               echo '</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>
                            <a class="pull-left" href="index.php?c=cart&m=checkout">
                                <button type="button" class="btn btn-primary">Checkout</button>
                            </a>
                            </td>
                            <td colspan="4">
                                <a class="pull-right" href="index.php?c=dashboard&m=index">
                                    <button type="button" class="btn btn-primary">Continue Shopping</button>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__.'/../include/footer.php'; ?>