<?php if (isset($flagOrder) && $flagOrder == false) : ?>
    <div class="modal fade show " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block; margin-top: 100px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Bạn chưa chọn sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hãy chọn những sản phẩm cần mua
                </div>
                <div class="modal-footer">
                    <a href="?controller=CartController&action=showCart">
                        <button type="button" class="btn btn-primary">Thoát</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center pb-3 border-bottom">
                <h2 class="h5 mb-0 text-success fw-bold ">XÁC NHẬN ĐƠN HÀNG</h2>
                <a href="?controller=homecontroller&action=index" class="btn btn-outline-danger btn-sm">Huỷ bỏ</a>
            </div>

            <!-- Main content -->
            <form action="?controller=OrderController&action=orderPayment" method="POST">
                <div class="row mt-4">
                    <div class="col-lg-8">
                        <!-- Details -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="me-3 text-muted fw-bold"><?php echo date("d-m-Y") ?></span>
                                        <span class="badge rounded-pill bg-info text-white">SHIPPING</span>
                                    </div>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <?php foreach ($_SESSION['data'] as $key => $value) : ?>
                                                <div class="d-flex align-items-center pb-3">
                                                    <!-- Hình ảnh sản phẩm -->
                                                    <div class="me-3">
                                                        <img src="public/images/<?php echo $value['image'] ?>" alt="" width="50" class="rounded">
                                                    </div>

                                                    <!-- Tên sản phẩm và màu sắc -->
                                                    <div class="d-grid me-3">
                                                        <a href="#" class="text-decoration-none fw-bold"><?php echo $value['name'] ?></a>
                                                        <div class="small text-muted">Xuất xứ: <?php echo $value['cate_name'] ?></div>
                                                        <div class="small text-muted">Phân loại: <?php echo $value['fac_name'] ?></div>
                                                    </div>

                                                    <!-- Số lượng và giá -->
                                                    <div class="d-flex ms-auto">
                                                        <div class="text-center me-5"><?php echo $value['quantity'] ?></div>
                                                        <div class="text-danger fw-bold"><?php echo number_format($value['price']) ?>đ</div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="products[<?php echo $key ?>][id]" value="<?php echo $value['id'] ?>">
                                                <input type="hidden" name="products[<?php echo $key ?>][price]" value="<?php echo $value['price'] ?>">
                                                <input type="hidden" name="products[<?php echo $key ?>][quantity]" value="<?php echo $value['quantity'] ?>">
                                                <hr>
                                            <?php endforeach ?>

                                        </tr>
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="2">Subtotal</td>
                                            <td class="text-end fw-bold text-danger"><?php echo number_format($_SESSION['subTotal']) ?>đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Shipping</td>
                                            <td class="text-end">40.000</td>
                                        </tr>
                                        <tr>
                                            <td class="text-success fw-bold" colspan="2">Discount:
                                                <?php if (isset($_SESSION['discountCode']) && $_SESSION['discountCode'] != false) : ?>
                                                    <?php echo $_SESSION['discountCode'] ?>%
                                                <?php else : ?>
                                                    <span class="discount-code">Chưa có mã</span>
                                                <?php endif ?>
                                            </td>
                                            <td class="text-danger text-end">
                                                <?php if (isset($_SESSION['reduceMoney']) && $_SESSION['reduceMoney'] != false) : ?>
                                                    -<?php echo number_format($_SESSION['reduceMoney']) ?>đ
                                                <?php else : ?>
                                                    <span class="reduce-money">0đ</span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="float-strat rounded-cirde d-flex">

                                                <input id="discount-code-value" class="me-3" name="discount" type="text"

                                                    <?php if (isset($_SESSION['discountName']) &&  $_SESSION['discountName'] != false) : ?>
                                                    value="<?php echo  $_SESSION['discountName'] ?>" readonly
                                                    <?php else : ?>
                                                    placeholder="Nhập mã giảm giá"
                                                    <?php endif ?>>
                                                <?php if (!isset($_POST['discount']) && $_SESSION['discount_name'] == 0) : ?>
                                                    <a id="add-discount-code" class="btn btn-success btn-sm" style="border-radius:  30px 0;">Chọn mã</a>
                                                <?php else : ?>
                                                    <a class="btn btn-success btn-sm" style="border-radius:  30px 0;" href="?controller=OrderController&action=showOrder&note=deleteDiscount">Huỷ mã</a>
                                                <?php endif ?>
                                                <a id="remove-discount-hidden" class="btn btn-success btn-sm d-none" style="border-radius:  30px 0;" href="?controller=OrderController&action=showOrder&note=deleteDiscount">Huỷ mã</a>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div id="erro-discount" class="text-danger d-none">Mã không hợp lệ!!</div> 
                                            </td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="2">TOTAL</td>
                                            <td class="text-end fw-bold text-danger"><span class="total"><?php echo number_format($_SESSION['totalOder']) ?></span>đ</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Customer Notes -->
                        <div class="card shadow-sm mb-4">
                            <!-- Payment -->

                            <div class="card-body row">
                                <div class="col-md-12 mb-2">
                                    <div class="fw-bold">Phương thức thanh toán</div>
                                    <div class="">
                                        <i>Thanh toán khi nhận hàng</i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex gap-2">
                                        <div class="text-info fw-bold">Tổng tiền phải thanh toán </div>
                                        <div><span class="badge bg-success">PAID</span></div>
                                    </div>
                                    <div class="text-danger fw-bold"><span id="total-order"><?php echo number_format($_SESSION['totalOder']) ?></span>đ</div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-md-12">
                                    <h5 class="fw-bold">Thông tin nhận hàng</h5>
                                </div>
                                <div class="mb-3  ">
                                    <h6 class="text-info ">Họ và Tên: </h6>
                                    <input class="text-muted w-100" type="text" name="user_name" value="<?php echo $_SESSION['info_users']['name'] ?>">
                                </div>
                                <div class="mb-3  ">
                                    <h6 class="text-info ">Số điện thoại: </h6>
                                    <input class="text-muted w-100" type="text" name="user_number_phone" value="<?php echo $_SESSION['info_users']['phone'] ?>">
                                </div>
                                <div class="mb-3 ">
                                    <h6 class="text-info ">Email: </h6>
                                    <input class="text-muted w-100" type="text" name="user_email" value="<?php echo $_SESSION['info_users']['email'] ?>">
                                </div>
                                <div class="mb-3 ">
                                    <h6 class="text-info ">Địa chỉ: </h6>
                                    <input class="text-muted w-100" type="text" name="user_address" value="<?php echo $_SESSION['info_users']['address'] ?>">
                                </div>
                                <div class="mb-3 ">
                                    <h6 class="text-info ">Ghi chú: </h6>
                                    <textarea class="text-muted w-100" rows="3" name="note" placeholder="Mời bạn nhập ghi chú"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['info_users']['id'] ?>">
                        <input id="discount-code-hidden" type="hidden" name="discount_code" value="<?php echo $_SESSION['discountCode'] ?>">
                        <input id="discount-name-hidden" type="hidden" name="discount_name" value="<?php echo $_SESSION['discountName'] ?>">
                        <input id="reduce-money-hidden" type="hidden" name="reduce_money" value="<?php echo $_SESSION['reduceMoney'] ?>">
                        <input id="total-money-hidden" type="hidden" name="total_money" value="<?php echo $_SESSION['totalOder'] ?>">
                        <a id="order" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="mt-1 btn btn-success">Đặt hàng</a>
                    </div>
                </div>
                <!-- ////// -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h5  class="modal-title fw-bold" id="staticBackdropLabel">Đặt hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Đơn hàng trị giá: <span class="total-modal text-danger fw-bold"></span></p>
                               <i> Bạn có chắc muốn đặt hàng hay không ?</i>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                <button type="submit" class="btn btn-warning">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //////// -->
            </form>     
        </div>
    </div>
<?php endif ?>
<script>
    $('#order').click(function(){
        var total = $('#total-money-hidden').val();
        console.log(total)
        $('.total-modal').text(numberFormat(total) + "đ")
    })
</script>
<script>
    $('#add-discount-code').click(function() {
        var data = $('#discount-code-value').val();
        $.ajax({
                url: "?controller=OrderController&action=discountAjax",
                type: "POST",
                data: {
                    discount: data
                }
            })
            .done(function(result) {
                console.log(result)
                if (result.flag == true) {
                    $('.total').text(numberFormat(result.total));
                    $('.discount-code').text(result.discount_code + "%");
                    $('#discount-code-value').val(result.discount_name);
                    $('#discount-code-value').attr('readonly', true);
                    $('.reduce-money').text(numberFormat(result.reduce_money) + "đ");
                    $('#add-discount-code').remove();
                    $('#remove-discount-hidden').removeClass('d-none');
                    $('#total-order').text(numberFormat(result.total));
                    $('#discount-code-hidden').val(result.discount_code);
                    $('#discount-name-hidden').val(result.discount_name);
                    $('#reduce-money-hidden').val(result.reduce_money);
                    $('#total-money-hidden').val(result.total);
                } else {
                    $('#erro-discount').removeClass('d-none');
                  setTimeout(function(){
                    $('#erro-discount').addClass('d-none');
                  }, 2000)
                }

            })
    });

    function numberFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>