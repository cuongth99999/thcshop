<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    // Tìm kiếm sản phẩm theo tên
    $where = "";
    $search = isset($_GET['name']) ? $_GET['name']:false;
    if (!empty($search)) {
        $where = "WHERE `tbl_products`.product_name LIKE '%".$search."%'";
    }

    $price= isset($_GET['price']) ? $_GET['price']:false;
    if ($price == 500000) {
        $priceText = "<= 500000";
    } elseif ($price == 1000000) {
        $priceText = "BETWEEN 500000 AND 1000000";
    } elseif ($price == 5000000) {
        $priceText = "BETWEEN 1000000 AND 5000000";
    } elseif ($price == 10000000) {
        $priceText = "BETWEEN 5000000 AND 10000000";
    } else if ($price == 10000001) {
        $priceText = ">= 10000000";
    }

    if (!empty($priceText)) {
        if (strpos($where, 'WHERE') >= 0) {
            $where .= " AND `tbl_products`.price ".$priceText;
        } else {
            $where = "WHERE `tbl_products`.price ".$priceText;
        }
    }

    $brand = isset($_GET['brand']) ? $_GET['brand']:false;
    if (!empty($brand)) {
        if (strpos($where, 'WHERE') >= 0) {
            $where .= " AND `tbl_brands`.brand_name LIKE '%".$brand."%'";
        } else {
            $where = "WHERE`tbl_brands`.brand_name LIKE '%".$brand."%'";
        }
    }

    // Sắp xếp tăng giảm dần giá
    $orderField = isset($_GET['field']) ? $_GET['field'] : "";
    $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
    $orderCondition = "";
    if (!empty($orderField) && !empty($orderSort)) {
        $orderCondition = "ORDER BY `tbl_products`.{$orderField} {$orderSort}";
    }

// Số lượng bản ghi trên trang
    if (!empty($where)) {
        $num_rows = db_num_rows("SELECT `tbl_products`.*, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` 
                        INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id
                        {$where}");
    } else {
        $num_rows = db_num_rows("SELECT * FROM `tbl_products`");
    }

    $num_per_page = 12;
    $total_row = $num_rows;
    $num_page = ceil($total_row/$num_per_page);

    $page = isset($_GET['page'])?(int)$_GET['page']:1;

    $start = ($page - 1)*$num_per_page;

    $list_products = get_list_products($start, $num_per_page, $where, $orderCondition);
    $list_sliders = get_list_sliders();
    $list_product_category = get_product_categories();
    $list_brands = get_list_brands();


    $data = array(
        'num_page' => $num_page,
        'page' => $page,
        'list_products' => $list_products,
        'list_product_category' => $list_product_category,
        'list_sliders' => $list_sliders,
        'list_brands' => $list_brands
    );

    load_view('index', $data);
}

function detailAction() {
    load('helper','format');

    if (!empty($_GET['product_id'])) {
        $productId = $_GET['product_id'];
    }

    $product_item = get_product_by_id($productId);
    $list_product_images = get_list_product_images_by_id($productId);
    $list_product_same_brands = get_list_product_same_brands($productId);
    $list_sliders = get_list_sliders();
    $list_product_category = get_product_categories();
    $list_brands = get_list_brands();

    $data = array(
        'product_item' => $product_item,
        'list_product_images' => $list_product_images,
        'list_product_same_brands' => $list_product_same_brands,
        'list_product_category' => $list_product_category,
        'list_sliders' => $list_sliders,
        'list_brands' => $list_brands
    );

    load_view('detailProduct', $data);
}
