<?php
get_header();
?>
    <div id="main-content-wp" class="clearfix category-product-page">
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
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Sản phẩm</h3>
                        <div class="filter-wp fl-right">
<!--                            <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>-->
                            <div class="form-filter">
                                <form method="POST" action="">
                                    <select name="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                        <option value="">Sắp xếp giá</option>
                                        <option <?php echo isset($_GET['sort'])&&$_GET['sort'] == 'desc'?'selected':false ?> value="?mod=products<?php echo isset($_GET['price'])?'&price='.$_GET['price']:false; ?><?php echo isset($_GET['brand'])?'&brand='.$_GET['brand']:false; ?><?php echo isset($_GET['name'])?'&name='.$_GET['name']:false; ?>&field=price&sort=desc">Giá cao đến thấp</option>
                                        <option <?php echo isset($_GET['sort'])&&$_GET['sort'] == 'asc'?'selected':false ?> value="?mod=products<?php echo isset($_GET['price'])?'&price='.$_GET['price']:false; ?><?php echo isset($_GET['brand'])?'&brand='.$_GET['brand']:false; ?><?php echo isset($_GET['name'])?'&name='.$_GET['name']:false; ?>&field=price&sort=asc">Giá thấp đến cao</option>
                                    </select>
<!--                                    <button type="submit">Lọc</button>-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                                if (!empty($list_products)):
                                    foreach ($list_products as $item):
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
                                    <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="thanh-toan-<?php echo $item['slug']; ?>-<?php echo $item['id']; ?>.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <?php endforeach;
                                else:
                            ?>
                                    <img src="public/images/no-product-found.png" alt="">
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <?php
                    if (!empty($num_page) && !empty($page)) {
                        echo get_pagging($num_page, $page, "?mod=products");
                    }
                ?>
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
                <div class="section" id="filter-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Bộ lọc</h3>
                    </div>
                    <div class="section-detail">
                        <form method="GET" action="?mod=products">
                            <?php
                                if (isset($_GET['name'])):
                                    ?>
                                    <input type="hidden" name="mod" value="products">
                                    <input type="hidden" name="name" value="<?php echo $_GET['name']; ?>">
                                <?php
                                else:
                                    ?>
                                    <input type="hidden" name="mod" value="products">
                                <?php
                                endif;
                            ?>
                            <table>
                                <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="radio" name="price" value="500000" <?php echo isset($_GET['price'])&&$_GET['price'] == 500000?'checked':false ?>></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="1000000" <?php echo isset($_GET['price'])&&$_GET['price'] == 1000000?'checked':false ?>></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="5000000" <?php echo isset($_GET['price'])&&$_GET['price'] == 5000000?'checked':false ?>></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="10000000" <?php echo isset($_GET['price'])&&$_GET['price'] == 10000000?'checked':false ?>></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="10000001" <?php echo isset($_GET['price'])&&$_GET['price'] == 10000001?'checked':false ?>></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                                </tbody>
                            </table>
                            <table>
                                <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($list_brands)):
                                    foreach ($list_brands as $item):
                                ?>
                                <tr>
                                    <td><input type="radio" name="brand" value="<?php echo $item['brand_name']; ?>"; <?php echo isset($_GET['brand'])&&$_GET['brand'] == $item['brand_name']?'checked':false ?>></td>
                                    <td><?php echo $item['brand_name']; ?></td>
                                </tr>
                                <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                            <button type="submit" style="margin-left: 62px; border: 1px solid #333; background-color: #ffffff">Lọc kết quả</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>