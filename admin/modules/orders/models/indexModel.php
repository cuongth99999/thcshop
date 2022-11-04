<?php

function get_list_users () {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_login_by_username($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

function add_product ($data) {
    return db_insert('tbl_products', $data);
}

function add_product_images ($data) {
    db_insert('tbl_product_images', $data);
}

function insertId(){
    $mysqli = new mysqli("localhost", "root", "", "db_ismart");
    return $mysqli->insert_id;
}

function get_list_products () {
    $result = db_fetch_array("SELECT `tbl_products`.*, `tbl_users`.fullname, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` INNER JOIN `tbl_users` ON
                        `tbl_products`.user_id = `tbl_users`.user_id INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id");
    return $result;
}

function get_product_by_id ($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id` = {$id}");
    return $item;
}

function get_products($start = 1, $num_per_page = 5, $filter = "") {

    $list_products = db_fetch_array("SELECT `tbl_products`.*, `tbl_users`.fullname, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` INNER JOIN `tbl_users` ON
                        `tbl_products`.user_id = `tbl_users`.user_id INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id
                         {$filter} GROUP BY `tbl_products`.id DESC LIMIT {$start}, {$num_per_page}");

    return $list_products;
}

function update_product ($id, $data) {
    db_update('tbl_products', $data, "`id` = '{$id}'");
}

function delete_product_by_id($id) {
    db_delete('tbl_products', "`id` = '{$id}'");
}

function get_info_cat_product () {
    $result = db_fetch_array("SELECT `tbl_product_categories`.*, `tbl_users`.fullname FROM `tbl_product_categories` INNER JOIN `tbl_users` ON
                        `tbl_product_categories`.user_id = `tbl_users`.user_id");
    return $result;
}

function get_info_brand () {
    $result = db_fetch_array("SELECT `tbl_brands`.*, `tbl_users`.fullname FROM `tbl_brands` INNER JOIN `tbl_users` ON
                        `tbl_brands`.user_id = `tbl_users`.user_id");
    return $result;
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
