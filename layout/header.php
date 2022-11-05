<!DOCTYPE html>
<html>
<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/reset.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/style.css" rel="stylesheet" type="text/css"/>
    <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

    <script src="public/js/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>
<body>
<div id="site">
    <div id="container">
        <div id="header-wp">
            <div id="head-top" class="clearfix">
                <div class="wp-inner">
                    <a href="trang-chu.html" title="" id="payment-link" class="fl-left">Vươn tầm thế giới</a>
                    <div id="main-menu-wp" class="fl-right">
                        <ul id="main-menu" class="clearfix">
                            <li>
                                <a href="trang-chu.html" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="san-pham.html" title="">Sản phẩm</a>
                            </li>
                            <li>
                                <a href="bai-viet.html" title="">Bài viết</a>
                            </li>
                            <li>
                                <a href="gioi-thieu.html" title="">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="lien-he.html" title="">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="head-body" class="clearfix">
                <div class="wp-inner">
                    <a href="trang-chu.html" title="" id="logo" class="fl-left"><img src="public/images/logo.png"/></a>
                    <div id="search-wp" class="fl-left">
                        <form method="GET" action="?mod=products">
                            <input type="hidden" name="mod" value="products">
                            <input type="text" value="<?php echo !empty($_GET['name'])?$_GET['name']:false; ?>" name="name" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                            <input type="submit" value="Tìm kiếm" style="position: relative;
    left: -4px;
    display: inline-block;
    border: none;
    outline: none;
    background: #111111;
    color: #fff;
    padding: 10px 20px;
    line-height: 13px;
    font-size: 13px;">
<!--                            <button type="submit" id="sm-s">Tìm kiếm</button>-->
                        </form>
                    </div>
                    <div id="action-wp" class="fl-right">
                        <div id="advisory-wp" class="fl-left">
                            <span class="title">Tư vấn</span>
                            <span class="phone">0987.654.321</span>
                        </div>
                        <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                        <a href="gio-hang.html" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
<!--                            <span id="num">2</span>-->
                        </a>
                        <div id="cart-wp" class="fl-right">
                            <div id="btn-cart">
                                <a href="gio-hang.html" style="color: #ffffff;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                <?php
                                $num_order = get_num_order_cart();
                                if ($num_order > 0):
                                    ?>
                                    <span id="num"><?php echo $num_order; ?></span>
                                <?php
                                else:
                                    ?>
                                    <span id="num">0</span>
                                <?php
                                endif;
                                ?>
                            </div>
                            <div id="dropdown">
                                <?php
                                if ($num_order > 0):
                                ?>
                                <p class="desc">Có <span><?php echo $num_order; ?> sản phẩm</span> trong giỏ hàng</p>
                                <?php
                                else:
                                    ?>
                                    <p class="desc">Có <span>0 sản phẩm</span> trong giỏ hàng</p>
                                <?php
                                endif;
                                ?>
                                <?php
                                $list_buy = get_list_buy_cart();
                                if (!empty($list_buy)):
                                ?>
                                <ul class="list-cart" style="height: 276px; overflow: auto">
                                    <?php foreach ($list_buy as $item): ?>
                                    <li class="clearfix">
                                        <a href="<?php echo $item['url']; ?>" title="" class="thumb fl-left">
                                            <img src="<?php echo $item['thumbnail']; ?>" alt="">
                                        </a>
                                        <div class="info fl-right">
                                            <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                            <p class="price"><?php echo currency_format($item['price']); ?></p>
                                            <p class="qty">Số lượng: <span><?php echo $item['qty']; ?></span></p>
                                        </div>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                                <?php else: ?>
                                <img style="padding-bottom: 20px" src="public/images/cart_empty.png" alt="">
                                <?php endif; ?>
                                <div class="total-price clearfix">
                                    <p class="title fl-left">Tổng:</p>
                                    <p class="price fl-right"><?php echo !empty($_SESSION['cart']['buy'])?currency_format($_SESSION['cart']['info']['total']):'0 VNĐ'; ?></p>
                                </div>
                                <dic class="action-cart clearfix">
                                    <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                    <?php
                                    if ($num_order > 0):
                                    ?>
                                    <a href="thanh-toan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    <?php endif; ?>
                                </dic>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>