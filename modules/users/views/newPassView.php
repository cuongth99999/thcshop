<html>
<head>
    <title>Thiết lập mật khẩu mới</title>
    <link rel="stylesheet" href="public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>
<body>
<div id="wrapper-form-reset">
    <h1 style="font-size: 20px">ĐẶT LẠI MẬT KHẨU</h1>
    <form action="" id="form-reset" method="post">
        <input type="password" name="password" id="password" placeholder="Mật khẩu mới" value="" />
        <?php echo form_error('password') ?>

        <input type="password" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu mới" value="" />
        <?php echo form_error('confirm_password') ?>

        <?php echo form_error('account'); ?>
        <input type="submit" name="btn-new-pass" id="btn-new-pass" value="Đặt lại mật khẩu">
        <a href="?mod=users&action=login" id="lost-pass">Đăng nhập</a>
        <a href="?mod=users&action=reg" id="lost-pass" style="padding-left: 50px">Đăng ký</a>
    </form>
</div>
</body>
</html>