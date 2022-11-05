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
                        <h3 id="index" class="fl-left">Cập nhật danh mục bài viết</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="post_cat_name" id="title" value="<?php echo $info_cat_post['post_cat_name']; ?>">
                            <?php echo form_error('post_cat_name') ?>

                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" value="<?php echo $info_cat_post['slug']; ?>">
                            <?php echo form_error('slug') ?>

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