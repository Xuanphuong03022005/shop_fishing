<header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="?controller=homecontroller&action=index">
                <img src="public/images/logo.png" style="width: 60px; height: 60px">
            </a>
            <div class="collapse navbar-collapse " id="mynavbar">
                <ul class="navbar-nav me-auto fw-bold ">
                    <li class="nav-item">
                        <a class="nav-link text-info" href="?controller=productcontroller&action=searchbyid&id=can">CẦN TAY</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-info " href="?controller=productcontroller&action=searchbyid&id=may">CẦN MÁY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info" href="?controller=productcontroller&action=searchbyid&id=thung">THÙNG CÂU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info" href="?controller=productcontroller&action=searchbyid&id=ghe">GHẾ CÂU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info" href="?controller=productcontroller&action=searchbyid&id=truc">TRỤC</a>
                    </li>
                </ul>
                <a href="?controller=CartController&action=showCart" class=" position-relative btn btn-light  btn-sm me-5 text-danger">
                    <img src="public/images/logo_cart2.jpg" style="height: 20px;  width: 20px">
                    Giỏ hàng
                    <span class="count-item-in-cart position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo isset($_SESSION['count']) ?  $_SESSION['count'] : "" ?>
                    </span>
                </a>
                <?php if (!isset($_SESSION['info_users'])) : ?>
                    <a class="btn btn-sm btn-primary me-5" href="?controller=logincontroller&action=showLogin">Đăng nhập</a>
                <?php endif ?>
                <div class="d-flex">

                </div>
                <!-- <form method="POST" action="?controller=productcontroller&action=search" class="d-flex justify-content-center "> -->
                <div class="d-flex justify-content-center ">
                    <div class="input-group r " style="width: 30px; width: 100%;">
                        <input id="search-value" type="text" name="search" placeholder="Nhập sản phẩm" class="form-control form-control-lg border-light">
                        <button type="submit" class="btn btn-light btn-lg  rounded-end" id="button-search">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <!-- </form> -->
                <!-- Nút Menu cố định trên cùng bên phải -->
                <a class="btn btn-lg btn-dark float-end  ms-3" data-bs-toggle="offcanvas" data-bs-target="#demoMenu"><i class="bi bi-person-circle"></i></a>
               
            </div>
        </div>
    </nav>
</header>
