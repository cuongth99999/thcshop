<?php
get_header();

if (!empty($_GET['id'])) {
    $order_id = $_GET['id'];
}

$detail_order = get_order_by_id($order_id);

$order_code = $detail_order[0]['order_code'];
$phone_number = $detail_order[0]['phone_number'];
$address = $detail_order[0]['address'];
$pay_method = strtolower($detail_order[0]['pay_method']);
$status = $detail_order[0]['status'];

$sum_order = 0;
$sum_price = 0;
foreach ($detail_order as $item) {
    $sum_order += $item['num_order'];
    $sum_price += $item['price']*$item['num_order'];
}

?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
            get_sidebar();
        ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $order_code;?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng | Số điện thoại</h3>
                        <span class="detail"><?php echo $address.' | '.$phone_number ?></span>
                    </li>
                    <li>
                        <h3 class="title">Phương thức thanh toán</h3>
                        <span class="detail">Thanh toán <?php echo $pay_method;?></span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                                <option value="Chờ duyệt đơn" <?php echo $status=='Chờ duyệt đơn'?'selected':false; ?>>Chờ duyệt đơn</option>
                                <option value="Đang giao hàng" <?php echo $status=='Đang giao hàng'?'selected':false; ?>>Đang giao hàng</option>
                                <option value="Thành công" <?php echo $status=='Thành công'?'selected':false; ?>>Thành công</option>
                                <option value="Đơn bị hủy" <?php echo $status=='Đơn bị hủy'?'selected':false; ?>>Đơn bị hủy</option>
                            </select>
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <?php if (!empty($detail_order)): ?>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                        <tr>
                            <td class="thead-text">STT</td>
                            <td class="thead-text">Ảnh sản phẩm</td>
                            <td class="thead-text">Tên sản phẩm</td>
                            <td class="thead-text">Đơn giá</td>
                            <td class="thead-text">Số lượng</td>
                            <td class="thead-text">Thành tiền</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stt = 0;
                            foreach ($detail_order as $item):
                                $stt++;
                        ?>
                        <tr>
                            <td class="thead-text"><?php echo $stt; ?></td>
                            <td class="thead-text">
                                <div class="thumb">
                                    <img src="<?php echo $item['thumbnail']; ?>" alt="">
                                </div>
                            </td>
                            <td class="thead-text"><?php echo $item['product_name']; ?></td>
                            <td class="thead-text"><?php echo currency_format($item['price']); ?></td>
                            <td class="thead-text"><?php echo $item['num_order']; ?></td>
                            <td class="thead-text"><?php echo currency_format($item['num_order']*$item['price']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $sum_order; ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($sum_price); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
get_footer();
?>