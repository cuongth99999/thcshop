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
        $filter .= " $operator product_cat_name LIKE '%$keyword%'";
    }
}


$num_page = db_num_rows("SELECT * FROM `tbl_product_categories`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_product_categories`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_cats = get_cats($start, $num_per_page, $filter);
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php
            get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục sản phẩm</h3>
                    <a href="?mod=products&controller=cat&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=products&controller=cat">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="products">
                            <input type="hidden" name="controller" value="cat">
                            <input type="text" name="keyword" id="">
                            <input type="submit" name="btn-search" id="" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_cats)):
                        ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tên danh mục</span></td>
                                <td><span class="thead-text">Thứ tự</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian tạo</span></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $stt = $start;
                                foreach ($list_cats as $item):
                                    $stt++;
                                    $num_repeat = $item['level'] - 1;
                                    ?>
                            <tr>
                                <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                <td class="clearfix">
                                    <div class="tb-title fl-left">
                                        <a href="" title=""><?php echo str_repeat('--', $num_repeat).' '.$item['product_cat_name']; ?></a>
                                    </div>
                                    <ul class="list-operation fl-right">
                                        <li><a href="?mod=products&controller=cat&action=edit&id=<?php echo $item['product_cat_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li><a href="?mod=products&controller=cat&action=delete&id=<?php echo $item['product_cat_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                                <td><span class="tbody-text"><?php echo $item['level']; ?></span></td>
                                <td><span class="tbody-text"><?php echo $item['fullname']; ?></span></td>
                                <td><span class="tbody-text"><?php echo $item['created_date']; ?></span></td>
                            </tr>
                                <?php
                                endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    else:
                        ?>
                    <p style="text-align: center; font-size: 18px">Không có danh mục sản phẩm</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo get_pagging($num_page, $page, "?mod=products&controller=cat"); ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
