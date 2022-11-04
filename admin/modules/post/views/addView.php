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
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="page_title" id="title" value="<?php echo !empty($_POST['page_title'])?$_POST['page_title']:false; ?>">
                        <?php echo form_error('page_title') ?>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug'); ?>">
                        <?php echo form_error('slug') ?>

                        <label for="desc">Mô tả</label>
                        <textarea name="page_desc" id="desc" class="ckeditor"><?php echo !empty($_POST['page_desc'])?$_POST['page_desc']:false; ?></textarea>
                        <?php echo form_error('page_desc') ?>

                        <label for="status">Trạng thái</label>
                        <select name="page_status" id="status" style="width: 250px; height: 40px">
                            <option value="0">Chọn trạng thái</option>
                            <option value="Đã duyệt" <?php echo !empty(($_POST['page_status']))&& ($_POST['page_status'])=='Đã duyệt'?'selected':false; ?>>Duyệt</option>
                            <option value="Chờ duyệt" <?php echo !empty(($_POST['page_status'])) && ($_POST['page_status'])=='Chờ duyệt'?'selected':false; ?>>Chờ xét duyệt</option>
                        </select>
                        <?php echo form_error('page_status') ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                        </div>
                        <?php echo form_error('file') ?>

                        <button type="submit" name="btn-add-page" id="btn-submit">Thêm trang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>