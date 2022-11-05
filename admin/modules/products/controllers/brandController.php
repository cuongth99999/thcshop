<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('brand');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    load_view('brandIndex');
}

function addAction() {
    global $error, $brand_name, $slug;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['brand_name'])) {
            $error['brand_name'] = "Không được để trống tên hãng sản xuất";
        } else {
            if (strlen($_POST['brand_name']) <= 1) {
                $error['brand_name'] = "Tên hãng sản xuất phải lớn hơn 1 ký tự";
            } else {
                $brand_name = $_POST['brand_name'];
            }
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (strlen($_POST['slug']) <= 1) {
                $error['slug'] = "Slug phải lớn hơn 1 ký tự";
            } else {
                $slug = $_POST['slug'];
            }
        }

        if (empty($error)) {
            $user = get_user_login_by_username($_SESSION['user_login']);

            $data = array(
                'brand_name' => $brand_name,
                'slug' => $slug,
                'user_id' => $user['user_id'],
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            add_brand($data);

            redirect("?mod=products&controller=brand");
        }

    }

    load_view('brandAdd');
}

function editAction() {
    global $error, $post_cat_name, $slug;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['btn-edit'])) {
        $error = array();

        if (empty($_POST['brand_name'])) {
            $error['brand_name'] = "Không được để trống tên hãng sản xuất";
        } else {
            if (strlen($_POST['brand_name']) <= 1) {
                $error['brand_name'] = "Tên hãng sản xuất phải lớn hơn 1 ký tự";
            } else {
                $brand_name = $_POST['brand_name'];
            }
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (strlen($_POST['slug']) <= 1) {
                $error['slug'] = "Slug phải lớn hơn 1 ký tự";
            } else {
                $slug = $_POST['slug'];
            }
        }

        if (empty($error)) {
            $data = array(
                'brand_name' => $brand_name,
                'slug' => $slug,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            update_brand($id, $data);
        }
    }

    $info_brand = get_brands_by_id($id);
    $data['info_brand'] = $info_brand;

    load_view('brandEdit', $data);
}

function deleteAction() {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    delete_brand_by_id($id);

    redirect('?mod=products&controller=brand');
}