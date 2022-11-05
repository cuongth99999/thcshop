<?php

function get_product_by_id($id) {

    $productItem = db_fetch_row("SELECT * FROM `tbl_products` WHERE `tbl_products`.id = {$id}");
    $productItem['url'] = "?mod=products&action=detail&product_id={$id}";
    return $productItem;
}


function add_cart($id, $qty = 1) {
    $item = get_product_by_id($id);
    #Thêm thông tin sản phẩm vào giỏ hàng

    if ($qty == 1) {
        if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
        }
    } else {
        if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$id]['qty'] + $qty;
        }
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['id'],
        'url' => $item['url'],
        'code' => $item['code'],
        'product_name' => $item['product_name'],
        'slug' => $item['slug'],
        'thumbnail' => $item['thumbnail'],
        'num_stock' => $item['num_stock'],
        'price' => $item['price'],
        'qty' => $qty,
        'sub_total' => $item['price'] * $qty
    );
}

function update_info_cart() {
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }

        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total
        );
    }
}

function get_total_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function delete_cart($id='') {
    if (isset($_SESSION['cart'])) {
        if (!empty($id)) {
            unset($_SESSION['cart']['buy'][$id]);
            update_info_cart();
        } else {
            unset($_SESSION['cart']);
        }
    }
}

function update_cart($qty) {
    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $new_qty * $_SESSION['cart']['buy'][$id]['price'];
    }
}