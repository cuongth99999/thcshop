<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="gio-hang.html" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php
            if (!empty($list_buy)):
        ?>
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <form action="?mod=cart&action=update" method="post">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Mã sản phẩm</td>
                        <td>Ảnh sản phẩm</td>
                        <td>Tên sản phẩm</td>
                        <td>Giá sản phẩm</td>
                        <td>Số lượng</td>
                        <td colspan="2">Thành tiền</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list_buy as $item): ?>
                    <tr>
                        <td><?php echo $item['code']; ?></td>
                        <td>
                            <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                <img src="<?php echo $item['thumbnail']; ?>" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $item['url']; ?>" title="" class="name-product"><?php echo $item['product_name']; ?></a>
                        </td>
                        <td><?php echo currency_format($item['price']); ?></td>
                        <td>
                            <input type="number" min="1" data-id="<?php echo $item['id']; ?>" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty']; ?>" class="num-order">
                        </td>
                        <td id="sub-total-<?php echo $item['id']; ?>"><?php echo currency_format($item['sub_total']); ?></td>
                        <td>
                            <a href="<?php echo $item['url_delete_cart']; ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="clearfix">
                                <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format(get_total_cart()); ?></span></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="clearfix">
                                <div class="fl-right">
                                    <input type="submit" id="update-cart" name="btn_update_cart" value="Cập nhật giỏ hàng">
                                    <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                </form>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="san-pham.html" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=cart&action=delete_all" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
        <?php else: ?>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail" style="padding-bottom: 50px;">
                        <p style="font-size: 18px; padding-bottom: 9px; display: flex; justify-content: center; align-items: center"> Chưa có sản phẩm nào trong giỏ hàng của bạn</p>
                        <p style="font-size: 18px; display: flex; justify-content: center; align-items: center">Bấm <a href="trang-chu.html" style="text-decoration: none !important; padding: 0 4px;"> Vào đây </a> để quay về trang sản phẩm</p>
                    </div>
                    <div class="section-detail" style="display: flex; justify-content: center; align-items: center">
                        <img src="public/images/cart_empty.png" alt="">
                    </div>
                </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
?>