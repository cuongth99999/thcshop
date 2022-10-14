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
}

function addAction() {
    echo "Thêm dữ liệu";
}

function editAction() {
    $id = (int)$_GET['id'];
    $item = get_user_by_id($id);
    show_array($item);
}

function regAction() {
    global $error, $username, $password, $email, $fullname;
    if (isset($_POST['btn-reg'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            if (strlen($_POST['fullname']) <=6 ) {
                $error['fullname'] = "Họ tên phải lớn hơn 6 ký tự";
            } else {
                $fullname = $_POST['fullname'];
            }
        }

        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            $pattern = '/^[A-Za-z0-9_\.]{6,32}$/';
            if (!preg_match($pattern, $_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
            if (!preg_match($pattern, $_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
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

        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username.time());

                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token
                );

                add_user($data);

                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Bạn vui lòng click vào đường link này để kích hoạt tài khoản: {$link_active}</p>
                <p>Nếu không phải bạn đăng ký tài khoản thì hãy bỏ qua email này.</p>
                <p>Support: THC</p>";

                send_mail('cuongvip2003xz@gmail.com', "Tạ Hữu Cường", "Kích hoạt tài khoản THC", $content);

                redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email hoặc username đã tồn tại";
            }
        }
    }

    load_view('reg');
}

function activeAction() {
    $link_login = base_url('?mod=users&action=login');
    $active_token = $_GET['active_token'];
    if (check_active_token($active_token)) {
        active_user($active_token);
        echo "Bạn đã kích hoạt thành công vui lòng click vào đây để đăng nhập: <a href='{$link_login}'>Đăng nhập</a>";
    } else {
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã kích hoặc trước đó! <br> Vui lòng click vào đây để đăng nhập: <a href='{$link_login}'>Đăng nhập</a>";
    }
}

function loginAction() {
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();

        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            $pattern = '/^[A-Za-z0-9_\.]{6,32}$/';
            if (!preg_match($pattern, $_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
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

function resetAction() {
    global $error, $email;
    if (!empty($_GET['reset_token'])) {
        $reset_token = $_GET['reset_token'];
    }
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn-new-pass'])) {
                $error = array();

                if (empty($_POST['password'])) {
                    $error['password'] = "Không được để trống mật khẩu";
                } else {
                    $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
                    if (!preg_match($pattern, $_POST['password'])) {
                        $error['password'] = "Mật khẩu không đúng định dạng";
                    } else {
                        $password = md5($_POST['password']);
                    }
                }

                if (empty($_POST['confirm_password'])) {
                    $error['confirm_password'] = "Không được để trống mật khẩu";
                } else {
                    if ($_POST['confirm_password'] != $_POST['password']) {
                        $error['confirm_password'] = "Mật khẩu không trùng khớp";
                    } else {
                        $confirm_password = $_POST['confirm_password'];
                    }
                }

                if (empty($error)) {
                    $data = array(
                        'password' => $password
                    );
                    update_pass($data, $reset_token);

                    redirect("?mod=users&action=resetSuccess");
                }
            }

            load_view('newPass');
        } else {
          echo "Yêu cầu lấy lại mật khẩu không hợp lệ";
        };
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array();

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

            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email.time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    update_reset_token($data, $email);

                    // Gửi mail
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");

                    $content = "<p>Bạn vui lòng click vào đường link sau để khôi phục mật khẩu: <a href='{$link}'></a>{$link}</p>
                <p>Nếu không phải yêu cầu của bạn, hãy bỏ qua email này.</p>
                <p>Support: THC</p>";

                    send_mail($email, '', "Khôi phục mật khẩu", $content);
                } else {
                    $error['account'] = "Email không tồn tại trên hệ thống";
                }
            }
        }

        load_view('reset');
    }
}

function resetSuccessAction() {
    load_view('resetSuccess');
}
