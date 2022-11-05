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
                    <h3 id="index" class="fl-left">Thêm slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên slider</label>
                        <input type="text" name="slider_name" id="title" value="<?php echo !empty($_POST['slider_name'])?$_POST['slider_name']:false; ?>">
                        <?php echo form_error('slider_name') ?>

                        <label style="margin-top: 40px" for="title">Hình ảnh</label>
                        <div style="display: flex; align-items: center">
                            <input style="margin-bottom: 53px" type="text" name="image" id="url" value="<?php echo !empty($_POST['image'])?$_POST['image']:false; ?>">
                            <button style="margin-left: 20px; padding: 6px 20px" type="button" onclick="openPopup()">Chọn ảnh</button>
                        </div>
                        <?php echo form_error('image') ?>

                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" style="width: 250px; height: 40px">
                            <option value="0">Chọn trạng thái</option>
                            <option value="Đã duyệt" <?php echo !empty(($_POST['status']))&& ($_POST['status'])=='Đã duyệt'?'selected':false; ?>>Duyệt</option>
                            <option value="Chờ duyệt" <?php echo !empty(($_POST['status'])) && ($_POST['status'])=='Chờ duyệt'?'selected':false; ?>>Chờ xét duyệt</option>
                        </select>
                        <?php echo form_error('status') ?>

                        <button type="submit" name="btn-add" id="btn-submit">Thêm slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>