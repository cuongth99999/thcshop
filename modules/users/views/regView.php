<html>
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="public/css/reg.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>
<body>
<div id="wrapper-form-reg">
    <h1>ĐĂNG KÝ</h1>
    <form action="" id="form-reg" method="post">

        <input type="text" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo set_value('fullname') ?>" />
        <?php echo form_error('fullname') ?>

        <input type="text" name="username" id="username" placeholder="Username" value="<?php echo set_value('username') ?>" />
        <?php echo form_error('username') ?>

        <input type="password" name="password" id="password" placeholder="Password" value="" />
        <?php echo form_error('password') ?>

        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email') ?>" />
        <?php echo form_error('email') ?>

        <input type="submit" name="btn-reg" id="btn-reg" value="Đăng ký">
        <?php echo form_error('account'); ?>
    </form>
    <a href="?mod=users&action=reset" id="lost-pass">Quên mật khẩu?</a>
    <a href="?mod=users&action=login" id="lost-pass" style="padding-left: 50px">Đăng nhập</a>
</div>
</body>
</html>