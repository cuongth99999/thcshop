<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                        if (!empty($list_sliders)):
                            foreach ($list_sliders as $item):
                    ?>
                    <div class="item">
                        <img src="<?php echo $item['image']; ?>" alt="">
                    </div>
                    <?php
                            endforeach;
                            endif;
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        if (!empty($list_product_featured)):
                            foreach ($list_product_featured as $item):
                        ?>
                        <li>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="thumb">
                                <img src="<?php echo $item['thumbnail']; ?>">
                            </a>
                            <a style="
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;" href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']); ?></span>
                                <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        if (!empty($list_product_telephone)):
                            foreach ($list_product_telephone as $item):
                        ?>
                        <li>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="thumb">
                                <img src="<?php echo $item['thumbnail']; ?>">
                            </a>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']); ?></span>
                                <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        if (!empty($list_product_laptop)):
                            foreach ($list_product_laptop as $item):
                        ?>
                        <li>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="thumb">
                                <img src="<?php echo $item['thumbnail']; ?>">
                            </a>
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']); ?></span>
                                <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Phụ kiện</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        if (!empty($list_product_accessory)):
                            foreach ($list_product_accessory as $item):
                                ?>
                                <li>
                                    <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="thumb">
                                        <img src="<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php endforeach; endif; ?>
                    </ul>
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
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        if (!empty($list_product_bestseller)):
                            foreach ($list_product_bestseller as $item):
                        ?>
                        <li class="clearfix">
                            <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="thumb fl-left">
                                <img src="<?php echo $item['thumbnail']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="san-pham/<?php echo $item['slug']; ?>-<?php echo $item['id'] ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                                </div>
                                <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>