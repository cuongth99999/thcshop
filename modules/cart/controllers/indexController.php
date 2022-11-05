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

    load_view('index', $data);
}

function addAction() {
    load('helper','format');

    $id = (int)$_GET['id'];
    $qty = !empty($_GET['qty'])?(int)$_GET['qty']:1;

    add_cart($id, $qty);

    update_info_cart();

    redirect('gio-hang.html');
}

function delete_allAction() {
    load('helper','format');

    delete_cart();

    redirect("gio-hang.html");
}

function deleteAction() {
    load('helper','format');

    $id = (int)$_GET['id'];

    delete_cart($id);

    redirect("gio-hang.html");
}

function updateAction() {
    if (isset($_POST['btn_update_cart'])) {

        update_cart($_POST['qty']);

        update_info_cart();

        redirect("gio-hang.html");
    }
}

function update_ajaxAction() {
    load('helper','format');

    $id = !empty($_POST['id'])?$_POST['id']:"";
    $qty = !empty($_POST['qty'])?$_POST['qty']:"";

// Lấy thông tin sản phẩm
    $item = get_product_by_id($id);

    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        // Cập nhật số lượng
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;

        // Cập nhật tổng tiền
        $sub_total = $qty * $item['price'];
        $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

        // Cập nhật số trên giỏ hàng
        foreach ($_SESSION['cart']['buy'] as $item) {
            $_SESSION['cart']['info']['num_order'] += $item['qty'];
        }

        // Cập nhật toàn bộ giỏ hàng
        update_info_cart();

        // Lấy tổng giá trị trong giỏ hàng
        $total = get_total_cart();

        // Giá trị trả về
        $data = array(
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($total),
            'num' => $_SESSION['cart']['info']['num_order']
        );

        echo json_encode($data);
    }
}


