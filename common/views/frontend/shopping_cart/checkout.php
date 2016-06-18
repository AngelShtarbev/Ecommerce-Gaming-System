<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>

<?php
$arr  = array_keys($_SESSION['cart_item']);
$end = end($arr);
?>

<!-- Custom CSS -->
<link href="css/form-register.css" rel="stylesheet">
<link href="css/form-elements.css" rel="stylesheet">
<!-- Custom CSS -->
<div class="">
    <div class="container inner-bg-1">
        <div class="col-sm-5">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Checkout</h3>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-flag-checkered"></i>
                </div>
            </div>
            <div class="form-bottom">
                <form  action="" method="post">
                    <div class="form-group alert alert-info" role="alert">
                        <div class="container">
                         <div class="row">
                        <?php foreach($_SESSION['cart_item'] as $item) : ?>
                             <div class="row">
                                 <div class="col-md-6">
                                 <p class="paragraph">
                                     <span class="">
                                     <span><?php echo $item['name'];?></span>
                                     <span class="span"><?php echo $item['category_name'];?></span>
                                     <span class="span"><?php echo $item['quantity'];?></span>
                                     <span class="span"><?php echo sprintf("%01.2f",$item['price']);?></span>
                                     </span>
                                 </p>
                                 </div>
                             </div>
                        <?php endforeach;?>
                        <br/>
                        <div class="col-sm-9">
                            <p class="paragraph">
                                <span class="span alert alert-danger">
                                    <?php
                                    switch($_SESSION['item_total']) {
                                        case ($_SESSION['item_total'] <= 50) :
                                           $_SESSION['shipping_status'] = 1;
                                           echo '<strong>Total +20$ Shipping:';
                                           $_SESSION['item_total']+=20;
                                           echo '$' . sprintf("%01.2f",$_SESSION['item_total']);
                                           echo '</strong>';
                                           break;
                                        case ($_SESSION['item_total'] > 50) :
                                            $_SESSION['shipping_status'] = 0;
                                            echo '<strong>Total -20$ Shipping:';
                                            echo '$' . sprintf("%01.2f",$_SESSION['item_total']);
                                            echo '</strong>';
                                            break;
                                    }
                                    ?>
                                </span>
                            </p>
                        </div>
                       </div>
                    </div>
                   </div>
                    <div class="form-group">
                        <?php if(array_key_exists('customer_phone', @$errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo @$errors['customer_phone']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="control-label" for="phone"><strong>Enter your phone number</strong></label>
                        <input type="text" name="phone" placeholder="Phone" class="phone form-control style" id="phone"
                               value="<?php echo $insertInfo['customer_phone']; ?>">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('customer_address', @$errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo @$errors['customer_address']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="control-label" for="address"><strong>Enter your address</strong></label>
                        <input type="text" name="address" placeholder="Address" class="address form-control style" id="address"
                               value="<?php echo $insertInfo['customer_address']; ?>">
                    </div>
                    <div class="form-group">
                        <?php if(array_key_exists('customer_email', @$errors)) : ?>
                            <div class= 'alert alert-danger' role='alert'>
                                <?php echo @$errors['customer_email']; ?>
                            </div>
                        <?php endif ;?>
                        <label class="control-label" for="email"><strong>Enter your email</strong></label>
                        <input type="text" name="email" placeholder="Email" class="email form-control style" id="email"
                               value="<?php echo $insertInfo['customer_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="select"><strong>Choose Payment Method</strong></label>
                            <select name="paymentMethod" class="form-control style" id="select">
                                <option value="On Delivery">On Delivery</option>
                                <option value="Credit Card">Credit Card</option>
                            </select>
                    </div>
                    <a href="index.php?c=cart&m=index&id=<?php echo $end;?>">
                        <button type="button" class="btn style-button">Go Back</button>
                    </a>
                    <br/>
                    <br/>
                    <button type="submit" name="submit" class="btn style-button">Buy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__.'/../include/footer.php'; ?>
