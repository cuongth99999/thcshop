<div id="sidebar" class="fl-left">
    <ul id="sidebar-menu">
        <li class="nav-item <?php echo !empty($_GET['mod']) && $_GET['mod']=='products'?'active':false; ?>">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-product-hunt icon"></span>
                <span class="title">Sản phẩm</span>
            </a>
            <ul class="sub-menu" style="<?php echo !empty($_GET['mod']) && $_GET['mod']=='products'?'display: block;':false; ?>">
                <li class="nav-item">
                    <a href="?mod=products&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=products" title="" class="nav-link">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=products&controller=cat" title="" class="nav-link">Danh mục sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=products&controller=brand" title="" class="nav-link">Hãng sản xuất</a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?php echo !empty($_GET['mod']) && $_GET['mod']=='orders'?'active':false; ?>">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-database icon"></span>
                <span class="title">Bán hàng</span>
            </a>
            <ul class="sub-menu" style="<?php echo !empty($_GET['mod']) && $_GET['mod']=='orders'?'display: block;':false; ?>">
                <li class="nav-item">
                    <a href="?mod=orders&action=add" title="" class="nav-link">Thêm đơn hàng mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=orders" title="" class="nav-link">Danh sách đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=orders&action=customers" title="" class="nav-link">Danh sách khách hàng</a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?php echo !empty($_GET['mod']) && $_GET['mod']=='pages'?'active':false; ?>">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-map icon"></span>
                <span class="title">Trang</span>
            </a>
            <ul class="sub-menu" style="<?php echo !empty($_GET['mod']) && $_GET['mod']=='pages'?'display: block;':false; ?>">
                <li class="nav-item">
                    <a href="?mod=pages&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=pages" title="" class="nav-link">Danh sách các trang</a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?php echo !empty($_GET['mod']) && $_GET['mod']=='posts'?'active':false; ?>">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-pencil-square-o icon"></span>
                <span class="title">Bài viết</span>
            </a>
            <ul class="sub-menu" style="<?php echo !empty($_GET['mod']) && $_GET['mod']=='posts'?'display: block;':false; ?>">
                <li class="nav-item">
                    <a href="?mod=posts&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=posts" title="" class="nav-link">Danh sách bài viết</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=posts&controller=cat" title="" class="nav-link">Danh mục bài viết</a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?php echo !empty($_GET['mod']) && $_GET['mod']=='sliders'?'active':false; ?>">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="title">Slider</span>
            </a>
            <ul class="sub-menu" style="<?php echo !empty($_GET['mod']) && $_GET['mod']=='sliders'?'display: block;':false; ?>">
                <li class="nav-item">
                    <a href="?mod=sliders&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=sliders" title="" class="nav-link">Danh sách slider</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
