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
        $filter .= " $operator product_name LIKE '%$keyword%' OR code LIKE '%$keyword%'";
    }
}

// Xử lý lọc status
if (!empty($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 1) {
        $status = 'Đã duyệt';
    } else {
        $status = 'Chờ duyệt';
    }

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
        $operator = 'AND';
    } else {
        $operator = 'WHERE';
    }

    $filter.= "WHERE status='{$status}'";
}

$num_products_solved = db_num_rows("SELECT * FROM `tbl_products` WHERE status='Đã duyệt'");
$num_products_pending = db_num_rows("SELECT * FROM `tbl_products` WHERE status='Chờ duyệt'");

$num_page = db_num_rows("SELECT * FROM `tbl_products`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_products`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_products = get_products($start, $num_per_page, $filter);
//$list_products = get_list_products();

?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=products&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=products">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=products&status=1">Đã duyệt <span class="count">(<?php echo $num_products_solved; ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=products&status=2">Chờ duyệt <span class="count">(<?php echo $num_products_pending; ?>)</span> |</a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="products">
                            <input type="text" name="keyword" id="">
                            <input type="submit" name="btn-search" id="" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_products)):
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stt = $start;
                                foreach ($list_products as $item):
                                    $stt++;
                                    ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                        <td><span class="tbody-text"><?php echo $item['code']; ?></h3></span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="<?php echo $item['thumbnail']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['product_name']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="?mod=products&action=edit&id=<?php echo $item['id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="?mod=products&action=delete&id=<?php echo $item['id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo currency_format($item['price']); ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['product_cat_name']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['status']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['fullname']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_date']; ?></span></td>
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
            echo get_pagging($num_page, $page, "?mod=products");
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
