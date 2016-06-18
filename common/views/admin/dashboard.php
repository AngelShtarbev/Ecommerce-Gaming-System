<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/sidebar.php'; ?>
    <!-- start: Content -->
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.php?c=dashboard">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Dashboard</a></li>
        </ul>
        <div class="row-fluid">
            <div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
                <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
                <div class="number"><?php echo $users; ?><i class="icon-arrow-up"></i></div>
                <div class="title">users</div>
                <div class="footer">
                    <a href="index.php?c=user&m=index"> read full report</a>
                </div>
            </div>
            <div class="span3 statbox green" onTablet="span6" onDesktop="span3">
                <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
                <div class="number"><?php echo $admins; ?><i class="icon-arrow-up"></i></div>
                <div class="title">admins</div>
                <div class="footer">
                    <a href="index.php?c=admin&m=index"> read full report</a>
                </div>
            </div>
            <div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
                <div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
                <div class="number"><?php echo $games; ?><i class="icon-arrow-up"></i></div>
                <div class="title">games</div>
                <div class="footer">
                    <a href="index.php?c=game&m=index"> read full report</a>
                </div>
            </div>
            <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
                <div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
                <div class="number"><?php echo $orders; ?><i class="icon-arrow-down"></i></div>
                <div class="title">orders</div>
                <div class="footer">
                    <a href="index.php?c=order&m=index"> read full report</a>
                </div>
            </div>
            <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
                <div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
                <div class="number"><?php echo $contacts; ?><i class="icon-arrow-down"></i></div>
                <div class="title">contact messages</div>
                <div class="footer">
                    <a href="index.php?c=contact&m=index"> read full report</a>
                </div>
            </div>
        </div>
    </div>
<?php
require_once __DIR__.'/include/footer.php';
?>