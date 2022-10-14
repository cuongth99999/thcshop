<html>
<head>
    <title>Khôi phục mật khẩu</title>
    <link rel="stylesheet" href="public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>
<body>
<div id="wrapper-form-reset">
    <h1 style="font-size: 20px">KHÔI PHỤC MẬT KHẨU</h1>
    <form action="" id="form-reset" method="post">
        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email') ?>" />
        <?php echo form_error('email') ?>

        <?php echo form_error('account'); ?>
        <input type="submit" name="btn-reset" id="btn-reset" value="Gửi yêu cầu">
    </form>
    <a href="?mod=users&action=login" id="lost-pass">Đăng nhập</a>
    <a href="?mod=users&action=reg" id="lost-pass" style="padding-left: 50px">Đăng ký</a>
</div>
</body>
</html>