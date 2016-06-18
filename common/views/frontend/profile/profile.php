
<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!--Login & Register CSS -->
<link href="css/profile.css" rel="stylesheet">
<link href="css/form-elements.css" rel="stylesheet">
<div class="inner-bg">
    <div class="container">
        <div class="col-sm-5 form-box">
            <div class="form-top">
                <div class="form-top-left">
                    <h5>
                    <?php if(!empty($ordersStatus)):?>
                    <div class="form-group">
                        <div class= 'alert alert-info alert-dismissible' id="inner-msg" role='alert'>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                            <strong><?php echo 'You have ' ;?>
                                <?php echo @count($ordersStatus); ?>
                                <?php echo ' new order/s';?>
                            </strong>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(empty($ordersStatus)): ?>
                        <div class="form-group">
                            <div class= 'alert alert-info alert-dismissible' id="inner-msg" role='alert'>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                <strong><?php echo 'You don\'t have new orders' ; ?></strong>
                            </div>
                        </div>
                    <?php endif; ?>
                <h5>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </div>
        <div class="form-bottom">
        <form  action="" method="post">
            <div class="form-group">
                <label class="control-label" for="username"><strong>Username</strong></label>
                <input type="text" name="username" placeholder="<?php echo $user[0]->getUsername(); ?>" class="username form-control style" id="username" disabled>
            </div>
            <div class="form-group">
                <label class="control-label" for="email"><strong>Email</strong></label>
                <input type="text" name="email" placeholder="<?php echo $user[0]->getEmail(); ?>" class="email form-control style" id="email" disabled>
            </div>
            <div class="form-group">
                <label class="control-label" for="firstname"><strong>Firstname</strong></label>
                <input type="text" name="firstname" placeholder="<?php echo $user[0]->getFirstName(); ?>" class="firstname form-control style" id="firstname" disabled>
            </div>
            <!-- Modal for all orders - old & new -->
            <div class="modal fade" id="ordersModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Orders List</h4>
                        </div>
                        <div class="modal-body">
                            <?php foreach($orders as $order) : ?>
                                <label class="control-label" for="order"><strong>Order from: <?php echo $order->getOrderDate(); ?></strong></label>
                                <div class="container">
                                    <div class="row">
                                        <div id="order" class="col-md-6">
                                            <p>Products:<strong><?php echo $order->getOrderInfo(); ?></strong></p>
                                            <p><strong>Total:<?php echo sprintf("%01.2f",$order->getOrderAmount()); ?></strong></p>
                                            <p>Customer Address:<strong><?php echo $order->getCustomerAddress();?></strong></p>
                                            <p>Shipping:
                                                <?php if($order->getShipping() == 0) : ?>
                                                    <strong>Free Shipping </strong>
                                                <?php endif; ?>
                                                <?php if($order->getShipping() != 0) : ?>
                                                    <strong>+20$ Shipping</strong>
                                                <?php endif; ?>
                                            </p>
                                            <p>Payment Method:<strong><?php echo $order->getPaymentMethod();?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary style-button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
            <!-- Modal for all new orders -->
            <div class="modal fade" id="newOrdersModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">New Orders List</h4>
                        </div>
                        <div class="modal-body">
                            <?php foreach($ordersStatus as $status) : ?>
                                <label class="control-label" for="order"><strong>Order from: <?php echo $status->getOrderDate(); ?></strong></label>
                                <div class="container">
                                    <div class="row">
                                        <div id="order" class="col-md-8">
                                            <p>Products:<strong><?php echo $status->getOrderInfo();?></strong></p>
                                            <p><strong>Total:<?php echo sprintf("%01.2f",$status->getOrderAmount()); ?></strong></p>
                                            <p>Customer Address:<strong><?php echo $status->getCustomerAddress();?></strong></p>
                                            <p>Shipping:
                                                <?php if($status->getShipping() == 0) : ?>
                                                    <strong>Free Shipping </strong>
                                                <?php endif; ?>
                                                <?php if($status->getShipping() != 0) : ?>
                                                    <strong>+20$ Shipping</strong>
                                                <?php endif; ?>
                                            </p>
                                            <p>Payment Method:<strong><?php echo $status->getPaymentMethod();?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary style-button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
            <!-- Modal Delete Profile -->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Confirm Delete Profile</h4>
                        </div>

                        <div class="modal-body">
                            <p>You are about to delete your profile, this procedure is irreversible.</p>
                            <p>Do you want to proceed?</p>
                            <p class="debug-url"></p>
                        </div>

                        <div class="modal-footer">
                            <div class="form-group">
                            <a>
                            <button type="button" class="btn btn-primary style-button" data-dismiss="modal">Cancel</button>
                            </a>
                            </div>
                            <div class="form-group">
                                <a class="btn-ok">
                                    <button type="button" class="btn btn-primary style-button">Delete</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
            <?php if(!empty($ordersStatus)): ?>
                <div class="form-group">
                <!-- Button all new orders trigger modal -->
                <button type="button" class="btn btn-primary style-button" data-toggle="modal" data-target="#newOrdersModal">View New Orders</button>
                </div>
            <?php endif; ?>
                <!-- Button all orders trigger modal -->
               <div class="form-group">
               <button type="button" class="btn btn-primary style-button" data-toggle="modal" data-target="#ordersModal">View All Orders</button>
               </div>
               <!-- Button reset password -->
               <div class="form-group">
                   <a href="index.php?c=profile&m=resetPassword&user_id=<?php echo $_SESSION['user']->getId();?>">
                       <button type="button" class="btn btn-primary style-button">Reset Password</button>
                   </a>
              </div>
            <!-- Button reset password -->

            <!-- Button update profile -->
            <div class="form-group">
                <a href="index.php?c=profile&m=updateProfile&user_id=<?php echo $_SESSION['user']->getId();?>">
                    <button type="button" class="btn btn-primary style-button">Update Profile</button>
                </a>
            </div>
            <!-- Button update profile -->

            <!-- Button delete user -->
            <div class="form-group">
                    <button type="button" data-href="index.php?c=profile&m=deleteProfile&user_id=<?php echo $_SESSION['user']->getId();?>"
                           data-toggle="modal" data-target="#confirm-delete" class="btn btn-primary style-button">Delete Profile
                    </button>
            </div>
            <!-- Button update profile -->
            </form>
        </div>
    </div>
 </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>