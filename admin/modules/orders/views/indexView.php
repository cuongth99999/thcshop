<?php
get_header();

$filter = '';
if (isset($_GET['btn-search'])) {
    $body = $_GET;
    // Xử lý lọc dữ liệu theo từ khóa
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator order_code LIKE '%$keyword%' OR fullname LIKE '%$keyword%'";
    }
}

// Xử lý lọc status
if (!empty($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 1) {
        $status = 'Chờ duyệt đơn';
    } else if ($status == 2) {
        $status = 'Đang giao hàng';
    } else if ($status == 3) {
        $status = 'Thành công';
    } else {
        $status = 'Đơn bị hủy';
    }

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
        $operator = 'AND';
    } else {
        $operator = 'WHERE';
    }

    $filter.= "WHERE status='{$status}'";
}

$num_products_pending = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Chờ duyệt đơn'");
$num_products_delivering = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Đang giao hàng'");
$num_products_success = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Thành công'");
$num_products_cancel = db_num_rows("SELECT * FROM `tbl_orders` WHERE status='Đơn bị hủy'");

$num_page = db_num_rows("SELECT * FROM `tbl_orders`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_orders`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_orders = get_orders($start, $num_per_page, $filter);
//$list_orders = get_list_orders();

?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                    <a href="?mod=orders&action=add" title="" id="add-new" class="fl-left">Thêm đơn hàng</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=orders">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=orders&status=1">Chờ duyệt đơn <span class="count">(<?php echo $num_products_pending; ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=orders&status=2">Đang giao hàng <span class="count">(<?php echo $num_products_delivering; ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=orders&status=3">Thành công <span class="count">(<?php echo $num_products_success; ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=orders&status=4">Đơn bị hủy <span class="count">(<?php echo $num_products_cancel; ?>)</span> |</a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="orders">
                            <input type="text" name="keyword" id="">
                            <input type="submit" name="btn-search" id="" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_orders)):
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ tên khách hàng</span></td>
                                    <td><span class="thead-text">Số sản phẩm, số lượng</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian đặt mua</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stt = $start;
                                foreach ($list_orders as $item):
                                    $stt++;
                                    $num_order = get_num_order($item['order_id']);
                                    $num_product = get_num_product($item['order_id']);
                                    $price_order = get_price_order($item['order_id']);
                                    $sum_price = 0;
                                    foreach ($price_order as $key => $value) {
                                        $sum_price += $value['price_order'];
                                    }
                                    ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="?mod=orders&action=detail_order&id=<?php echo $item['order_id']; ?>" title=""><?php echo $item['order_code']; ?></a>
                                            </div>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['fullname']; ?></h3></span>
                                        <td><span class="tbody-text" style="margin-left: 50px"><?php echo $num_product['sum_product'].' X '.$num_order['sum_order']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo currency_format($sum_price); ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['status']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_date']; ?></span></td>
                                        <td><span class="tbody-text"><a href="?mod=orders&action=detail_order&id=<?php echo $item['order_id']; ?>">Chi tiết</a></span></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    else:
                        ?>
                        <p style="text-align: center; font-size: 18px">Không có sản phẩm</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            echo get_pagging($num_page, $page, "?mod=orders");
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
