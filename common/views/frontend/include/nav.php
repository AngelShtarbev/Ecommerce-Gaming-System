<?php require_once __DIR__.'/../include/Functions.php'; ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="company">Games Corner</a>
            <a class="navbar-brand" href="index.php?c=dashboard&m=index"><i class="fa fa-home" style="font-size:27px"></i></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php?c=about&m=index">About</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Games<span class=""></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $categoryCollection = new CategoryCollection();
                        $categories = $categoryCollection->getDistinct();
                        ?>
                        <li>
                            <a href="index.php?c=games&m=index&id=0">All Categories</a>
                        </li>
                        <?php foreach($categories as $category): ?>
                            <li>
                                <a href="index.php?c=games&m=show&category_id=<?php echo $category->getCategory(); ?>"><?php echo $category->getCategory(); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="index.php?c=frontcontact&m=contact">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-right">
              <?php
               userLogInOutReg();
              ?>
            </ul>
            <?php
            $arr  = @array_keys($_SESSION['cart_item']);
            $end = @end($arr);
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-shopping-cart fa"></i> <span class="badge"><?php echo @count($_SESSION['cart_item']) ?></span> - Items</a>
                    <ul class="dropdown-menu dropdown-cart" role="menu">
                        <?php if(@count($_SESSION['cart_item']) > 0 ): ?>
                            <?php $items_total = 0; ?>
                            <?php foreach($_SESSION['cart_item'] as $item): ?>
                                <li>
                                      <span class="item">
                                        <span class="item-left">
                                            <img src="images/<?php echo $item['image']; ?>" style="width: 50px; height: 50px;"/>
                                            <span class="item-info">
                                                <span><?php echo $item['name'];  ?></span>
                                                <span><?php echo sprintf("%01.2f",$item['price']).' '.'X'.' '.$item['quantity']; ?></span>
                                            </span>
                                        </span>
                                    </span>
                                </li>
                                <?php
                                $items_total += ($item['price'] * $item['quantity']);
                                ?>
                            <?php endforeach; ?>
                            <li><span class="item">Total:<?php echo sprintf("%01.2f",$items_total);?></span></li>
                        <?php endif; ?>

                        <?php if(empty(@$_SESSION['cart_item'])) : ?>
                                <div class= 'alert alert-info' id="inner-msg" role='alert'>
                                    <i class="fa fa-info-circle"></i>
                                    <strong>Your cart is empty !</strong>
                                </div>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['cart_item'])): ?>
                           <li class="divider"></li>
                           <li class="pull-left"><a class="text-center" href="index.php?c=cart&m=index&id=<?php echo $end; ?>">View Cart</a></li>
                           <li class="pull-right"><a class="text-center" href="index.php?c=cart&m=checkout">Checkout</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
            <div class="col-sm-3 col-md-3 pull-right">
                <form class="navbar-form navbar-left" method="get" action="index.php" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control"  placeholder="Search" name="search" value="" >
                        <input type="hidden" name="c" value="games" />
                        <input type="hidden" name="m" value="searchGame" />
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>