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
    global $error, $title, $slug, $desc;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Không được để trống tiêu đề bài viết";
        } else {
            if (strlen($_POST['post_title']) <= 4) {
                $error['post_title'] = "Tiêu đề bài viết lớn hơn 4 ký tự";
            } else {
                $title = $_POST['post_title'];
            }
        }

        if (empty($_POST['post_slug'])) {
            $error['post_slug'] = "Không được để trống slug";
        } else {
            if (strlen($_POST['post_slug']) <= 2) {
                $error['post_slug'] = "Slug phải lớn hơn 2 ký tự";
            } else {
                $slug = $_POST['post_slug'];
            }
        }

        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "Không được để trống nội dung bài viết";
        } else {
            $desc = $_POST['post_desc'];
        }

        if (empty($_POST['post_status'])) {
            $error['post_status'] = "Trạng thái phải được chọn";
        } else {
            $status = $_POST['post_status'];
        }

        if (empty($_POST['post_cat_id'])) {
            $error['post_cat_id'] = "Danh mục bài viết phải được chọn";
        } else {
            $post_cat_id = $_POST['post_cat_id'];
        }

        // Xử lý file
        // Thư mục chứa file upload
        $upload_dir = 'public/images/';
        // Đường dẫn của file sau khi upload
        $upload_file = $upload_dir.$_FILES['file']['name'];

        // Xử lý upload đúng file định dạng
        $type_allow = array('png', 'jpg', 'gif' , 'jpeg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $type_allow)) {
            $error['type'] = 'Chỉ được upload file có định dạng png, jpg, gif, jpeg';
        } else {
            // Xử lý upload file có kích thước cho phép (<20MB ~ 29.000.000 Byte)
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['size'] = 'Chỉ được upload file bé hơn 20MB';
            }

            // Kiểm tra trùng file trên hệ thống
            if (file_exists($upload_file)) {
                // Xử lý đổi tên file tự động khi file đã tồn tại trên hệ thống
                $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $new_file_name = $file_name.' - Coppy.';
                $new_upload_file = $upload_dir.$new_file_name.$type;
                $k = 1;
                while (file_exists($new_upload_file)) {
                    $new_file_name = $file_name." - Coppy({$k}).";
                    $k++;
                    $new_upload_file = $upload_dir.$new_file_name.$type;
                }

                $upload_file = $new_upload_file;

//            $error['file_exists'] = 'File đã tồn tại trên hệ thống';
            }
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
            $_POST['image'] = $upload_file;
        } else {
            $error['file'] = "File phải được chọn";
        }

        if (empty($error)) {
            $user = get_user_login_by_username($_SESSION['user_login']);

            $data = array(
                'post_title' => $title,
                'post_desc' => $desc,
                'post_slug' => $slug,
                'post_status' => $status,
                'post_thumbnail' => $upload_file,
                'user_id' => $user['user_id'],
                'post_cat_id' => $post_cat_id,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            add_post($data);

            redirect("?mod=posts");
        }
    }

    load_view('add');
}

function editAction() {
    global $error, $title, $slug, $desc;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['btn-edit'])) {
        $error = array();

        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Không được để trống tiêu đề bài viết";
        } else {
            if (strlen($_POST['post_title']) <= 4) {
                $error['post_title'] = "Tiêu đề bài viết lớn hơn 4 ký tự";
            } else {
                $title = $_POST['post_title'];
            }
        }

        if (empty($_POST['post_slug'])) {
            $error['post_slug'] = "Không được để trống slug";
        } else {
            if (strlen($_POST['post_slug']) <= 2) {
                $error['post_slug'] = "Slug phải lớn hơn 2 ký tự";
            } else {
                $slug = $_POST['post_slug'];
            }
        }

        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "Không được để trống nội dung bài viết";
        } else {
            $desc = $_POST['post_desc'];
        }

        if (empty($_POST['post_status'])) {
            $error['post_status'] = "Trạng thái phải được chọn";
        } else {
            $status = $_POST['post_status'];
        }

        if (empty($_POST['post_cat_id'])) {
            $error['post_cat_id'] = "Danh mục bài viết phải được chọn";
        } else {
            $post_cat_id = $_POST['post_cat_id'];
        }

        // Xử lý file
        // Thư mục chứa file upload
        $upload_dir = 'public/images/';
        // Đường dẫn của file sau khi upload
        $upload_file = $upload_dir.$_FILES['file']['name'];

        // Xử lý upload đúng file định dạng
        $type_allow = array('png', 'jpg', 'gif' , 'jpeg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $type_allow)) {
            $error['type'] = 'Chỉ được upload file có định dạng png, jpg, gif, jpeg';
        } else {
            // Xử lý upload file có kích thước cho phép (<20MB ~ 29.000.000 Byte)
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['size'] = 'Chỉ được upload file bé hơn 20MB';
            }

            // Kiểm tra trùng file trên hệ thống
            if (file_exists($upload_file)) {
                // Xử lý đổi tên file tự động khi file đã tồn tại trên hệ thống
                $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $new_file_name = $file_name.' - Coppy.';
                $new_upload_file = $upload_dir.$new_file_name.$type;
                $k = 1;
                while (file_exists($new_upload_file)) {
                    $new_file_name = $file_name." - Coppy({$k}).";
                    $k++;
                    $new_upload_file = $upload_dir.$new_file_name.$type;
                }

                $upload_file = $new_upload_file;

//            $error['file_exists'] = 'File đã tồn tại trên hệ thống';
            }
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
            $_POST['image'] = $upload_file;
        } else {
            $error['file'] = "File phải được chọn";
        }

        if (empty($error)) {
            $data = array(
                'post_title' => $title,
                'post_desc' => $desc,
                'post_slug' => $slug,
                'post_status' => $status,
                'post_thumbnail' => $upload_file,
                'post_cat_id' => $post_cat_id,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            update_post($id, $data);
        }
    }

    $info_post = get_post_by_id($id);
    $data['info_post'] = $info_post;

    load_view('edit', $data);
}

function deleteAction() {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    delete_post_by_id($id);

    redirect('?mod=posts');
}
