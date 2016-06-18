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
    <form action="" method="post"   class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <div class="control-group <?php echo (array_key_exists('customer_username', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Customer Username</label>
                <div class="controls">
                    <input type="text" id="inputError" name="username" value="<?php echo $insertInfo['customer_username']; ?>">
                    <?php if (array_key_exists('customer_username', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['customer_username']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('customer_phone', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Customer Phone</label>
                <div class="controls">
                    <input type="text" id="inputError" name="phone" value="<?php echo $insertInfo['customer_phone']; ?>">
                    <?php if (array_key_exists('customer_phone', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['customer_phone']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('customer_address', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Customer Address</label>
                <div class="controls">
                    <input type="text" id="inputError" name="address" value="<?php echo $insertInfo['customer_address']; ?>">
                    <?php if (array_key_exists('customer_address', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['customer_address']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('customer_email', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Customer Email</label>
                <div class="controls">
                    <input type="text" id="inputError" name="email" value="<?php echo $insertInfo['customer_email']; ?>">
                    <?php if (array_key_exists('customer_email', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['customer_email']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo (array_key_exists('order_amount', $errors))? 'error' : ''; ?>">
                <label class="control-label" for="inputError">Order Amount</label>
                <div class="controls">
                    <input type="text" id="inputError" name="order_amount" value="<?php echo $insertInfo['order_amount']; ?>">
                    <?php if (array_key_exists('order_amount', $errors)): ?>
                        <span class="help-inline"><?php echo $errors['order_amount']; ?></span>
                    <?php  endif; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectError3">Shipping</label>
                <div class="controls">
                    <select id="selectError3" name="shipping">
                        <option value="0">no shipping - 20$</option>
                        <option value="1">shipping + 20$</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectError3">Payment Method</label>
                <div class="controls">
                    <select id="selectError3" name="payment_method">
                        <option value="On Delivery">On Delivery</option>
                        <option value="Credit Card">Credit Card</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectError3">Order Status</label>
                <div class="controls">
                    <select id="selectError3" name="order_status">
                        <option value="New">New</option>
                        <option value="Sent">Sent</option>
                    </select>
                </div>
            </div>
            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Order Info</label>
                <div class="controls">
                    <textarea name="order_info" class="cleditor" id="textarea2" rows="3">
                        <?php echo $insertInfo['order_info']; ?>
                    </textarea>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="editOrder" value="Edit Order" class="btn btn-primary"/>
            </div>
        </fieldset>
    </form>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>
