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
        $filter .= " $operator fullname LIKE '%$keyword%'";
    }
}
$num_page = db_num_rows("SELECT * FROM `tbl_customers`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_customers`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_customers = get_customers($start, $num_per_page, $filter);
//$list_customers = get_list_customers();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                    <a href="?mod=orders&action=add" title="" id="add-new" class="fl-left">Thêm đơn hàng</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=orders&action=customers">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="orders">
                            <input type="hidden" name="action" value="customers">
                            <input type="text" name="keyword" id="" placeholder="Nhập họ tên khách hàng...">
                            <input type="submit" name="btn-search" id="" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_customers)):
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td width="20%"><span class="thead-text">Địa chỉ giao hàng</span></td>
                                    <td width="10%"><span class="thead-text">Ghi chú</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stt = $start;
                                foreach ($list_customers as $item):
                                    $stt++;
                                    ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="?mod=orders&action=detail_order&id=<?php echo $item['order_id']; ?>" title=""><?php echo $item['order_code']; ?></a>
                                            </div>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['fullname']; ?></h3></span>
                                        <td><span class="tbody-text"><?php echo $item['phone_number']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['email']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['address']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['note']; ?></span></td>
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
                        <p style="text-align: center; font-size: 18px">Không có khách hàng</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            echo get_pagging($num_page, $page, "?mod=orders&action=customers");
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
