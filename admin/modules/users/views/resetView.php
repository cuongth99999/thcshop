<?php
get_header();
?>
    <style>
        .error {
            font-style: italic;
            color: red;
        }
    </style>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Đổi mật khẩu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="password_old" id="pass-old">
                        <?php echo form_error('password_old') ?>

                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="password" id="pass-new">
                        <?php echo form_error('password') ?>

                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_password" id="confirm-pass">
                        <?php echo form_error('confirm_password') ?>

                        <button type="submit" name="btn-new-pass" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>