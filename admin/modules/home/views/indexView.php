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
        $filter .= " $operator page_title LIKE '%$keyword%' OR page_desc LIKE '%$keyword%'";
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

    $filter.= "WHERE page_status='{$status}'";
}

$num_page_solved = db_num_rows("SELECT * FROM `tbl_pages` WHERE page_status='Đã duyệt'");
$num_page_pending = db_num_rows("SELECT * FROM `tbl_pages` WHERE page_status='Chờ duyệt'");

$num_page = db_num_rows("SELECT * FROM `tbl_pages`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_pages`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_pages = get_pages($start, $num_per_page, $filter);
?>
    <div id="main-content-wp" class="list-post-page">
        <div class="wrap clearfix">
            <?php
            get_sidebar();
            ?>
            Chào mừng Phamtuong98 đến với trang quản lý người dùng và nội dung trên website ismart
        </div>
    </div>
<?php
get_footer();
?>
