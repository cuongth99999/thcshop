<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=contact" title="">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
            <?php if (!empty($page_intro))
                echo $page_intro['page_desc'];
            ?>
            </div>
        </div>
        <div class="sidebar fl-left">
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
                                    <a href="?mod=products&action=detail&product_id=<?php echo $item['id']; ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo $item['thumbnail']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?mod=products&action=detail&product_id=<?php echo $item['id']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($item['price']); ?></span>
                                            <span class="old"><?php echo currency_format($item['price']/0.9); ?></span>
                                        </div>
                                        <a href="" title="" class="buy-now">Mua ngay</a>
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