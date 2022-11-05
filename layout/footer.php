<?php
if (isset($_POST['btn-reg-sale'])) {
    if (empty($_POST['email'])) {
        $error['email'] = "Không được để trống địa chỉ email";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Địa chỉ email không đúng định dạng";
        } else {
            $email = $_POST['email'];
        }
    }

    if (empty($error)) {
        $subject = 'Thông báo đăng ký nhận thông báo ưu đãi mới nhất của ISMART thành công';

        $content = '<p>Chúc mừng bạn đã đăng ký nhận thông báo ưu đãi tại ISMART thành công!</p>';
        $content .= '<p>Từ bây giờ khi có những ưu đãi mới ra mắt sẽ được gửi thông báo tới bạn nhanh và sớm nhất.</p>';

        send_mail($email, $email, $subject, $content);

        redirect('?');
    }
}
?>
<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <h3 class="title">ISMART</h3>
                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                <div id="payment">
                    <div class="thumb">
                        <img src="public/images/img-foot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p>63 - Đắc Sở - Hoài Đức - Hà Nội</p>
                    </li>
                    <li>
                        <p>0987.654.321 - 0989.989.989</p>
                    </li>
                    <li>
                        <p>cuongth99999@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Chính sách mua hàng</h3>
                <ul class="list-item">
                    <li>
                        <a href="#" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách hội viện</a>
                    </li>
                    <li>
                        <a href="#" title="">Giao hàng - lắp đặt</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chúng tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                        <button type="submit" name="btn-reg-sale" id="sm-reg">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">Copyright © 2022. Xây dựng bởi THC. All rights reserved.</p>
        </div>
    </div>
</div>
</div>
<div id="btn-top"><img src="public/images/icon-to-top.png" alt=""/></div>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>