<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/login.css" type="text/css">
</head>
<body>
<div id="wrapper-form-login">
    <h1>ĐĂNG NHẬP</h1>
    <form action="" id="form-login" method="post">

        <input type="text" name="username" id="username" placeholder="Username" value="<?php echo set_value('username') ?>" />
        <?php echo form_error('username') ?>

        <input type="password" name="password" id="password" placeholder="Password" value="" />
        <?php echo form_error('password') ?>

        <input type="submit" name="btn-login" id="btn-login" value="Đăng nhập">

        <?php echo form_error('account'); ?>
    </form>
</div>
</body>
</html>