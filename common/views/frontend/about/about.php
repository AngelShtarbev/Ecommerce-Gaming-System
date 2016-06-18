<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>
<!-- CSS -->
<link rel="stylesheet" href="css/style3.css">
<div class="c-form-container section-container section-container-image-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 c-form section-description wow fadeIn">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 c-form-box wow fadeInUp">
                <div class="c-form-top">
                    <div class="c-form-top-left">
                        <h3>About us</h3>
                        <h3>We are dedicated on providing the best games prices on the market</h3>
                    </div>
                    <div class="c-form-top-right">
                        <div class="c-form-top-right-icon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
                <div class="c-form-bottom">
                    <p id="p"><?php echo $about[0]->getDescription(); ?><p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 c-form-info-title wow fadeInUp">
                <h3>...or find us here:</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 c-form-info-box wow fadeInUp">
                <div class="c-form-info-box-icon">
                    <i class="fa fa-map-marker"></i>
                </div>
                <p><?php echo $about[0]->getLocation(); ?></p>
            </div>
            <div class="col-sm-3 c-form-info-box wow fadeInDown">
                <div class="c-form-info-box-icon">
                    <i class="fa fa-phone"></i>
                </div>
                <p>Phone:<br><?php echo $about[0]->getPhone(); ?></p>
            </div>
            <div class="col-sm-3 c-form-info-box wow fadeInUp">
                <div class="c-form-info-box-icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <p>Email:<br><a href=""><?php echo $about[0]->getEmail(); ?></a></p>
            </div>
            <div class="col-sm-3 c-form-info-box wow fadeInDown">
                <div class="c-form-info-box-icon">
                    <i class="fa fa-skype"></i>
                </div>
                <p>Skype:<br><?php echo $about[0]->getSkype(); ?></p>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>
