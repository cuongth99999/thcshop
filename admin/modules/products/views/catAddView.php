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
                        <h3 id="index" class="fl-left">Thêm danh mục sản phẩm</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST">
                            <label for="title">Tên danh mục</label>
                            <input type="text" name="product_cat_name" id="title" value="<?php echo !empty($_POST['product_cat_name'])?$_POST['product_cat_name']:false; ?>">
                            <?php echo form_error('product_cat_name') ?>

                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" value="<?php echo !empty($_POST['slug'])?$_POST['slug']:false; ?>">
                            <?php echo form_error('slug') ?>

                            <label>Danh mục cha</label>
                            <select name="product_cat_level">
                                <option value="0">Chọn danh mục cha</option>
                                <?php
                                $list_cat_product = get_list_cats();
                                echo '<pre>';
                                print_r($list_cat_product);
                                echo '</pre>';
                                if (!empty($list_cat_product)):
                                    foreach ($list_cat_product as $item):
                                        $num_repeat = $item['level'] - 1;
                                        ?>
                                        <option value="<?php echo $item['level']; ?>" style="<?php if ($item['level']==1) echo 'background: #ddd'; ?>" <?php echo !empty(($_POST['product_cat_id'])) && ($_POST['product_cat_id'])==$item['product_cat_id']?'selected':false; ?>><?php echo  str_repeat('--', $num_repeat).' '.$item['product_cat_name']; ?></option>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                            <p style="font-style: italic">*Nếu không chọn danh mục cha, thì danh mục mới thêm sẽ làm danh mục cha</p> <br>

                            <button type="submit" name="btn-add" id="btn-submit">Thêm danh mục</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>