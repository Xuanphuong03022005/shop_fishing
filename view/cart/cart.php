    <div class="container my-5">
        <div class="card shadow-sm p-4">
            <div class="row">
                <!-- Cart Section -->
                <div class="col-md-8 bg-white rounded-3 p-3">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="d-grid">
                                <h4 class="fw-bold ">Shopping Cart</h4>
                                <!-- Back to Shop -->
                                <div class="mt-2">
                                    <a href="?controller=homecontroller&action=index" class="text-decoration-none text-danger">&larr; Back to shop</a>
                                </div>
                            </div>
                            <div class="d-grid">
                                <span class="text-muted fw-bold">Tổng sản phẩm: <?php echo $_SESSION['count']; ?></span>
                                <a href="?controller=CartController&action=deleteCart" class="btn btn-info btn-sm mt-3">Xoá giỏ hàng</a>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Item -->
                    <?php if (!empty($_SESSION['cart'])) : ?>
                        <form action="?controller=OrderController&action=checkOut" method="POST">
                            <?php foreach ($_SESSION['cart'] as $key => $value) : ?>
                                <?php $total_product = $value['quantity'] * $value['price'] ?>
                                <div class="border-top py-3">
                                    <input type="hidden" name="product[<?php echo $key ?>][quantity]" value="<?php echo $value['quantity'] ?>">
                                    <div class="row align-items-center">
                                        <div class="col-1 checkbox-item-container" data-quantity="<?php echo $value['quantity'] ?>" data-id="<?php echo $value['id'] ?>">
                                            <input class="product-checkbox" type="checkbox" name="product[<?php echo $key ?>][id]" value="<?php echo $value['id'] ?>" checked>
                                        </div>
                                        <div class="col-2">
                                            <img src="public/images/<?php echo $value['image'] ?>" class="img-fluid rounded">
                                        </div>
                                        <div class="col">
                                            <p class="mb-2 text-success fw-bold"><?php echo $value['name'] ?></p>
                                            <p class="mb-2">Xuất xứ: <?php echo $value['cate_name'] ?></p>
                                            <p class="mb-0">Phân loại: <?php echo $value['fac_name'] ?></p>
                                        </div>
                                        <div class="col d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <a href="?controller=CartController&action=reduce&id=<?php echo $value['id'] ?>" onclick="showgif()" class="text-decoration-none text-dark me-2">-</a>
                                                <span class="border px-3 py-1 rounded"><?php echo $value['quantity'] ?></span>
                                                <a href="?controller=CartController&action=increase&id=<?php echo $value['id'] ?>" onclick="showgif()" class="text-decoration-none text-dark ms-2">+</a>
                                            </div>
                                            <div class="text-end">
                                                <a href="?controller=CartController&action=deleteItem&id=<?php echo $value['id'] ?>">
                                                    <i class="bi bi-trash text-danger fs-3 mb-4"></i>
                                                </a>
                                                <p class="fw-bold mb-1">Giá: <span class="text-danger"><?php echo number_format($value['price']) ?>đ</span></p>
                                                <p class="fw-bold mb-0">Tổng: <span class="text-danger"><?php echo number_format($total_product) ?>đ</span></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                </div>
                <!-- Summary Section -->
                <div class="col-md-4 bg-light rounded-3 p-4">
                    <h5 class="fw-bold text-success mb-3">Summary</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex gap-1">
                            <span class="text-danger fw-bold">Tổng: </span>
                            <span id="count" class="text-danger fw-bold"><?php echo $_SESSION['count'] ?></span>
                        </div>
                        <span id="sumprd" class="text-danger fw-bold"><?php echo number_format($_SESSION['totalCart']) ?>đ</span>
                    </div>
                    <p class="mb-1 text-danger fw-bold">SHIPPING</p>
                    <input id="shipping-code" class="form-control bg-secondary text-white fw-bold" value="30.000đ" readonly>
                    <p class="mb-1 text-danger fw-bold">VAT</p>
                    <input id="vat-code" class="form-control bg-secondary text-white fw-bold" value="10.000đ" readonly>
                    <div class="d-flex mb-2 mt-2">
                        <span class="text-danger fw-bold">Đã giảm:</span>
                        <span id="dagiam" class="text-success fw-bold ms-3"><?php echo $_SESSION['numberCode'] ?>%</span>
                    </div>
                    <div class="mb-3">
                        <!-- <form class="mb-3" method="POST" action="?controller=CartController&action=showCart"> -->
                        <p class="mb-1 text-danger fw-bold">Discount Code</p>
                        <input id="discount-code" name="code" class="form-control" placeholder="<?php echo isset($_POST['code']) ? $result['name'] : "Enter your code" ?>">
                        <p id="discount-false" class="mt-1 text-warning fw-bold fst-italic d-none">Mã giảm giá ko hợp lệ!</p>
                        <a id="cancel-discount" class="d-none" href="?controller=CartController&action=showCart">
                            <i class=" btn btn-info btn-sm mt-1" style="border-radius: 35px 10px ;">Huỷ mã</i>
                        </a>
                        <a id="btn-discount" class="btn btn-info btn-sm mt-1" style="border-radius: 35px 10px ;">Áp dụng</a>
                        <!-- </form> -->
                    </div>
                    <div class="d-flex justify-content-between border-top pt-3 mb-3">
                        <span class="text-danger fw-bold">TOTAL PRICE</span>
                        <span id="total-price" class="text-danger fw-bold"><?php echo number_format($_SESSION['totalPrice']) ?>đ</span>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success w-50" style="border-radius: 35px 10px ;">CHECKOUT</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btn-discount").click(function() {
            let discount_code_input = $("#discount-code").val();
            if (discount_code_input != "") {
                $.ajax({
                        method: "POST",
                        url: "?controller=CartController&action=discountCode",
                        data: {
                            discount_code: discount_code_input
                            // discount_code: là biến kiểu POST để truyền qua controller
                            // discount_code_input: là value của thẻ input có id là #discount-code
                        }
                    })
                    .done(function(result) { // sau khi AJAX chạy thành công
                        console.log("result", result);
                        // var idHTML = "#product-" + result.prdID;
                        // $(idHTML).remove();
                        // $("#product-43").remove();

                        if (result.success == true) {
                            $("#dagiam").text(result.numberCode + "%")
                            $("#total-price").text(result.total + " đ");
                            $("#discount-code").attr('readonly', true);
                            $("#btn-discount").remove();
                            $("#cancel-discount").removeClass('d-none');
                        } else {
                            $("#discount-false").removeClass('d-none')
                        }
                    })
                    .fail(function() { // sau khi AJAX chạy sai
                        alert("Có gì đó sai, vui lòng load lại trang!");
                        console.log("AJAX error:");
                    });
            }
        });
    </script>

    <script>
            // Bắt sự kiện khi checkbox được click
            $('.product-checkbox').on('change', function() {
                let discount_code_input = $("#discount-code").val();
                // Lấy danh sách checkbox đang được chọn
                var selectedItems = [];
                $('.product-checkbox:checked').each(function() {
                    var itemData = $(this).closest('.checkbox-item-container').data(); // Dùng data lưu trong phần tử
                    selectedItems.push(itemData); // Hoặc thêm ID/số lượng tuỳ ý
                });

                // $('.product-checkbox:checked').length != 0
                if ($('.product-checkbox:checked').length > 0) {
                    // // Gửi data qua Ajax
                    $.ajax({
                            url: '?controller=OrderController&action=checkMoneyAjax', // Thay bằng URL backend
                            method: 'POST',
                            data: {
                                items: selectedItems,
                                discount_code: discount_code_input
                            },
                        })
                        .done(function(result) {
                            console.log("result", result);
                            if (result.flag == true) {
                                $("#total-price").text(result.totalprice + " đ");
                                $("#count").text(result.count);
                                $("#sumprd").text(result.sumprd + " đ");
                            }
                        })
                        .fail(function(result) { // sau khi AJAX chạy sai
                            console.log("fail", result);
                            alert("Có gì đó sai, vui lòng load lại trang!");
                            console.log("AJAX error:");
                        });
                }else{
                    $("#total-price").text(0 + " đ");
                                $("#count").text(0);
                                $("#sumprd").text(0+ " đ");
                }



            });

    </script>