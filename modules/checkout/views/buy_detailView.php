<?php
get_header();
?>
    <style>
        .error {
            font-style: italic;
            color: red;
        }
    </style>
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="trang-chu.html" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="thanh-toan-<?php echo !empty($item)?$item['slug']:''; ?>-<?php echo $_GET['id']; ?>.html" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form method="POST" action="" name="form-checkout">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
<!--                    <form method="POST" action="" name="form-checkout">-->
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname" value="<?php echo !empty($_POST['fullname'])?$_POST['fullname']:false; ?>">
                                <?php echo form_error('fullname') ?>
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo !empty($_POST['email'])?$_POST['email']:false; ?>">
                                <?php echo form_error('email') ?>
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" value="<?php echo !empty($_POST['address'])?$_POST['address']:false; ?>">
                                <?php echo form_error('address') ?>
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone_number" id="phone" value="<?php echo !empty($_POST['phone_number'])?$_POST['phone_number']:false; ?>">
                                <?php echo form_error('phone_number') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note"><?php echo !empty($_POST['note'])?$_POST['note']:false; ?></textarea>
                            </div>
                        </div>
<!--                    </form>-->
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <?php
                if (!empty($item)):
                    ?>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="cart-item">
                                <td class="product-name"><?php echo $item['product_name']; ?><strong class="product-quantity">x 1</strong></td>
                                <td class="product-total"><?php echo currency_format($item['price']); ?></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format($item['price']); ?></strong></td>
                            </tr>
                            </tfoot>
                        </table>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="direct-payment" name="pay_method" value="Khi giao hàng" <?php echo !empty(($_POST['pay_method']))&& ($_POST['pay_method'])=='Khi giao hàng'?'checked':false; ?>>
                                    <label for="direct-payment">Khi giao hàng</label>
                                </li>
                                <li>
                                    <input type="radio" id="payment-home" name="pay_method" value="Thanh toán Online" <?php echo !empty(($_POST['pay_method']))&& ($_POST['pay_method'])=='Thanh toán Online'?'checked':false; ?>>
                                    <label for="payment-home">Thanh toán Online</label>
                                </li>
                            </ul>
                            <?php echo form_error('pay_method') ?>
                        </div>
                        <div class="place-order-wp clearfix">
                            <input type="submit" name="btn-checkout" id="order-now" value="Đặt hàng">
                        </div>
                    </div>
                <?php
                else:
                    ?>
                    <p class="desc" style="font-size: 18px; text-align: center">Không có sản phẩm nào được chọn mua, hãy quay lại cửa hàng để mua hàng.</p>
                <?php endif; ?>
            </div>
        </div>
        </form>
    </div>
<?php
get_footer();
?>