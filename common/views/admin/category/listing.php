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
                <form action="" method="get" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="inputError">Search by name</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="search" value="<?php echo stripslashes(htmlentities(trim($clean))); ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Results per page</label>
                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                            <input type="hidden" name="c" value="category" />
                            <input type="hidden" name="m" value="index" />
                            <div class="controls">
                                <select id="selectError3" name="perPage">
                                    <option value="0" <?php echo ($perPageSelect == 0)? "selected" : " " ?>>-- Select Order --</option>
                                    <option value="1" <?php echo ($perPageSelect == 1)? "selected" : " " ?>>5 per page</option>
                                    <option value="2" <?php echo ($perPageSelect == 2)? "selected" : " " ?>>10 per page</option>
                                    <option value="3" <?php echo ($perPageSelect == 3)? "selected" : " " ?>>20 per page</option>
                                    <option value="4" <?php echo ($perPageSelect == 4)? "selected" : " " ?>>50 per page</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Filter Categories</label>
                            <div class="controls">
                                <select id="selectError3" name="orderBy">
                                    <option value="0" <?php echo ($orderBy == 0)? "selected" : " " ?>>-- Select Order --</option>
                                    <option value="1" <?php echo ($orderBy == 1)? "selected" : " " ?>>Category Name Up</option>
                                    <option value="2" <?php echo ($orderBy == 2)? "selected" : " " ?>>Category Name Down</option>
                                </select>
                            </div>
                        </div
                        <div class="form-actions">
                            <input type="submit" value="Order Results" class="btn btn-primary"/>
                        </div>
                    </fieldset>
                </form>
                <a href="index.php?c=category&m=create" class="btn btn-large btn-success pull-right">Create category</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Category name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($categories as $category): ?>
                        <tr>
                            <td><?php echo $category->getCategory(); ?></td>
                            <td class="center">
                                <a class="btn btn-info" href="index.php?c=category&m=update&id=<?php echo $category->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=category&m=delete&id=<?php echo $category->getId(); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $pagination->create(); ?>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>
