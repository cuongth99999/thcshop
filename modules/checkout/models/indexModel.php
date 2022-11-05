<?php

function get_product_by_id($id) {

    $productItem = db_fetch_row("SELECT * FROM `tbl_products` WHERE `tbl_products`.id = {$id}");
    $productItem['url'] = "?mod=products&action=detail&product_id={$id}";
    return $productItem;
}

function get_total_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function add_customer ($data) {
    return db_insert('tbl_customers', $data);
}

function get_max_order_id() {
    return db_fetch_row("SELECT MAX(order_id) AS 'max_order_id' FROM `tbl_orders`");
}

function get_order_last() {
    return db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.*, `tbl_detail_orders`.num_order, `tbl_products`.product_name, `tbl_products`.thumbnail, `tbl_products`.price 
                        FROM `tbl_orders` INNER JOIN `tbl_customers` ON `tbl_orders`.customer_id = `tbl_customers`.customer_id
                      INNER JOIN `tbl_detail_orders` ON `tbl_orders`.order_id = `tbl_detail_orders`.order_id
                      INNER JOIN `tbl_products` ON `tbl_detail_orders`.product_id = `tbl_products`.id
                      WHERE `tbl_orders`.order_id = (SELECT MAX(order_id) FROM `tbl_orders` WHERE DAY(`tbl_orders`.created_date) = DAY(NOW()))");
}

function add_order ($data) {
    return db_insert('tbl_orders', $data);
}

function add_detail_order ($data) {
    db_insert('tbl_detail_orders', $data);
}

function update_numstock_product($id, $data) {
    db_update('tbl_products', $data, "`id` = '{$id}'");
}