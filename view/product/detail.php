<?php require_once('view/modal/add_product.php'); ?>
<main>
    <a onclick="showgif()" href="?controller=homecontroller&action=index" class="fs-1 ms-4 text-dark">
        <i class="bi bi-arrow-left"></i>
    </a>

    <div class="container mt-2">
        <div class="row">
            <div class="col-sm-4 shadow">
                <img src="public/images/<?php echo $result['image'] ?>" style="height: 350px; width: 350px">
            </div>
            <div class="col-sm-8 ">
                <span class="d-block fs-1 fw-bold mb-3 fst-italic text-success"><?php echo $result['name'] ?></span>
                <span class="d-block fs-4 text-danger mb-3">Giá: <?php echo number_format($result['price']) ?>đ</span>
                <span class="d-block fw-bold mb-3">Chính sách trả hàng: Trả hàng trong vòng 15 ngày</span>
                <span class="d-block fw-bold mb-3">Bảo hiểm: Bảo vệ người tiêu dùng</span>
                <span class="d-block fw-bold mb-3">Xuất xứ: <?php echo $result['cate_name'] ?></span>
                <span class="d-block fw-bold mb-3">Phân loại: <?php echo $result['fac_name'] ?></span>
                <div class="d-grid w-25 gap-1 mt-4">
                    <!-- <form action="?controller=CartController&action=addCart" method="POST"> -->
                        <div class="input-group mb-2 justify-content-center">
                            <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                            <input type="hidden" name="gia" value="<?php echo $result['price'] ?>">
                            <input type="hidden" name="name" value="<?php echo $result['name'] ?>">
                            <input type="hidden" name="image" value="<?php echo $result['image'] ?>">
                            <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                            <input type="number" id="quantity" name="quantity" class="quantity form-control w-25 text-center" value="1" min="1" max="10" required>
                            <a
                                <?php if (isset($_SESSION['info_users'])) : ?>
                               type="submit" class="btn btn-light btn-sm" onclick="showgif()"
                                <?php else : ?>
                                type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                <?php endif ?>>
                                <a class="addCart"><img src="public/images/logo_cart2.jpg" style="height: 29px;"></a>
                                </a>
                        </div>
                    <!-- </form> -->
                    <form method="POST" action="?controller=OrderController&action=byNow">
                        <input type="hidden" id="id" name="id" value="<?php echo $result['id'] ?>">
                        <input type="hidden" name="quantity" id="qty_hidden" class="qty_hidden" value="1">
                        <button class="btn btn-success mt-auto w-100"
                            style="border-radius:0 50px 0 50px"
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
    </div>
</main>
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
    $(document).ready(function(){
        var id = $('#id').val()
        console.log(id)
        $.ajax({
            url: "?controller=productcontroller&action=viewed",
            type: "POST",
            data: {
                id : id
            }
        })
    })
</script>
<script>
$('#quantity').click(function(){
    var quantity_input = $(this).val();
    var qty_hidden = $('#qty_hidden').val(quantity_input);
   
})

</script>
<script>
    $('.addCart').click(function() {
        var id = $('#id').val();
        var quantity = $('#quantity').val();
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