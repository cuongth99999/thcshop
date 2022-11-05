<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="bai-viet.html" title="">Bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_posts)): ?>
                    <ul class="list-item">
                        <?php foreach ($list_posts as $item): ?>
                        <li class="clearfix">
                            <a href="bai-viet/<?php echo $item['post_slug']; ?>-<?php echo $item['post_id'] ?>.html" title="" class="thumb fl-left">
                                <img src="<?php echo $item['post_thumbnail']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="bai-viet/<?php echo $item['post_slug']; ?>-<?php echo $item['post_id'] ?>.html" title="" class="title"><?php echo $item['post_title']; ?></a>
                                <span class="create-date"><?php echo date_format(date_create($item['created_date']), 'd/m/Y'); ?></span>
                                <p class="desc"><?php echo $item['post_desc']; ?></p>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            if (!empty($num_page) && !empty($page)) {
                echo get_pagging($num_page, $page, "bai-viet");
            }
            ?>
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