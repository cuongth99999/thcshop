<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="dat-hang-thanh-cong.html" title="">Thông tin đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (!empty($list_orders)): ?>
    <div class="wrap clearfix wp-inner" style="padding-bottom: 20px">
        <div class="text-center">
            <span class="text-danger font-weight-bold h4 mb-2 d-block" style="margin-bottom: 9px; display: block"><i class="fa-solid fa-circle-check"></i>ĐẶT HÀNG THÀNH CÔNG</span>
            <p class="mb-0">Cảm ơn bạn <span style="font-weight: bold"><?php echo $list_orders['0']['fullname']; ?></span> đã cho chúng tôi cơ hội được cung ứng những sản phẩm cần thiết với bạn.</p>
            <p>Nhân viên của chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng, thời gian giao hàng chậm nhất là 48h.</p>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition wp-inner">
            <div class="section" id="info" style="margin-bottom: 15px; display: block">
                <div class="title h5 font-weight-bold text-danger">Mã đơn hàng: <span class="detail"><?php echo $list_orders['0']['order_code']; ?></span></div>
            </div>
            <h5 class="text-danger text-info-fil mb-1 mt-3">Thông tin khách hàng</h5>
            <div class="section">
                <div class="table-responsive table-danger" style="padding-bottom: 20px">
                    <table class="table info-exhibition">
                        <thead style="background-color: #4ffff840; border-color: #4ffff840">
                        <tr>
                            <td width="15%"><strong>Họ và tên</strong></td>
                            <td width="15%"><strong>Số điện thoại</strong></td>
                            <td width="20%"><strong>Email</strong></td>
                            <td width="30%"><strong>Địa chỉ giao hàng</strong></td>
                            <td><strong>Phương thức thanh toán</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><strong><?php echo $list_orders['0']['fullname']; ?></strong></td>
                            <td><?php echo $list_orders['0']['phone_number']; ?></td>
                            <td><?php echo $list_orders['0']['email']; ?></td>
                            <td><?php echo $list_orders['0']['address']; ?></td>
                            <td><?php echo $list_orders['0']['pay_method']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h5 class="text-danger text-info-fil mb-1 mt-3">Thông tin đơn hàng</h5>
                <div class="table-responsive table-danger">
                    <table class="table info-exhibition">
                        <thead style="background-color: #4ffff840; border-color: #4ffff840">
                        <tr>
                            <td width="10%"><strong>STT</strong></td>
                            <td><strong>Ảnh sản phẩm</strong></td>
                            <td><strong>Tên sản phẩm</strong></td>
                            <td><strong>Đơn giá</strong></td>
                            <td><strong>Số lượng</strong></td>
                            <td><strong>Thành tiền</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stt = 0;
                            $sum = 0;
                            foreach ($list_orders as $item):
                                $stt++;
                                $sum += $item['num_order']*$item['price'];
                        ?>
                        <tr>
                            <td><strong><?php echo $stt; ?></strong></td>
                            <td><img src="<?php echo $item['thumbnail']; ?>" style="width: 75px; height: auto" alt=""></td>
                            <td><?php echo $item['product_name']; ?></td>
                            <td><?php echo currency_format($item['price']); ?></td>
                            <td><?php echo $item['num_order']; ?></td>
                            <td><?php echo currency_format($item['price']*$item['num_order']); ?></td>
                        </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot style="background-color: #4ffff840; border-color: #4ffff840">
                        <tr>
                            <td colspan="5" class="thead-text text-center" style="font-size: 16px"><strong>Tổng tiền</strong></td>
                            <td class="thead-text"><strong><?php echo currency_format($sum); ?></strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    else:
    ?>
        <p class="desc" style="font-size: 18px; text-align: center">Không có sản phẩm nào được chọn mua, hãy quay lại cửa hàng để mua hàng.</p>
    <?php
    endif;
    ?>
</div>
<?php
get_footer();
?>