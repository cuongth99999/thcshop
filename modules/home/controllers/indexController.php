<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    $list_product_telephone = get_list_product_telephone();
    $list_product_laptop = get_list_product_laptop();
    $list_product_accessory = get_list_product_accessory();
    $list_product_bestseller = get_list_product_bestseller();
    $list_product_featured = get_list_product_featured();
    $list_sliders = get_list_sliders();
    $list_product_category = get_product_categories();

    $data = array(
        'list_product_telephone' => $list_product_telephone,
        'list_product_laptop' => $list_product_laptop,
        'list_product_accessory' => $list_product_accessory,
        'list_product_bestseller' => $list_product_bestseller,
        'list_product_featured' => $list_product_featured,
        'list_product_category' => $list_product_category,
        'list_sliders' => $list_sliders
    );

    load_view('index', $data);
}
