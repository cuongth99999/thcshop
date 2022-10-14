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

$num_user = db_num_rows("SELECT * FROM `tbl_users`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_users`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_users = get_users($start, $num_per_page, $filter);
?>
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách quản trị viên</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo !empty($num_user)?$num_user:false; ?>)</span></a> |</li>
                        </ul>
                        <form method="GET" class="form-s fl-right" action="">
                            <input type="hidden" name="mod" value="users">
                            <input type="hidden" name="controller" value="team">
                            <input type="text" name="keyword" id="">
                            <input type="submit" name="btn-search" id="" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_users)):
                    ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">ID</span></td>
                                <td><span class="thead-text">Họ tên</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Số điện thoại</span></td>
                                <td><span class="thead-text">Địa chỉ</span></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $stt = 0;
                                foreach ($list_users as $item):
                                    $stt++;
                            ?>
                            <tr>
                                <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                <td><span class="tbody-text"><?php echo $item['user_id']; ?></span></td>
                                <td class="clearfix">
                                    <div class="tb-title fl-left">
                                        <a href="" title=""><?php echo $item['fullname']; ?></a>
                                    </div>
                                </td>
                                <td><span class="tbody-text"><?php echo $item['email']; ?></span></td>
                                <td><span class="tbody-text"><?php echo $item['phone_number']; ?></span></td>
                                <td><span class="tbody-text"><?php echo $item['address']; ?></span></td>
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
                        <p style="text-align: center; font-size: 18px">Không có quản trị viên</p>
                        <?php endif; ?>
                </div>
            </div>
            <?php
                echo get_pagging($num_page, $page, "?mod=users&controller=team");
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>