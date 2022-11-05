<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('cat');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    load_view('catIndex');
}

function addAction() {
    global $error, $product_cat_name, $slug;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['product_cat_name'])) {
            $error['product_cat_name'] = "Không được để trống tên danh mục";
        } else {
            if (strlen($_POST['product_cat_name']) <= 2) {
                $error['product_cat_name'] = "Tên danh mục phải lớn hơn 2 ký tự";
            } else {
                $product_cat_name = $_POST['product_cat_name'];
            }
        }


        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (strlen($_POST['slug']) <= 2) {
                $error['slug'] = "Slug phải lớn hơn 2 ký tự";
            } else {
                $slug = $_POST['slug'];
            }
        }

        if (!empty($_POST['product_cat_level'])) {
            $level = $_POST['product_cat_level'] + 1;
        } else {
            $level = 1;
        }

        if (empty($error)) {
            $user = get_user_login_by_username($_SESSION['user_login']);

            $data = array(
                'product_cat_name' => $product_cat_name,
                'slug' => $slug,
                'level' => $level,
                'user_id' => $user['user_id'],
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            add_cat_product($data);

            redirect("?mod=products&controller=cat");
        }

    }

    load_view('catAdd');
}

function editAction() {
    global $error, $product_cat_name, $slug;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['btn-edit'])) {
        $error = array();

        if (empty($_POST['product_cat_name'])) {
            $error['product_cat_name'] = "Không được để trống têm danh mục";
        } else {
            if (strlen($_POST['product_cat_name']) <= 2) {
                $error['product_cat_name'] = "Tên danh mục phải lớn hơn 2 ký tự";
            } else {
                $product_cat_name = $_POST['product_cat_name'];
            }
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (strlen($_POST['slug']) <= 2) {
                $error['slug'] = "Slug phải lớn hơn 2 ký tự";
            } else {
                $slug = $_POST['slug'];
            }
        }

        if (!empty($_POST['product_cat_level'])) {
            $level = $_POST['product_cat_level'] + 1;
        } else {
            $level = 1;
        }

        if (empty($error)) {
            $data = array(
                'product_cat_name' => $product_cat_name,
                'slug' => $slug,
                'level' => $level,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            update_cat_product($id, $data);
        }
    }

    $info_cat_product = get_cat_product_by_id($id);
    $data['info_cat_product'] = $info_cat_product;

    load_view('catEdit', $data);
}

function deleteAction() {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    delete_cat_product_by_id($id);

    redirect('?mod=products&controller=cat');
}