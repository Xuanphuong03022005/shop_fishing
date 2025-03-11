<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-12">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-header px-4 py-5  justify-content-between">
                        <div class="text-start">
                            <h5 class="text-muted mb-0">Cảm ơn bạn đã đặt hàng , <span style="color: #a8729a;"><?php echo $_SESSION['info_users']['name'] ?></span>!</h5>
                        </div>
                        <div class="text-end">
                            <a href="?controller=homecontroller&action=index" class=" badge btn btn-outline-warning text-dark text-decoration-none btn-small">Quay lại</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0 text-info fw-bold">Hoá đơn</p>
                            <p class="small text-muted mb-0 fw-bold">Tổng sản phẩm : <?php echo $count ?></p>
                        </div>
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <!-- /////// -->
                                <?php foreach ($product as $key => $value) : ?>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="public/images/<?php echo $value['image'] ?>"
                                                class="img-thumbnail" style="width: 70px; height: 70px;" alt="Phone">
                                        </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0"><span class="fw-bold">Tên: </span><?php echo $value['product_name'] ?></p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small"><span class="fw-bold">Xuất xứ: </span><?php echo $value['cate_name'] ?></p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small"><span class="fw-bold">Phân loại: </span><?php echo $value['fac_name'] ?></p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small"><span class="fw-bold">Số lượng: </span><?php echo $value['quantity'] ?></p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <span class="fw-bold small">Giá:</span>
                                                <span class="text-danger small"><?php echo number_format($value['price']) ?>đ</span>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                <?php endforeach ?>
                                <!-- //// -->

                                <div class="row d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="progress" style="height: 6px; border-radius: 16px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 70%; border-radius: 16px; background-color: orange;" aria-valuenow="20"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-around mb-1">
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">xác nhận đơn hàng</p>
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">Đang giao hàng</p>
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">Đã giao</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between mx-5">
                            <!-- Cột 1 -->
                            <div class="col-md-6 text-start">
                                <div class="  pt-2">
                                    <p class="fw-bold mb-0">Chi tiết đơn hàng</p>
                                </div>
                                <div class=" pt-2">
                                    <p class="text-muted mb-0">Mã đơn hàng: <?php echo $result['id'] ?></p>
                                </div>
                                <div class="">
                                    <p class="text-muted mb-0">Ngày đặt: <?php echo $result['date'] ?></p>
                                </div>
                                <div class=" mb-5">
                                    <p class="text-muted mb-0">Mã giảm giá: <?php echo $result['discount_name'] ?></p>
                                </div>
                            </div>

                            <!-- Cột 2 -->
                            <div class="col-md-6 text-end">
                                <div class="pt-2">
                                    <p class="text-muted mb-0"><span class="fw-bold">Tổng cộng:</span> <span class="text-danger"><?php echo number_format($result['total_money']) ?>đ</span></p>
                                </div>
                                <div class="pt-2">
                                    <p class="text-muted mb-0"><span class="fw-bold">Đã giảm:</span> <span class="text-danger">-<?php echo number_format($result['reduce_money']) ?>đ</span></p>
                                </div>
                                <div class="">
                                    <p class="text-muted mb-0"><span class="fw-bold">Phí giao hàng:</span><span> 40.000</span>đ</p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class=" card-footer border-0 px-4 py-5 " style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <h5 class="text-end align-items-center justify-content-end text-white text-uppercase mb-0">
                                Thanh toán: <span class="h2 mb-0 ms-2 text-warning"><?php echo number_format($result['total_money']) ?>đ</span>
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>