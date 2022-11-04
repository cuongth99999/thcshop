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
                        <h3 id="index" class="fl-left">Cập nhật bài viết</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST" enctype="multipart/form-data">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="post_title" id="title" value="<?php echo $info_post['post_title']; ?>">
                            <?php echo form_error('post_title') ?>

                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="post_slug" id="slug" value="<?php echo $info_post['post_slug']; ?>">
                            <?php echo form_error('post_slug') ?>

                            <label for="desc">Nội dung</label>
                            <textarea name="post_desc" id="desc" class="ckeditor"><?php echo $info_post['post_desc']; ?></textarea>
                            <?php echo form_error('post_desc') ?>

                            <label for="status">Trạng thái</label>
                            <select name="post_status" id="status" style="width: 250px; height: 40px">
                                <option value="0">Chọn trạng thái</option>
                                <option value="Đã duyệt" <?php echo $info_post['post_status']=='Đã duyệt'?'selected':false; ?>>Duyệt</option>
                                <option value="Chờ duyệt" <?php echo $info_post['post_status']=='Chờ duyệt'?'selected':false; ?>>Chờ xét duyệt</option>
                            </select>
                            <?php echo form_error('post_status') ?>

                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="file" id="upload-thumb" value="<?php echo $info_post['post_thumbnail']; ?>">
                            </div>
                            <?php echo form_error('file') ?>

                            <label>Danh mục bài viết</label>
                            <select name="post_cat_id">
                                <option value="0">-- Chọn danh mục --</option>
                                <?php
                                $list_cat_post = get_info_cat_post();
                                if (!empty($list_cat_post)):
                                    foreach ($list_cat_post as $item):
                                        ?>
                                        <option value="<?php echo  $item['post_cat_id']; ?>" <?php echo $info_post['post_cat_id']==$item['post_cat_id']?'selected':false; ?>><?php echo  $item['post_cat_name']; ?></option>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <?php echo form_error('post_cat_id') ?>

                            <button type="submit" name="btn-edit" id="btn-submit">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>