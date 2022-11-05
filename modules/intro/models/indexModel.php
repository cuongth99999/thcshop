<?php

function get_page_intro() {
    $page_intro = db_fetch_row("SELECT * FROM `tbl_pages` WHERE page_title = 'Giới thiệu'");
    return$page_intro;
}

function get_list_product_bestseller() {
    $list_product_bestseller = db_fetch_array("SELECT `tbl_products`.* FROM `tbl_products`
                        INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id
                         WHERE `tbl_products`.status = 'Đã duyệt' AND `tbl_products`.product_type = 'Bán chạy'");

    return $list_product_bestseller;
}

function get_list_sliders() {
    $list_sliders = db_fetch_array("SELECT * FROM `tbl_sliders`");
    return $list_sliders;
}

function get_product_categories() {
    return db_fetch_array("SELECT * FROM `tbl_product_categories`");
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
                echo '<a href="?mod=products&controller=category&id='.$item['product_cat_id'].'" title="">'.$item['product_cat_name'].'</a>';
                show_categories_home($data, $item['product_cat_id'], ++$stt);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}

function get_pagging($num_page, $page, $base_url = "") {

    $str_pagging = "<div class=\"section\" id=\"paging-wp\">
                <div class=\"section-detail\">
                    <ul class=\"list-item clearfix\">";

    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_prev}\"><</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "class = 'active-paging'";
        }
        $str_pagging .= "<li><a {$active} href=\"{$base_url}&page={$i}\">$i</a></li>";
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