<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    $num_rows = db_num_rows("SELECT * FROM `tbl_posts`");

    $num_per_page = 6;
    $total_row = $num_rows;
    $num_page = ceil($total_row/$num_per_page);

    $page = isset($_GET['page'])?(int)$_GET['page']:1;

    $start = ($page - 1)*$num_per_page;

    $list_posts = get_list_posts($start, $num_per_page);
    $list_product_bestseller = get_list_product_bestseller();
    $list_sliders = get_list_sliders();
    $list_product_category = get_product_categories();

    $data = array(
        'num_page' => $num_page,
        'page' => $page,
        'list_posts' => $list_posts,
        'list_product_bestseller' => $list_product_bestseller,
        'list_product_category' => $list_product_category,
        'list_sliders' => $list_sliders
    );

    load_view('index', $data);
}

function detailAction() {
    load('helper','format');

    $list_product_bestseller = get_list_product_bestseller();

    $data = array(
        'list_product_bestseller' => $list_product_bestseller,
    );

    load_view('detailPosts', $data);
}
