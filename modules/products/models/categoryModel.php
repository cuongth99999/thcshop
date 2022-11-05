<?php

function get_list_products_by_cat_id($start = 1, $num_per_page = 10, $where = "", $orderCondition = "", $id) {

    $list_products = db_fetch_array("SELECT `tbl_products`.*, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` 
                        INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id
                        WHERE (`tbl_product_categories`.product_cat_id = {$id} OR `tbl_product_categories`.product_cat_parent_id = {$id} OR `tbl_product_categories`.product_cat_grandparent_id = {$id})
                        {$where} {$orderCondition} LIMIT {$start}, {$num_per_page}");

    return $list_products;
}

function get_product_categories() {
    return db_fetch_array("SELECT * FROM `tbl_product_categories`");
}

function get_product_category_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_product_categories` WHERE product_Cat_id = {$id}");
}

function show_categories_home($data, $parent_id = 0, $stt = 0) {
    if (!empty($data)) {
        $cate_child = array();
        foreach ($data as $key => $item) {
            if ($item['product_cat_parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($data[$key]);
            }
        }
        if ($cate_child) {
            echo ($stt == 0)?'<ul class="list-item">':'<ul class="sub-menu">';
            foreach ($cate_child as $key => $item) {
                echo '<li>';
                echo '<a href="danh-muc/'.$item['slug'].'-'.$item['product_cat_id'].'.html" title="">'.$item['product_cat_name'].'</a>';
                show_categories_home($data, $item['product_cat_id'], ++$stt);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}

function get_list_brands() {
    return db_fetch_array("SELECT * FROM `tbl_brands`");
}

function get_pagging($num_page, $page, $base_url = "") {

    $param = "";
    if (isset($_GET['name'])) {
        $param = "&name=".$_GET['name'];
    }
    if (isset($_GET['sort']) && isset($_GET['field'])) {
        $param .= "&field={$_GET['field']}&sort={$_GET['sort']}";
    }
    if (isset($_GET['brand'])) {
        $param .= "&brand={$_GET['brand']}";
    }
    if (isset($_GET['price'])) {
        $param .= "&price={$_GET['price']}";
    }

    $str_pagging = "<div class=\"section\" id=\"paging-wp\">
                <div class=\"section-detail\">
                    <ul class=\"list-item clearfix\">";

    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}{$param}&page={$page_prev}\"><</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "class = 'active-paging'";
        }
        $str_pagging .= "<li><a {$active} href=\"{$base_url}{$param}&page={$i}\">$i</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href=\"{$base_url}{$param}&page={$page_next}\">></a></li>";
    }

    $str_pagging .= "</ul>
                </div>
            </div>";

    return $str_pagging;
}