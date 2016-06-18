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
            <form action="index.php" method="get" class="form-horizontal" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="inputError">Search by username</label>
                        <div class="controls">
                            <input type="text" id="inputError" name="search" value="<?php echo stripslashes(htmlentities(trim($clean)));?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Results per page</label>
                        <input type="hidden" name="page" value="<?php echo $page; ?>" />
                        <input type="hidden" name="c" value="admin" />
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
                        <label class="control-label" for="selectError3">Filter Admins</label>
                        <div class="controls">
                            <select id="selectError3" name="orderBy">
                                <option value="0" <?php echo ($orderBy == 0)? "selected" : " " ?>>-- Select Order --</option>
                                <option value="1" <?php echo ($orderBy == 1)? "selected" : " " ?>>Username Up</option>
                                <option value="2" <?php echo ($orderBy == 2)? "selected" : " " ?>>Username Down</option>
                                <option value="3" <?php echo ($orderBy == 3)? "selected" : " " ?>>Email Up</option>
                                <option value="4" <?php echo ($orderBy == 4)? "selected" : " " ?>>Email Down</option>
                                <option value="5" <?php echo ($orderBy == 5)? "selected" : " " ?>>Firstname Up</option>
                                <option value="6" <?php echo ($orderBy == 6)? "selected" : " " ?>>Firstname Down</option>
                            </select>
                        </div>
                    </div
                    <div class="form-actions">
                        <input type="submit" value="Order Results" class="btn btn-primary"/>
                    </div>
                </fieldset>
            </form>
            <?php
            if (isset($_SESSION['flashMessage'])) {
                echo $_SESSION['flashMessage'];
                unset($_SESSION['flashMessage']);
            }
            ?>
            <a href="index.php?c=admin&m=create" class="btn btn-large btn-success pull-right">Create new admin</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Firstname</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($admins as $admin): ?>
                    <tr>
                        <td><?php echo $admin->getUsername(); ?></td>
                        <td class="center"><?php echo $admin->getEmail(); ?></td>
                        <td class="center"><?php echo $admin->getFirstname(); ?></td>
                        <td class="center">

                            <a class="btn btn-info" href="index.php?c=admin&m=update&id=<?php echo $admin->getId(); ?>">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-danger" href="index.php?c=admin&m=delete&id=<?php echo $admin->getId(); ?>">
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
<?php require_once __DIR__.'/../include/footer.php'; ?>