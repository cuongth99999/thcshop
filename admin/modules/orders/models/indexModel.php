<?php

function get_list_users () {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_login_by_username($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

function add_order ($data) {
    return db_insert('tbl_orders', $data);
}

function add_customer ($data) {
    return db_insert('tbl_customers', $data);
}

function add_detail_order ($data) {
    db_insert('tbl_detail_orders', $data);
}

function insertId(){
    $mysqli = new mysqli("localhost", "root", "", "db_ismart");
    return $mysqli->insert_id;
}

function get_list_products () {
    $result = db_fetch_array("SELECT `tbl_products`.*, `tbl_users`.fullname, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` INNER JOIN `tbl_users` ON
                        `tbl_products`.user_id = `tbl_users`.user_id INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id GROUP BY `tbl_products`.id ASC");
    return $result;
}

function get_list_customers() {
    $result = db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.* FROM `tbl_customers` INNER JOIN `tbl_orders` ON
                        `tbl_orders`.customer_id = `tbl_customers`.customer_id");
    return $result;
}

function get_list_orders() {
    $result = db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.*, `tbl_detail_orders`.* FROM `tbl_orders` INNER JOIN `tbl_customers` ON
                        `tbl_orders`.customer_id = `tbl_customers`.customer_id INNER JOIN  `tbl_detail_orders` ON `tbl_orders`.order_id = `tbl_detail_orders`.order_id
                        GROUP BY `tbl_orders`.order_code ASC");
    return $result;
}

function get_product_by_id ($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id` = {$id}");
    return $item;
}

function get_product_by_code ($code) {
    $item = db_fetch_row("SELECT * FROM `tbl_products` WHERE `code` = '{$code}'");
    return $item;
}

function get_products($start = 1, $num_per_page = 5, $filter = "") {

    $list_products = db_fetch_array("SELECT `tbl_products`.*, `tbl_users`.fullname, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` INNER JOIN `tbl_users` ON
                        `tbl_products`.user_id = `tbl_users`.user_id INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id
                         {$filter} GROUP BY `tbl_products`.id DESC LIMIT {$start}, {$num_per_page}");

    return $list_products;
}

function get_customers($start = 1, $num_per_page = 5, $filter = "") {

    $list_customers = db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.* FROM `tbl_customers` INNER JOIN `tbl_orders` ON
                        `tbl_orders`.customer_id = `tbl_customers`.customer_id
                         {$filter} GROUP BY `tbl_orders`.order_code DESC LIMIT {$start}, {$num_per_page}");

    return $list_customers;
}

function get_orders($start = 1, $num_per_page = 5, $filter = "") {

    $list_orders = db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.*, `tbl_detail_orders`.* FROM `tbl_orders` INNER JOIN `tbl_customers` ON
                        `tbl_orders`.customer_id = `tbl_customers`.customer_id INNER JOIN  `tbl_detail_orders` ON `tbl_orders`.order_id = `tbl_detail_orders`.order_id
                         {$filter} GROUP BY `tbl_orders`.order_code DESC LIMIT {$start}, {$num_per_page}");

    return $list_orders;
}

function get_num_product  ($order_id) {
    $numProduct = db_fetch_row("SELECT COUNT(`product_id`) as `sum_product` FROM `tbl_detail_orders` WHERE `order_id` = {$order_id}");
    return $numProduct;
}

function get_num_order ($order_id) {
    $numOrder = db_fetch_row("SELECT SUM(`num_order`) as `sum_order` FROM `tbl_detail_orders` WHERE `order_id` = {$order_id}");
    return $numOrder;
}

function get_price_order ($order_id) {
    $price_order = db_fetch_array("SELECT `tbl_detail_orders`.num_order * `tbl_products`.price AS `price_order` FROM `tbl_detail_orders` 
                                 INNER JOIN `tbl_products` ON `tbl_detail_orders`.product_id = `tbl_products`.id                         
                                 WHERE `order_id` = {$order_id}");
    return $price_order;
}

function get_order_by_id($order_id) {
    $result = db_fetch_array("SELECT `tbl_orders`.*, `tbl_customers`.*, `tbl_detail_orders`.*, `tbl_products`.price,`tbl_products`.thumbnail, `tbl_products`.product_name  FROM `tbl_orders` INNER JOIN `tbl_customers` ON
                        `tbl_orders`.customer_id = `tbl_customers`.customer_id INNER JOIN  `tbl_detail_orders` ON `tbl_orders`.order_id = `tbl_detail_orders`.order_id
                              INNER JOIN `tbl_products` ON `tbl_detail_orders`.product_id = `tbl_products`.id                                                       
                        WHERE `tbl_orders`.order_id = {$order_id}");
    return $result;
}

function update_orders ($id, $data) {
    db_update('tbl_orders', $data, "`order_id` = '{$id}'");
}

function update_numstock_product($id, $data) {
    db_update('tbl_products', $data, "`id` = '{$id}'");
}

function get_pagging($num_page, $page, $base_url = "") {
    $str_pagging = "<div class=\"section\" id=\"paging-wp\">
                <div class=\"section-detail clearfix\">
                    <ul id=\"list-paging\" class=\"fl-right\">";

    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_prev}\"><</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "class = 'active'";
        }
        $str_pagging .= "<li {$active}><a href=\"{$base_url}&page={$i}\">$i</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_next}\">></a></li>";
    }

    $str_pagging .= "</ul>
                </div>
            </div>";

    return $str_pagging;
}

function get_index_string($string, $character) {
    $index = strpos($string, $character);
    return $index;
}
