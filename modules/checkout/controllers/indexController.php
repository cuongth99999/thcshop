<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    $list_buy = get_list_buy_cart();

    $data = array(
        'list_buy' => $list_buy,
    );

    global $error, $fullname, $email, $phone_number, $address, $note, $pay_method;
    if (isset($_POST['btn-checkout'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống địa chỉ email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Địa chỉ email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ giao hàng";
        } else {
            $address = $_POST['address'];
        }

        $note = $_POST['note'];

        if (empty($_POST['pay_method'])) {
            $error['pay_method'] = "Phương thức thanh toán phải được chọn";
        } else {
            $pay_method = $_POST['pay_method'];
        }

        if (empty($error)) {
            // Xử lý update
            $dataCustomer = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'note' => $note
            );

            $insertCustomerId = add_customer($dataCustomer);

            if ($insertCustomerId != 0) {
                $max_order_id = get_max_order_id()['max_order_id'];

                $oderCode = "THC#ĐH".$max_order_id+1;

                $dataOrder = array(
                    'customer_id' => $insertCustomerId,
                    'order_code' => $oderCode,
                    'pay_method' => $pay_method,
                    'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
                );
                $insertOrderId = add_order($dataOrder);

                if ($insertOrderId != 0) {
                    foreach ($list_buy as $item) {
                        $dataDetailOrder = array(
                            'order_id' => $insertOrderId,
                            'product_id' => $item['id'],
                            'num_order' => $item['qty']
                        );
                        add_detail_order($dataDetailOrder);

                        // Lấy dữ liệu số hàng còn trong kho
                        $num_stock = get_product_by_id($item['id'])['num_stock'];
                        $num_stock_new = $num_stock - $item['qty'];
                        $dataUpdateNumStock = array(
                            'num_stock' => $num_stock_new
                        );
                        update_numstock_product($item['id'], $dataUpdateNumStock);
                    }

                    $subject = 'Thông báo đơn hàng '.$oderCode.' của quý khách đã được tiếp nhận';

                    $content = '<div class="wrap clearfix wp-inner" style="padding-bottom: 20px">
        <div class="text-center">
            <span class="text-danger font-weight-bold h4 mb-2 d-block" style="margin-bottom: 9px; display: block"><i class="fa-solid fa-circle-check"></i>ĐẶT HÀNG THÀNH CÔNG</span>
            <p class="mb-0">Cảm ơn bạn <span style="font-weight: bold">'.$fullname.'</span> đã cho chúng tôi cơ hội được cung ứng những sản phẩm cần thiết với bạn.</p>
            <p>Nhân viên của chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng, thời gian giao hàng chậm nhất là 48h.</p>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition wp-inner">
            <div class="section" id="info" style="margin-bottom: 15px; display: block">
                <div class="title h5 font-weight-bold text-danger">Mã đơn hàng: <span class="detail">'.$oderCode.'</span></div>
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
                            <td><strong>'.$fullname.'</strong></td>
                            <td>'.$phone_number.'</td>
                            <td>'.$email.'</td>
                            <td>'.$address.'</td>
                            <td>'.$pay_method.'</td>
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
                            <td><strong>Tên sản phẩm</strong></td>
                            <td><strong>Đơn giá</strong></td>
                            <td><strong>Số lượng</strong></td>
                            <td><strong>Thành tiền</strong></td>
                        </tr>
                        </thead>
                        <tbody>';

                    $stt = 0;
                    foreach ($list_buy as $item) {
                        $stt++;
                        $content .= '<tr>
                            <td><strong>'.$stt.'</strong></td>
                            <td>'.$item['product_name'].'</td>
                            <td>'.currency_format($item['price']).'</td>
                            <td>'.$item['qty'].'</td>
                            <td>'.currency_format($item['price']*$item['qty']).'</td>
                        </tr>';
                    }

                    $content .= '</tbody>
                        <tfoot style="background-color: #4ffff840; border-color: #4ffff840">
                        <tr>
                            <td colspan="4" class="thead-text text-center" style="font-size: 16px"><strong>Tổng tiền</strong></td>
                            <td class="thead-text"><strong>'.currency_format(get_total_cart()).'</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>';

                    send_mail($email, $fullname, $subject, $content);

                    unset($_SESSION['cart']);

                    redirect("dat-hang-thanh-cong.html");
                }
            }
        }
    }

    load_view('index', $data);
}

function buy_detailAction() {
    load('helper','format');

    $id = (int)$_GET['id'];

    $item = get_product_by_id($id);

    $data = array(
      'item' => $item
    );

    global $error, $fullname, $email, $phone_number, $address, $note, $pay_method;
    if (isset($_POST['btn-checkout'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống địa chỉ email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Địa chỉ email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ giao hàng";
        } else {
            $address = $_POST['address'];
        }

        $note = $_POST['note'];

        if (empty($_POST['pay_method'])) {
            $error['pay_method'] = "Phương thức thanh toán phải được chọn";
        } else {
            $pay_method = $_POST['pay_method'];
        }

        if (empty($error)) {
            // Xử lý update
            $dataCustomer = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'note' => $note
            );

            $insertCustomerId = add_customer($dataCustomer);

            if ($insertCustomerId != 0) {
                $max_order_id = get_max_order_id()['max_order_id'];

                $oderCode = "THC#ĐH".$max_order_id+1;

                $dataOrder = array(
                    'customer_id' => $insertCustomerId,
                    'order_code' => $oderCode,
                    'pay_method' => $pay_method,
                    'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
                );
                $insertOrderId = add_order($dataOrder);

                if ($insertOrderId != 0) {
                        $dataDetailOrder = array(
                            'order_id' => $insertOrderId,
                            'product_id' => $item['id'],
                            'num_order' => 1
                        );
                        add_detail_order($dataDetailOrder);

                        // Lấy dữ liệu số hàng còn trong kho
                        $num_stock = get_product_by_id($item['id'])['num_stock'];
                        $num_stock_new = $num_stock - 1;
                        $dataUpdateNumStock = array(
                            'num_stock' => $num_stock_new
                        );
                        update_numstock_product($item['id'], $dataUpdateNumStock);

                    $subject = 'Thông báo đơn hàng '.$oderCode.' của quý khách đã được tiếp nhận';

                    $content = '<div class="wrap clearfix wp-inner" style="padding-bottom: 20px">
        <div class="text-center">
            <span class="text-danger font-weight-bold h4 mb-2 d-block" style="margin-bottom: 9px; display: block"><i class="fa-solid fa-circle-check"></i>ĐẶT HÀNG THÀNH CÔNG</span>
            <p class="mb-0">Cảm ơn bạn <span style="font-weight: bold">'.$fullname.'</span> đã cho chúng tôi cơ hội được cung ứng những sản phẩm cần thiết với bạn.</p>
            <p>Nhân viên của chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng, thời gian giao hàng chậm nhất là 48h.</p>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition wp-inner">
            <div class="section" id="info" style="margin-bottom: 15px; display: block">
                <div class="title h5 font-weight-bold text-danger">Mã đơn hàng: <span class="detail">'.$oderCode.'</span></div>
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
                            <td><strong>'.$fullname.'</strong></td>
                            <td>'.$phone_number.'</td>
                            <td>'.$email.'</td>
                            <td>'.$address.'</td>
                            <td>'.$pay_method.'</td>
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
                            <td><strong>Tên sản phẩm</strong></td>
                            <td><strong>Đơn giá</strong></td>
                            <td><strong>Số lượng</strong></td>
                            <td><strong>Thành tiền</strong></td>
                        </tr>
                        </thead>
                        <tbody>';

                        $content .= '<tr>
                            <td><strong>1</strong></td>
                            <td>'.$item['product_name'].'</td>
                            <td>'.currency_format($item['price']).'</td>
                            <td>1</td>
                            <td>'.currency_format($item['price']).'</td>
                        </tr>';


                    $content .= '</tbody>
                        <tfoot style="background-color: #4ffff840; border-color: #4ffff840">
                        <tr>
                            <td colspan="4" class="thead-text text-center" style="font-size: 16px"><strong>Tổng tiền</strong></td>
                            <td class="thead-text"><strong>'.currency_format($item['price']).'</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>';

                    send_mail($email, $fullname, $subject, $content);

                    unset($_SESSION['cart']);

                    redirect("dat-hang-thanh-cong.html");
                }
            }
        }
    }

    load_view('buy_detail', $data);
}

function successAction() {
    load('helper','format');

    $list_orders = get_order_last();

    $data = array(
        'list_orders' => $list_orders
    );

    load_view('success', $data);
}

