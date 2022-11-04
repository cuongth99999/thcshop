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
                        <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST" enctype="multipart/form-data">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="product_name" id="title" value="<?php echo $info_product['product_name']; ?>">
                            <?php echo form_error('product_name') ?>

                            <label for="title">Mã sản phẩm</label>
                            <input type="text" name="code" id="title" value="<?php echo $info_product['code']; ?>">
                            <?php echo form_error('code') ?>

                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" value="<?php echo $info_product['slug']; ?>">
                            <?php echo form_error('slug') ?>

                            <label for="title">Giá sản phẩm</label>
                            <input type="text" name="price" id="slug" value="<?php echo $info_product['price']; ?>">
                            <?php echo form_error('price') ?>

                            <label for="title">Sản phẩm trong kho</label>
                            <input type="text" name="num_stock" id="slug" value="<?php echo $info_product['num_stock']; ?>">
                            <?php echo form_error('num_stock') ?>

                            <label for="title">Mô tả ngắn</label>
                            <textarea name="product_desc" id="desc" class=""><?php echo $info_product['product_desc']; ?></textarea>
                            <?php echo form_error('product_desc') ?>

                            <label for="desc">Nội dung</label>
                            <textarea name="product_content" id="desc" class="ckeditor"><?php echo $info_product['product_content']; ?></textarea>
                            <?php echo form_error('product_content') ?>

                            <label style="margin-top: 40px" for="title">Thumbnail</label>
                            <div style="display: flex; align-items: center">
                                <input style="margin-bottom: 53px" type="text" name="thumbnail" id="url" value="<?php echo $info_product['thumbnail']; ?>">
                                <button style="margin-left: 20px; padding: 6px 20px" type="button" onclick="openPopup()">Chọn ảnh</button>
                            </div>
                            <?php echo form_error('thumbnail') ?>

                            <div style="margin-bottom: 35px; margin-top: 35px">
                                <label>Hình ảnh</label>
                                <div id="uploadFile">
                                    <input type="file" multiple="multiple" name="fileupload[]" id="upload-thumb">
                                </div>
                                <?php echo form_error('file') ?>
                            </div>

                            <label>Hãng sản xuât</label>
                            <select name="brand_id" style="width: 250px; height: 40px">
                                <option value="0">Chọn hãng</option>
                                <?php
                                $list_brands = get_info_brand();
                                if (!empty($list_brands)):
                                    foreach ($list_brands as $item):
                                        ?>
                                        <option value="<?php echo $item['brand_id']; ?>" <?php echo $info_product['brand_id']==$item['brand_id']?'selected':false; ?>  <?php echo !empty(($_POST['brand_id'])) && ($_POST['brand_id'])==$item['brand_id']?'selected':false; ?>><?php echo  $item['brand_name']; ?></option>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <?php echo form_error('brand_id') ?>

                            <label>Danh mục sản phẩm</label>
                            <select name="product_cat_id" style="width: 250px; height: 40px">
                                <option value="0">Chọn danh mục</option>
                                <?php
                                $list_cat_product = get_info_cat_product();
                                if (!empty($list_cat_product)):
                                    foreach ($list_cat_product as $item):
                                        $num_repeat = $item['level'] - 1;
                                        ?>
                                        <option value="<?php echo $item['product_cat_id']; ?>" <?php echo $info_product['product_cat_id']==$item['product_cat_id']?'selected':false; ?> style="<?php if ($item['level']==1) echo 'background: #ddd'; ?>" <?php echo !empty(($_POST['product_cat_id'])) && ($_POST['product_cat_id'])==$item['product_cat_id']?'selected':false; ?>><?php echo  str_repeat('--', $num_repeat).' '.$item['product_cat_name']; ?></option>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <?php echo form_error('product_cat_id') ?>

                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" style="width: 250px; height: 40px">
                                <option value="0">Chọn trạng thái</option>
                                <option value="Đã duyệt" <?php echo $info_product['status']=='Đã duyệt'?'selected':false; ?>>Duyệt</option>
                                <option value="Chờ duyệt" <?php echo $info_product['status']=='Chờ duyệt'?'selected':false; ?>>Chờ xét duyệt</option>
                            </select>
                            <?php echo form_error('status') ?>

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