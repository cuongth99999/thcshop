<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');
    $list_users = get_list_users();
//    show_array($list_users);
    $data['list_users'] = $list_users;
    get_header();
    load_view('index', $data);
    get_footer();
}

function editAction() {
    $id = (int)$_GET['id'];
    $item = get_user_by_id($id);
    show_array($item);
}

function loginAction() {
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();

        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            $pattern = '/^[A-Za-z0-9_\.]{5,32}$/';
            if (!preg_match($pattern, $_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{5,32}$/';
            if (!preg_match($pattern, $_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($error)) {
            if (check_login($username, $password)) {
                // Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;

                // Chuyển hướng vào trong hệ thống
                redirect();
            } else {
                $error['account'] = "Username hoặc mật khẩu không chính xác";
            }
        }
    }

    load_view('login');
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function updateAction() {
    global $error, $username, $email, $fullname, $address;
    if (isset($_POST['btn-update'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            if (strlen($_POST['fullname']) <= 6) {
                $error['fullname'] = "Họ tên phải lớn hơn 6 ký tự";
            } else {
                $fullname = $_POST['fullname'];
            }
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            $pattern = '/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/';
            if (!preg_match($pattern, $_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống số địa chỉ";
        } else {
            $address = $_POST['address'];
        }

        if (empty($error)) {
            //update
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address
            );
            update_user_login(user_login(), $data);
        }
    }

    $info_user = get_user_by_username(user_login());
    $data['info_user'] = $info_user;

    load_view('update', $data);
}

function resetAction() {
    global $error, $password;
    if (isset($_POST['btn-new-pass'])) {
        $error = array();

        if (empty($_POST['password_old'])) {
            $error['password_old'] = "Không được để trống mật khẩu cũ";
        } else {
            $password_old = info_user('password');
            if (md5($_POST['password_old']) != $password_old) {
                $error['password_old'] = "Mật khẩu cũ không chính xác";
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu mới";
        } else {
            $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{5,32}$/';
            if (!preg_match($pattern, $_POST['password'])) {
                $error['password'] = "Mật khẩu mới không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($_POST['confirm_password'])) {
            $error['confirm_password'] = "Không được để trống nhập lại mật khẩu mới";
        } else {
            if ($_POST['confirm_password'] != $_POST['password']) {
                $error['confirm_password'] = "Mật khẩu mới không trùng khớp";
            }
        }

        if (empty($error)) {
            //update
            $data = array(
                'password' => $password
            );
            update_user_login(user_login(), $data);
        }
    }

    load_view('reset');
}

function addAction() {
    global $error, $username, $email, $fullname, $password, $address;
    if (isset($_POST['btn-add'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            if (strlen($_POST['fullname']) <= 6) {
                $error['fullname'] = "Họ tên phải lớn hơn 6 ký tự";
            } else {
                $fullname = $_POST['fullname'];
            }
        }

        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            $pattern = '/^[A-Za-z0-9_\.]{5,32}$/';
            if (!preg_match($pattern, $_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            $pattern = '/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/';
            if (!preg_match($pattern, $_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{5,32}$/';
            if (!preg_match($pattern, $_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống số địa chỉ";
        } else {
            $address = $_POST['address'];
        }

        if (empty($error)) {
            //update
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'phone_number' => $phone_number,
                'address' => $address
            );

            inser_user($data);
        }
    }

    load_view('teamAdd');
}
