<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');

    load_view('index');
}

function addAction() {
    global $error, $slider_name, $image, $status;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['slider_name'])) {
            $error['slider_name'] = "Không được để trống tên slider";
        } else {
            if (strlen($_POST['slider_name']) <= 4) {
                $error['slider_name'] = "Tên slider phải lớn hơn 4 ký tự";
            } else {
                $slider_name = $_POST['slider_name'];
            }
        }

        if (empty($_POST['image'])) {
            $error['image'] = "Không được để trống ảnh slider";
        } else {
            $image = $_POST['image'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Trạng thái phải được chọn";
        } else {
            $status = $_POST['status'];
        }

        if (empty($error)) {
            $user = get_user_login_by_username($_SESSION['user_login']);

            $data = array(
                'slider_name' => $slider_name,
                'image' => $image,
                'status' => $status,
                'user_id' => $user['user_id'],
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            add_slider($data);

            redirect("?mod=sliders");
        }

    }

    load_view('add');
}

function editAction() {
    global $error, $slider_name, $image, $status;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['btn-edit'])) {
        $error = array();

        if (empty($_POST['slider_name'])) {
            $error['slider_name'] = "Không được để trống tên slider";
        } else {
            if (strlen($_POST['slider_name']) <= 4) {
                $error['slider_name'] = "Tên slider phải lớn hơn 4 ký tự";
            } else {
                $slider_name = $_POST['slider_name'];
            }
        }

        if (empty($_POST['image'])) {
            $error['image'] = "Không được để trống ảnh slider";
        } else {
            $image = $_POST['image'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Trạng thái phải được chọn";
        } else {
            $status = $_POST['status'];
        }

        if (empty($error)) {
            $data = array(
                'slider_name' => $slider_name,
                'image' => $image,
                'status' => $status,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            update_slider($id, $data);
        }
    }

    $info_slider = get_slider_by_id($id);
    $data['info_slider'] = $info_slider;

    load_view('edit', $data);
}

function deleteAction() {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    delete_slider_by_id($id);

    redirect('?mod=sliders');
}
