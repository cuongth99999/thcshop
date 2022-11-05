<?php

ini_set('display_errors', 0);
error_reporting(0);

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    load_view('index');
}

function addAction() {
    global $error, $order_code, $fullname, $email, $phone_number, $address, $note, $pay_method,
           $products, $num_order;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['order_code'])) {
            $error['order_code'] = "Không được để trống mã đơn hàng";
        } else {
            if (strlen($_POST['order_code']) <= 2) {
                $error['order_code'] = "Mã đơn hàng phải lớn hơn 2 ký tự";
            } else {
                $order_code = $_POST['order_code'];
            }
        }

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống tên khách hàng";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống địa chỉ email khách hàng";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Địa chỉ email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại khách hàng";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ giao hàng";
        } else {
            $address = $_POST['address'];
        }

        if (empty($_POST['products'])) {
            $error['products'] = "Không được để trống sản phẩm";
        } else {
            $products = $_POST['products'];
        }

        $note = $_POST['note'];

        if (empty($_POST['pay_method'])) {
            $error['pay_method'] = "Phương thức thanh toán phải được chọn";
        } else {
            $pay_method = $_POST['pay_method'];
        }

        if (empty($error)) {
            // Xử lý sản phẩm
            $products = str_replace(' ', '', $_POST['products']);
            $productArr = explode(',', $products);

            $productItemArr = array();
            foreach ($productArr as $key => $value) {
                $productItemArr[] = explode(':', $value);
            }

            $productLast = array();
            foreach ($productItemArr as $key => $value) {
                $productLast[$value[0]] = $value[1];
            }

            $listProducts = array();
            $listNumOrder = array();
            foreach ($productLast as $key => $value) {
                $listProducts[] = get_product_by_code("{$key}");
                $listNumOrder[] = $value;
            };

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
                $dataOrder = array(
                    'order_code' => $order_code,
                    'customer_id' => $insertCustomerId,
                    'pay_method' => $pay_method,
                    'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
                );
                $insertOrderId = add_order($dataOrder);

                if ($insertOrderId != 0) {
                    for ($i=0; $i<count($listProducts); $i++) {
                        $dataDetailOrder = array(
                            'order_id' => $insertOrderId,
                            'product_id' => $listProducts[$i]['id'],
                            'num_order' => $listNumOrder[$i]
                        );
                        add_detail_order($dataDetailOrder);

                        // Lấy dữ liệu số hàng còn trong kho
                        $num_stock = get_product_by_id($listProducts[$i]['id'])['num_stock'];
                        $num_stock_new = $num_stock - $listNumOrder[$i];
                        $dataUpdateNumStock = array(
                            'num_stock' => $num_stock_new
                        );
                        update_numstock_product($listProducts[$i]['id'], $dataUpdateNumStock);
                    }
                    redirect("?mod=orders");
                }
            }
        }
    }

    load_view('add');
}

function customersAction() {

    load_view('customers');
}

function detail_orderAction() {
    load('helper','format');

    if (isset($_POST['sm_status'])) {
        if (!empty($_GET['id'])) {
            $order_id = $_GET['id'];
        }

        if (!empty($_POST['status'])) {
            $dataUpdate = array(
                'status' => $_POST['status']
            );
        }

        update_orders($order_id, $dataUpdate);
    }


    load_view('detail_order');
}
