<?php
get_header();

$num_products_pending = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Chờ duyệt đơn'");
$num_products_delivering = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Đang giao hàng'");
$num_products_success = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Thành công'");
$num_products_cancel = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Đơn bị hủy'");

$user_login = get_user_login_by_username($_SESSION['user_login']);

$listOrders = get_list_orders();

$sum_turnover = get_turnover();
?>
    <div id="main-content-wp" class="list-post-page">
        <div class="wrap clearfix">
            <?php
            get_sidebar();
            ?>
            <div id="content" class="fl-right">
                <p style="font-size: 20px">Chào mừng <strong><?php echo $user_login['fullname']; ?></strong> đến với trang quản lý website ismart</p>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header"><strong>ĐANG XỬ LÝ</strong></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $num_products_pending; ?></h5>
                                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header"><strong>ĐANG GIAO HÀNG</strong></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $num_products_delivering; ?></h5>
                                    <p class="card-text">Số lượng đơn hàng đang vận chuyển</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header"><strong>ĐƠN HÀNG THÀNH CÔNG</strong></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $num_products_success; ?></h5>
                                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header"><strong>ĐƠN HÀNG HỦY</strong></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $num_products_cancel; ?></h5>
                                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header"><strong>DOANH SỐ</strong></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo currency_format($sum_turnover['sum_turnover']); ?></h5>
                                    <p class="card-text">Doanh số hệ thống</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>
