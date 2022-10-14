<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <base href="<?php echo base_url(); ?>">
        <link rel="stylesheet" href="public/css/reset.css" type="text/css">
        <link rel="stylesheet" href="public/css/style.css" type="text/css">
        <link rel="stylesheet" href="public/css/login.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="public/js/customs.js" type="text/javascript"></script>
        <meta charset="utf-8">
    </head>
    <body>
        <style>
            #show_list_file {
                width: 200px;
                height: 200px;
                overflow: hidden;
            }

            #show_list_file img {
                max-width: 100%;
                max-height: 100%;
            }
        </style>
        <?php
            if (is_login()) {
                ?>
                <div id="user-login">
                    <p>Xin chào <strong><?php echo $_SESSION['user_login']; ?></strong> (<a href="?mod=users&action=logout" style="text-decoration: none">Đăng xuất</a>)</p>
                </div>
                <?php
            }
        ?>
        <div id="wrapper">
            <div id="header">
                <ul id="main-menu">
                    <li><a href="?page=home">Trang chủ</a></li>
                    <li><a href="?page=about">Giới thiệu</a></li>
                    <li><a href="?page=post">Tin tức</a></li>
                    <li><a href="?page=product">Sản phẩm</a></li>
                    <li><a href="?page=contact">Liên hệ</a></li>
                </ul>
            </div>