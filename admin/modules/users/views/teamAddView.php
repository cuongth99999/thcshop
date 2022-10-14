<?php
get_header();
?>
    <style>
        .error {
            font-style: italic;
            color: red;
        }
    </style>
    <div id="main-content-wp" class="info-account-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=users&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php
            get_sidebar('users');
            ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST" action="">
                            <label for="display-name">Tên hiển thị</label>
                            <input type="text" name="fullname" id="display-name" value="<?php echo set_value('fullname'); ?>">
                            <?php echo form_error('fullname') ?>

                            <label for="username">Tên đăng nhập</label>
                            <input type="text" name="username" id="" value="<?php echo set_value('username'); ?>">
                            <?php echo form_error('username') ?>

                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email') ?>

                            <label for="new-pass">Mật khẩu</label>
                            <input type="password" name="password" id="" style="width: 420px; height: 38px; border: 1px solid #ddd">
                            <?php echo form_error('password') ?>

                            <label for="tel">Số điện thoại</label >
                            <input type="text" name="phone_number" id="" value="<?php echo !empty($_POST['phone_number'])?$_POST['phone_number']:false; ?>">
                            <?php echo form_error('phone_number') ?>

                            <label for="address">Địa chỉ</label>
                            <textarea name="address" id="address"><?php echo set_value('address'); ?></textarea>
                            <?php echo form_error('address') ?>

                            <button type="submit" name="btn-add" id="btn-submit">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>