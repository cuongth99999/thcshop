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
    global $error, $post_cat_name, $slug;
    if (isset($_POST['btn-add-page'])) {
        $error = array();

        if (empty($_POST['post_cat_name'])) {
            $error['post_cat_name'] = "Không được để trống têm danh mục";
        } else {
            if (strlen($_POST['post_cat_name']) <= 4) {
                $error['post_cat_name'] = "Tên danh mục phải lớn hơn 4 ký tự";
            } else {
                $post_cat_name = $_POST['post_cat_name'];
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

        if (empty($error)) {
            $user = get_user_login_by_username($_SESSION['user_login']);

            $data = array(
                'post_cat_name' => $post_cat_name,
                'slug' => $slug,
                'user_id' => $user['user_id'],
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            add_cat_post($data);

            redirect("?mod=posts&controller=cat");
        }

    }

    load_view('catAdd');
}

function editAction() {
    global $error, $post_cat_name, $slug;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['btn-edit'])) {
        $error = array();

        if (empty($_POST['post_cat_name'])) {
            $error['post_cat_name'] = "Không được để trống tên danh mục";
        } else {
            if (strlen($_POST['post_cat_name']) <= 4) {
                $error['post_cat_name'] = "Tên danh mục phải lớn hơn 4 ký tự";
            } else {
                $post_cat_name = $_POST['post_cat_name'];
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

        if (empty($error)) {
            $data = array(
                'post_cat_name' => $post_cat_name,
                'slug' => $slug,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            update_cat_post($id, $data);
        }
    }

    $info_cat_post = get_cat_post_by_id($id);
    $data['info_cat_post'] = $info_cat_post;

    load_view('catEdit', $data);
}

function deleteAction() {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    delete_cat_post_by_id($id);

    redirect('?mod=posts&controller=cat');
}