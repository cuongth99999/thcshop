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
        $filter .= " $operator post_title LIKE '%$keyword%' OR post_title LIKE '%$keyword%'";
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

    $filter.= "WHERE post_status='{$status}'";
}

$num_posts_solved = db_num_rows("SELECT * FROM `tbl_posts` WHERE post_status='Đã duyệt'");
$num_posts_pending = db_num_rows("SELECT * FROM `tbl_posts` WHERE post_status='Chờ duyệt'");

$num_page = db_num_rows("SELECT * FROM `tbl_posts`");

// Số lượng bản ghi trên trang
$num_rows = db_num_rows("SELECT * FROM `tbl_posts`");

$num_per_page = 5;
$total_row = $num_rows;
$num_page = ceil($total_row/$num_per_page);

$page = isset($_GET['page'])?(int)$_GET['page']:1;

$start = ($page - 1)*$num_per_page;

// Hiển thị danh sách theo trang
$list_posts = get_posts($start, $num_per_page, $filter);
?>
    <div id="main-content-wp" class="list-post-page">
        <div class="wrap clearfix">
            <?php
            get_sidebar();
            ?>
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                        <a href="?mod=posts&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="?mod=posts">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                                <li class="publish"><a href="?mod=posts&status=1">Đã duyệt <span class="count">(<?php echo $num_posts_solved; ?>)</span></a> |</li>
                                <li class="pending"><a href="?mod=posts&status=2">Chờ duyệt <span class="count">(<?php echo $num_posts_pending; ?>)</span> |</a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right">
                                <input type="hidden" name="mod" value="posts">
                                <input type="text" name="keyword" id="">
                                <input type="submit" name="btn-search" id="" value="Tìm kiếm">
                            </form>
                        </div>
                        <?php
                        if (!empty($list_posts)):
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td width="20%"><span class="thead-text">Tiêu đề</span></td>
                                    <td width="10%"><span class="thead-text">Nội dung</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian tạo</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stt = $start;
                                foreach ($list_posts as $item):
                                    $stt++;
                                ?>
                                <tr>
                                    <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['post_title']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=posts&action=edit&id=<?php echo $item['post_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=posts&action=delete&id=<?php echo $item['post_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td width="40%"><span class="tbody-text" style="display: -webkit-box;
                            max-height: 3.2rem;
                           -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: normal;
                            -webkit-line-clamp: 2;
                            line-height: 1.6rem; "><?php echo $item['post_desc']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['post_cat_name']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['post_status']; ?></span></td>
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
                            <p style="text-align: center; font-size: 18px">Không có bài viết</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                echo get_pagging($num_page, $page, "?mod=posts");
                ?>
            </div>
        </div>
    </div>
<?php
get_footer();
?>
