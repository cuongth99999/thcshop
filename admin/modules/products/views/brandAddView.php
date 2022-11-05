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
                        <h3 id="index" class="fl-left">Thêm hãng sản xuất</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST">
                            <label for="title">Tên hãng sản xuất</label>
                            <input type="text" name="brand_name" id="title" value="<?php echo !empty($_POST['brand_name'])?$_POST['brand_name']:false; ?>">
                            <?php echo form_error('brand_name') ?>

                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" value="<?php echo !empty($_POST['slug'])?$_POST['slug']:false; ?>">
                            <?php echo form_error('slug') ?>

                            <button type="submit" name="btn-add" id="btn-submit">Thêm hãng sản xuất</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>