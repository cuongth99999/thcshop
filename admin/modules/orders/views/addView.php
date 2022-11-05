<?php
get_header();
?>
    <style>
        .error {
            font-style: italic;
            color: red;
        }
    </style>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Mã đơn hàng</label>
                        <input type="text" name="order_code" id="title" value="<?php echo !empty($_POST['order_code'])?$_POST['order_code']:false; ?>">
                        <?php echo form_error('order_code') ?>

                        <label for="title">Tên khách hàng</label>
                        <input type="text" name="fullname" id="title" value="<?php echo !empty($_POST['fullname'])?$_POST['fullname']:false; ?>">
                        <?php echo form_error('fullname') ?>

                        <label for="title">Email</label>
                        <input type="text" name="email" id="title" value="<?php echo !empty($_POST['email'])?$_POST['email']:false; ?>">
                        <?php echo form_error('email') ?>

                        <label for="title">Số điện thoại</label>
                        <input type="text" name="phone_number" id="title" value="<?php echo !empty($_POST['phone_number'])?$_POST['phone_number']:false; ?>">
                        <?php echo form_error('phone_number') ?>

                        <label for="title">Địa chỉ giao hàng</label>
                        <input type="text" name="address" id="title" value="<?php echo !empty($_POST['address'])?$_POST['address']:false; ?>">
                        <?php echo form_error('address') ?>

                        <label for="title">Danh sách sản phẩm (Mã sản phẩm : số lượng)</label>
                        <input type="text" name="products" id="title" value="<?php echo !empty($_POST['products'])?$_POST['products']:false; ?>" placeholder="Mã SP1:SL1, mã SP2:SL2, ...">
                        <?php echo form_error('products') ?>

                        <label for="title">Ghi chú</label>
                        <textarea name="note" id="desc" class=""><?php echo !empty($_POST['note'])?$_POST['note']:false; ?></textarea>
                        <?php echo form_error('note') ?>

                        <label for="status">Phương thức thanh toán</label>
                        <select name="pay_method" id="status" style="width: 250px; height: 40px">
                            <option value="0">Chọn phương thức</option>
                            <option value="Khi giao hàng" <?php echo !empty(($_POST['pay_method']))&& ($_POST['pay_method'])=='Khi giao hàng'?'selected':false; ?>>Khi giao hàng</option>
                            <option value="Thanh toán Online" <?php echo !empty(($_POST['pay_method'])) && ($_POST['pay_method'])=='Thanh toán Online'?'selected':false; ?>>Thanh toán Online</option>
                        </select>
                        <?php echo form_error('pay_method') ?>

                        <button type="submit" name="btn-add" id="btn-submit">Thêm đơn hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>