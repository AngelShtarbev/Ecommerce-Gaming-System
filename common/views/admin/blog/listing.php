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


    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Striped Table</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <a href="index.php?c=blog&m=create" class="btn btn-large btn-success pull-right">Create blog post</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($blogPosts as $blogPost):  ?>
                        <tr>
                            <td><?php echo $blogPost->getTitle(); ?></td>
                            <td class="center"><?php echo $blogPost->getDescription(); ?></td>
                            <td class="center"><img width="100" height="100" src="uploads/tours/<?php echo $blogPost->getImage(); ?>" alt=""></td>
                            <td class="center"><?php echo $blogPost->getTitle(); ?></td>
                            <td class="center">
                                <a class="btn btn-success" href="index.php?c=blog&m=blogImages&id=<?php echo $blogPost->getId();?>">
                                    <i class="halflings-icon white zoom-in"></i>
                                </a>
                                <a class="btn btn-info" href="index.php?c=blog&m=update&id=<?php echo $blogPost->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=blog&m=delete&id=<?php echo $blogPost->getId(); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $pagination->create(); ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->




</div><!--/.fluid-container-->

<?php require_once __DIR__.'/../include/footer.php'; ?>