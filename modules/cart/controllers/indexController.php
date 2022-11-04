<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    $list_product_bestseller = get_list_product_bestseller();
    $page_intro = get_page_intro();

    $data = array(
        'list_product_bestseller' => $list_product_bestseller,
        'page_intro' => $page_intro,
    );

    load_view('index', $data);
}

