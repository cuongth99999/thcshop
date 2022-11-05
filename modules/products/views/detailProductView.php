<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="san-pham.html" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <?php
                    if (!empty($product_item)):
                ?>
                        <div class="section-detail clearfix">
                            <div class="thumb-wp fl-left">
                                <a href="" title="" id="main-thumb">
                                    <img style="width: 350px; height: 350px; " id="zoom" src="<?php echo $product_item['thumbnail']; ?>" data-zoom-image="<?php echo $product_item['thumbnail']; ?>"/>
                                </a>
                                <?php
                                    if (!empty($list_product_images)):
                                ?>
                                <div id="list-thumb">
                                    <?php foreach ($list_product_images as $imageItem): ?>
                                    <div style="border: 1px solid #cdcdcd;"><img style="height: 56px" src="<?php echo $imageItem['image']; ?>" /></div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="thumb-respon-wp fl-left">
                                <img src="public/images/img-pro-01.png" alt="">
                            </div>
                            <div class="info fl-right">
                                <h3 class="product-name"><?php echo $product_item['product_name']; ?></h3>
                                <div class="desc">
                                    <?php echo $product_item['product_desc']; ?>
                                </div>
                                <div class="num-product">
                                    <span class="title">Sản phẩm: </span>
                                    <?php if ($product_item['num_stock'] > 0) {
                                        echo '<span class="status">Còn '.$product_item['num_stock'].' sản phẩm</span>';
                                    } else {
                                        echo '<span class="status">Hết hàng</span>';
                                    }
                                    ?>
                                </div>
                                <p class="price"><?php echo currency_format($product_item['price']); ?></p>
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="qty" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <a href="?mod=cart&action=add&id=<?php echo $product_item['id']; ?>&qty=1" title="Thêm giỏ hàng" id="add_cart_detail" class="add-cart">Thêm giỏ hàng</a>
                            </div>
                        </div>
                <?php
                    endif;
                ?>
            </div>
            <?php
            if (!empty($product_item)):
                ?>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $product_item['product_content']; ?>
                </div>
            </div>
            <?php
                endif;
            ?>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <?php
                        if (!empty($list_product_same_brands)):
                    ?>
                    <ul class="list-item">
                        <?php foreach ($list_product_same_brands as $item): ?>
                        <li>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="thumb">
                                <img src="<?php echo $item['thumbnail']; ?>">
                            </a>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" style="
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']); ?></span>
                                <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <?php
                    if (!empty($list_product_category)) {
                        show_categories_home($list_product_category);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

