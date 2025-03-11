
<a class="badge rounded bg-info text-dark mt-3 text-decoration-none" href="?controller=OrderController&action=historyOrder">Lịch sử</a>
<div class="container py-3">
    <div class="row">
        <!-- Phần bên trái: Sự kiện -->
        <div class="col-12 col-lg-3">
            <div class="row d-flex flex-column gap-3">
                <?php foreach ($result_event as $key => $value) : ?>
                    <div class="card" style="display: flex; flex-direction: row; align-items: center; gap: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <div>
                            <img src="public/images/<?php echo $value['image'] ?>" alt="Fishing Image" style="height: 90px; width: 90px; object-fit: cover; border-radius: 5px;">
                        </div>
                        <div style="flex: 1;">
                            <p style="margin: 0; font-weight: bold;"><?php echo $value['event'] ?></p>
                            <small style="color: gray;"><?php echo $value['time'] ?></small>
                        </div>
                    </div>
                <?php endforeach ?>
                <a class="text-decoration-none" href="?controller=EventController&action=showAddEvent">
                    <p class=" btn btn-outline-warning text-muted border w-75 px-3 text-decoration-none">Thêm sự kiện......!</p>
                </a>
            </div>
        </div>
        <!-- Phần bên phải: Danh sách sản phẩm -->
        <div class="col-12 col-lg-9 ">
            <div class="row g-4" id="product-list">
                <?php foreach ($result as $key => $value) : ?>
                    <div class="product-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <div  class="card shadow-lg bg-body rounded h-100 d-flex flex-column">
                            <div class="ratio ratio-1x1">
                                <a  onclick="showgif()" href="?controller=productcontroller&action=showProduct&id=<?php echo $value['id'] ?>">
                                    <img class="card-img-top img-fluid" src="public/images/<?php echo $value['image'] ?>" alt="Card image" style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="card-body d-flex flex-column text-center pb-3">
                                <h5 class="card-title text-danger mb-2"><?php echo number_format($value['price']) ?>đ</h5>
                                <p class="card-text flex-grow-1 mb-2">
                                    <strong><?php echo $value['name'] ?></strong>
                                </p>
                                <!-- <form action="?controller=CartController&action=addCart" method="POST"> -->
                                <div id="id-product" class="input-group mb-2 justify-content-center">
                                    <input type="hidden" name="gia" value="<?php echo $value['price'] ?>">
                                    <input type="hidden" name="name" value="<?php echo $value['name'] ?>">
                                    <input type="hidden" name="image" value="<?php echo $value['image'] ?>">
                                    <input type="hidden" id="id" name="id" value="<?php echo $value['id'] ?>">
                                    <input type="number" id="quantity" name="quantity" class="quantity form-control w-25 text-center me-2" value="1" min="1" max="10" required>
                                    <!-- <button
                                            <?php if (isset($_SESSION['info_users'])) : ?>
                                            name="addCart" type="submit" class="btn btn-light btn-sm" onclick="showgif()"
                                            <?php else : ?>
                                            type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            <?php endif ?>>
                                            <img src="public/images/logo_cart2.jpg" style="height: 29px;">
                                        </button> -->
                                    <a class="add-cart" class="btn btn-light btn-sm"><img src="public/images/logo_cart2.jpg" style="height: 29px;"></a>
                                </div>
                                <!-- </form> -->
                                <form method="POST" action="?controller=OrderController&action=byNow">
                                    <input type="hidden" name="id" value="<?php echo $value['id'] ?> ">
                                    <input type="hidden" name="quantity" id="qty_hidden" class="qty_hidden" value="1">
                                    <button class="btn btn-success mt-auto w-100"
                                        <?php if (!isset($_SESSION['info_users'])) : ?>
                                        type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        <?php else : ?>
                                        type="submit" onclick="showgif()"
                                        <?php endif ?>>
                                        Mua ngay
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="addToCart" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel2">Thêm vào giỏ hàng thành công</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex">
                <img id="image-modal" src="public/images/1.webp" class="w-25 shadow-lg me-3">
                <div class="d-grid">
                    <p>
                        Tên sản phẩm: <span class="text-info" id="modal-name"></span>
                    </p>
                    <p>
                        Số lượng: <span class="text-info" id="modal-quantity"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.add-cart').click(function() {
        var id = $(this).closest('#id-product').find('input#id').val();
        var quantity = $(this).closest('#id-product').find('input#quantity').val();
        console.log(id)
        $.ajax({
                url: "?controller=CartController&action=addCart",
                type: "POST",
                data: {
                    id: id,
                    quantity: quantity
                }
            })
            .done(function(result) {
                console.log(result.image)
                if (result.flag == true) {
                    $('#image-modal').attr('src', 'public/images/' + result.image)
                    $('#modal-name').text(result.name);
                    $('#modal-quantity').text(result.quantity);
                    $('#addToCart').modal('show');
                    setTimeout(function() {
                        $('#addToCart').modal('hide');
                    }, 1700);

                    $('.count-item-in-cart').text(result.countItemInCart);
                } else {
                    alert('Thêm không thành công!!!')
                }
            })
            .fail(function() {
                alert('Đã xảy ra lỗi, vui lòng load lại trang!')
            })
    })
</script>