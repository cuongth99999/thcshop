<?php

ini_set('display_errors', 0);
error_reporting(0);

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
    global $error, $product_name, $code, $slug, $desc, $content, $status, $product_cat_id, $brand_id,
        $price, $num_stock, $thumbnail;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống tên sản phẩm";
        } else {
            if (strlen($_POST['product_name']) <= 4) {
                $error['product_name'] = "Tên sản phẩm lớn hơn 4 ký tự";
            } else {
                $product_name = $_POST['product_name'];
            }
        }

        if (empty($_POST['code'])) {
            $error['code'] = "Không được để trống mã sản phẩm";
        } else {
            if (strlen($_POST['code']) <= 2) {
                $error['code'] = "Mã sản phẩm phải lớn hơn 2 ký tự";
            } else {
                $code = $_POST['code'];
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

        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        if (empty($_POST['num_stock'])) {
            $error['num_stock'] = "Không được để trống số lượng sản phẩm trong kho";
        } else {
            $num_stock = $_POST['num_stock'];
        }

        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống mô tả sản phẩm";
        } else {
            $desc = $_POST['product_desc'];
        }

        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được để trống nội dung sản phẩm";
        } else {
            $content = $_POST['product_content'];
        }

        if (empty($_POST['thumbnail'])) {
            $error['thumbnail'] = "Không được để trống ảnh thumbnail sản phẩm";
        } else {
            $thumbnail = $_POST['thumbnail'];
        }

        if (empty($_POST['brand_id'])) {
            $error['brand_id'] = "Hãng sản phẩm phải được chọn";
        } else {
            $brand_id = $_POST['brand_id'];
        }

        if (empty($_POST['product_cat_id'])) {
            $error['product_cat_id'] = "Danh mục sản phẩm phải được chọn";
        } else {
            $product_cat_id = $_POST['product_cat_id'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Trạng thái phải được chọn";
        } else {
            $status = $_POST['status'];
        }

        if (isset($_FILES['fileupload'])) {
            $errorfile = array();

            // Thư mục chứa file upload
            $upload_dir = 'public/images/';
            // Đường dẫn của file sau khi upload
            $upload_file_arr = array_values($_FILES['fileupload']['name']);
            foreach ($upload_file_arr as $key => $values) {
                $upload_file[] = $upload_dir . $values;
            }

            // Xử lý upload đúng file định dạng
            $type_allow = array('png', 'jpg', 'gif', 'jpeg');

            $type_arr = array_values($_FILES['fileupload']['type']);
            foreach ($type_arr as $key => $valuetype) {
                $type[] = substr($valuetype, get_index_string($valuetype, '/') + 1);
            }
            foreach ($type as $key => $valuetypetype) {
                if (!in_array(strtolower($valuetypetype), $type_allow)) {
                    $errorfile['type'] = 'Chỉ được upload file có định dạng png, jpg, gif, jpeg';
                } else {
                    // Xử lý upload file có kích thước cho phép (<20MB ~ 29.000.000 Byte)
                    $size_arr = array_values($_FILES['fileupload']['size']);

                    foreach ($size_arr as $key => $valuesize) {
                        if ($valuesize > 29000000) {
                            $errorfile['size'] = 'Chỉ được upload file bé hơn 20MB';
                        }

                        // Kiểm tra trùng file trên hệ thống
                        $new_upload_file = array();
                        $new_file_name_arr = array();
                        foreach ($upload_file as $item) {

                            if (file_exists($item)) {
                                // Xử lý đổi tên file tự động khi file đã tồn tại trên hệ thống
                                foreach ($upload_file_arr as $filename) {
                                    $filename = substr($filename, 0, get_index_string($filename, '.'));
                                    $new_file_name = $filename . ' - Coppy.';
                                    $new_upload_file[] = $upload_dir . $new_file_name . $valuetypetype;

                                    $upload_file = $new_upload_file;
                                }
                            }

//            $error['file_exists'] = 'File đã tồn tại trên hệ thống';
                        }
                    }
                }
            }
            foreach ($_FILES['fileupload']['tmp_name'] as $filetmp) {
                $tmp_name[] = $filetmp;
            }
            if (empty($errorfile)) {
                for ($i=0; $i<count($upload_file); $i++) {
                    for ($j=0; $j<count($tmp_name); $j++) {
                        if (move_uploaded_file($tmp_name[$i], $upload_file[$i])) {
                            $_POST['fileupload'][] = $upload_file;
                        }
                    }
                }
            }
        }

        if (empty($error)) {
            $user = get_user_login_by_username($_SESSION['user_login']);

            $data = array(
                'code' => $code,
                'product_name' => $product_name,
                'slug' => $slug,
                'thumbnail' => $thumbnail,
                'price' => $price,
                'num_stock' => $num_stock,
                'product_desc' => $desc,
                'product_content' => $content,
                'user_id' => $user['user_id'],
                'brand_id' => $brand_id,
                'product_cat_id' => $product_cat_id,
                'status' => $status,
                'created_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            $insertId = add_product($data);

            if ($insertId != 0){
                if (!empty($upload_file)) {
                    foreach ($upload_file as $item) {
                        $dateImages = [
                            'product_id' => $insertId,
                            'image' => trim($item),
                            'created_date' => date('Y-m-d H:i:s')
                        ];
                        add_product_images($dateImages);
                    }
                }
                redirect("?mod=products");
            }
        }
    }

    load_view('add');
}

function editAction() {
    global $error, $product_name, $code, $slug, $desc, $content, $status, $product_cat_id, $brand_id,
           $price, $num_stock, $thumbnail;
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['btn-edit'])) {
        $error = array();

        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống tên sản phẩm";
        } else {
            if (strlen($_POST['product_name']) <= 4) {
                $error['product_name'] = "Tên sản phẩm lớn hơn 4 ký tự";
            } else {
                $product_name = $_POST['product_name'];
            }
        }

        if (empty($_POST['code'])) {
            $error['code'] = "Không được để trống mã sản phẩm";
        } else {
            if (strlen($_POST['code']) <= 2) {
                $error['code'] = "Mã sản phẩm phải lớn hơn 2 ký tự";
            } else {
                $code = $_POST['code'];
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

        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        if (empty($_POST['num_stock'])) {
            $error['num_stock'] = "Không được để trống số lượng sản phẩm trong kho";
        } else {
            $num_stock = $_POST['num_stock'];
        }

        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống mô tả sản phẩm";
        } else {
            $desc = $_POST['product_desc'];
        }

        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được để trống nội dung sản phẩm";
        } else {
            $content = $_POST['product_content'];
        }

        if (empty($_POST['thumbnail'])) {
            $error['thumbnail'] = "Không được để trống ảnh thumbnail sản phẩm";
        } else {
            $thumbnail = $_POST['thumbnail'];
        }

        if (empty($_POST['brand_id'])) {
            $error['brand_id'] = "Hãng sản phẩm phải được chọn";
        } else {
            $brand_id = $_POST['brand_id'];
        }

        if (empty($_POST['product_cat_id'])) {
            $error['product_cat_id'] = "Danh mục sản phẩm phải được chọn";
        } else {
            $product_cat_id = $_POST['product_cat_id'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Trạng thái phải được chọn";
        } else {
            $status = $_POST['status'];
        }

        // Xử lý file
        if (isset($_FILES['fileupload'])) {
            $errorfile = array();

            // Thư mục chứa file upload
            $upload_dir = 'public/images/';
            // Đường dẫn của file sau khi upload
            $upload_file_arr = array_values($_FILES['fileupload']['name']);
            foreach ($upload_file_arr as $key => $values) {
                $upload_file[] = $upload_dir . $values;
            }

            // Xử lý upload đúng file định dạng
            $type_allow = array('png', 'jpg', 'gif', 'jpeg');

            $type_arr = array_values($_FILES['fileupload']['type']);
            foreach ($type_arr as $key => $valuetype) {
                $type[] = substr($valuetype, get_index_string($valuetype, '/') + 1);
            }
            foreach ($type as $key => $valuetypetype) {
                if (!in_array(strtolower($valuetypetype), $type_allow)) {
                    $errorfile['type'] = 'Chỉ được upload file có định dạng png, jpg, gif, jpeg';
                } else {
                    // Xử lý upload file có kích thước cho phép (<20MB ~ 29.000.000 Byte)
                    $size_arr = array_values($_FILES['fileupload']['size']);

                    foreach ($size_arr as $key => $valuesize) {
                        if ($valuesize > 29000000) {
                            $errorfile['size'] = 'Chỉ được upload file bé hơn 20MB';
                        }

                        // Kiểm tra trùng file trên hệ thống
                        $new_upload_file = array();
                        $new_file_name_arr = array();
                        foreach ($upload_file as $item) {

                            if (file_exists($item)) {
                                // Xử lý đổi tên file tự động khi file đã tồn tại trên hệ thống
                                foreach ($upload_file_arr as $filename) {
                                    $filename = substr($filename, 0, get_index_string($filename, '.'));
                                    $new_file_name = $filename . ' - Coppy.';
                                    $new_upload_file[] = $upload_dir . $new_file_name . $valuetypetype;

                                    $upload_file = $new_upload_file;
                                }
                            }

//            $error['file_exists'] = 'File đã tồn tại trên hệ thống';
                        }
                    }
                }
            }
            foreach ($_FILES['fileupload']['tmp_name'] as $filetmp) {
                $tmp_name[] = $filetmp;
            }
            if (empty($errorfile)) {
                for ($i=0; $i<count($upload_file); $i++) {
                    for ($j=0; $j<count($tmp_name); $j++) {
                        if (move_uploaded_file($tmp_name[$i], $upload_file[$i])) {
                            $_POST['fileupload'][] = $upload_file;
                        }
                    }
                }
            }
        }

        if (empty($error)) {
            $data = array(
                'code' => $code,
                'product_name' => $product_name,
                'slug' => $slug,
                'thumbnail' => $thumbnail,
                'price' => $price,
                'num_stock' => $num_stock,
                'product_desc' => $desc,
                'product_content' => $content,
                'brand_id' => $brand_id,
                'product_cat_id' => $product_cat_id,
                'status' => $status,
                'updated_date' => date_format(date_create(), 'Y-m-d H:i:s')
            );
            update_product($id, $data);

            if (!empty($upload_file)) {
                foreach ($upload_file as $item) {
                    $dateImages = [
                        'product_id' => $id,
                        'image' => trim($item),
                        'created_date' => date('Y-m-d H:i:s')
                    ];
                    add_product_images($dateImages);
                }
            }
            redirect("?mod=products&action=edit&id={$id}");
        }
    }

    $info_product = get_product_by_id($id);
    $data['info_product'] = $info_product;

    load_view('edit', $data);
}

function deleteAction() {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    delete_product_by_id($id);

    redirect('?mod=products');
}
