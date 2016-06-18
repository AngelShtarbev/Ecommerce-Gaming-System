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
                            <label class="control-label" for="inputError">Search by name</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="search" value="<?php echo stripslashes(htmlentities(trim($clean)));?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Results per page</label>
                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                            <input type="hidden" name="c" value="game" />
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
                            <label class="control-label" for="selectError3">Filter Games</label>
                            <div class="controls">
                                <select id="selectError3" name="orderBy">
                                    <option value="0" <?php echo ($orderBy == 0)? "selected" : " " ?>>-- Select Order --</option>
                                    <option value="1" <?php echo ($orderBy == 1)? "selected" : " " ?>>Name Up</option>
                                    <option value="2" <?php echo ($orderBy == 2)? "selected" : " " ?>>Name Down</option>
                                    <option value="3" <?php echo ($orderBy == 3)? "selected" : " " ?>>Category Up</option>
                                    <option value="4" <?php echo ($orderBy == 4)? "selected" : " " ?>>Category Down</option>
                                    <option value="5" <?php echo ($orderBy == 5)? "selected" : " " ?>>Year Up</option>
                                    <option value="6" <?php echo ($orderBy == 6)? "selected" : " " ?>>Year Down</option>
                                    <option value="7" <?php echo ($orderBy == 7)? "selected" : " " ?>>Price Up</option>
                                    <option value="8" <?php echo ($orderBy == 8)? "selected" : " " ?>>Price Down</option>
                                </select>
                            </div>
                        </div
                        <div class="form-actions">
                            <input type="submit" value="Order Results" class="btn btn-primary"/>
                        </div>
                    </fieldset>
                </form>
                <a href="index.php?c=game&m=create" class="btn btn-large btn-success pull-right">Create game</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Year</th>
                        <th>Genre</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($games as $game): ?>
                        <tr>
                            <td><?php echo $game->getNameId(); ?></td>
                            <td class="center"><?php echo $game->getCategoryId(); ?></td>
                            <td class="center"><?php echo $game->getDescriptionId(); ?></td>
                            <td class="center"><?php echo $game->getYearId(); ?></td>
                            <td class="center"><?php echo $game->getGenreId(); ?></td>
                            <td class="center"><?php echo $game->getPrice(); ?></td>
                            <td class="center"><img width="100" height="100" src="../images/<?php echo $game->getImage(); ?>" alt=""></td>
                            <td class="center">
                                <a class="btn btn-success" href="index.php?c=gameadditional&m=gamesGalleryImages&id=<?php echo $game->getId();?>">
                                    <i class="halflings-icon white zoom-in"></i>
                                </a>
                                <a class="btn btn-info" href="index.php?c=game&m=update&id=<?php echo $game->getId();?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=game&m=delete&id=<?php echo $game->getId();?>">
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