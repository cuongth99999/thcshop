<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('category');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    // Tìm kiếm sản phẩm theo tên
    $where = "";
    $search = isset($_GET['name']) ? $_GET['name']:false;
    if (!empty($search)) {
        $where = "AND `tbl_products`.product_name LIKE '%".$search."%'";
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
        $where .= " AND `tbl_products`.price ".$priceText;
    }

    $brand = isset($_GET['brand']) ? $_GET['brand']:false;
    if (!empty($brand)) {
        $where .= " AND `tbl_brands`.brand_name LIKE '%".$brand."%'";
    }

    // Sắp xếp tăng giảm dần giá
    $orderField = isset($_GET['field']) ? $_GET['field'] : "";
    $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
    $orderCondition = "";
    if (!empty($orderField) && !empty($orderSort)) {
        $orderCondition = "ORDER BY `tbl_products`.{$orderField} {$orderSort}";
    }

// Số lượng bản ghi trên trang
    $num_rows = db_num_rows("SELECT `tbl_products`.*, `tbl_product_categories`.product_cat_name, `tbl_brands`.brand_name FROM `tbl_products` 
                        INNER JOIN  `tbl_product_categories` ON `tbl_products`.product_cat_id = `tbl_product_categories`.product_cat_id
                        INNER JOIN `tbl_brands` ON `tbl_products`.brand_id =`tbl_brands`.brand_id
                        WHERE (`tbl_product_categories`.product_cat_id = {$id} OR `tbl_product_categories`.product_cat_parent_id = {$id} OR `tbl_product_categories`.product_cat_grandparent_id = {$id})
                        {$where}");

    $num_per_page = 12;
    $total_row = $num_rows;
    $num_page = ceil($total_row/$num_per_page);

    $page = isset($_GET['page'])?(int)$_GET['page']:1;

    $start = ($page - 1)*$num_per_page;

    $list_products = get_list_products_by_cat_id($start, $num_per_page, $where, $orderCondition, $id);
    $list_product_category = get_product_categories();
    $product_category_by_id = get_product_category_by_id($id);
    $list_brands = get_list_brands();

    $data = array(
        'num_page' => $num_page,
        'page' => $page,
        'list_products' => $list_products,
        'list_product_category' => $list_product_category,
        'product_category_by_id' => $product_category_by_id,
        'list_brands' => $list_brands,
        'id' => $id
    );

    load_view('category', $data);
}

