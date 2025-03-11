<div class="container center">
    <h1 class="my-3">LỊCH SỬ MUA HÀNG</h1>
    <label id="history-order" data-name="orders" class="badge bg-success">Đã mua</label>
    <label id="history-received" data-name="received" class="badge bg-info text-dark">Đã nhận</label>
    <label id="canceled" class="badge bg-danger">Đã huỷ</label>
    <label id="history-viewed" data-name="viewed" class="badge bg-dark">Đã xem</label>
</div>
<!-- lịch sử mua hàng -->
<div class="container my-5  orders order">
    <h4 class="mb-4 border border-danger w-25 text-center py-2">ĐƠN ĐẶT HÀNG</h5>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên người mua</th>
                    <th>Giảm tiền</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $value) : ?>
                    <tr id="father">
                        <td class="id" data-id="<?php echo $value['id'] ?>"><?php echo $value['id'] ?></td>
                        <td><?php echo $value['user_name'] ?></td>
                        <td class="text-danger">-<?php echo number_format($value['reduce_money']) ?>đ</td>
                        <td class="text-success fw-bold"><?php echo number_format($value['total_money']) ?>đ</td>
                        <td><?php echo $value['created_at'] ?></td>
                        <td><button id="confirm<?php echo $value['id'] ?>" class="border-0 badge 
                    <?php if ($value['status'] == "chờ xác nhận" || $value['status'] == "đang vận chuyển") : ?>
                        bg-warning
                    <?php elseif ($value['status'] == "Lỗi") : ?>
                        bg-danger
                    <?php else : ?>
                        bg-success
                    <?php endif ?>
                        "><?php echo $value['status'] ?></button></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</div>
<!-- ///// -->
<!-- Thành công -->
<div class="container my-5 d-none received order">
    <h4 class="mb-4 border border-danger w-25 text-center py-2">ĐÃ NHẬN HÀNG</h5>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên người mua</th>
                    <th>Giảm tiền</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result2 as $key => $value) : ?>
                    <tr id="father">
                        <td class="id" data-id="<?php echo $value['id'] ?>"><?php echo $value['id'] ?></td>
                        <td><?php echo $value['user_name'] ?></td>
                        <td class="text-danger">-<?php echo number_format($value['reduce_money']) ?>đ</td>
                        <td class="text-danger"><?php echo number_format($value['total_money']) ?>đ</td>
                        <td><?php echo $value['created_at'] ?></td>
                        <td><label class="badge bg-success"><?php echo $value['status'] ?></label></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</div>
<!-- //// -->
<!-- đã xem -->
<div class="container my-5 d-none viewed order">
    <h4 class="mb-4 border border-danger w-25 text-center py-2">Đã xem</h5>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['viewed'] as $key => $value) : ?>
                    <tr>
                        <td><img src="public/images/<?php echo $value['image'] ?>" style="height: 50px; width: 50px"></td>
                        <td><?php echo $value['name'] ?></td>
                        <td class="text-danger"><?php echo number_format($value['price']) ?>đ</td>
                    <?php endforeach ?>
            </tbody>
        </table>
</div>
<!-- //// -->
<!-- modal -->
<div class="modal" id="addToCart" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <h5 class="modal-title text-center text-white" id="exampleModalLabel2">Đã yêu cầu người bán duyệt đơn</h5>
        </div>
    </div>
</div>
<div class="modal" id="addToCart-spam" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <h5 class="modal-title text-center text-danger" id="exampleModalLabel2">Yêu cầu không spam nhiều lần</h5>
        </div>
    </div>
</div>
<!--/////-->
<script>
    $('[id^="confirm"]').click(function() {
        var status = $(this).text();
        var id = $(this).closest('#father').find('td.id').data('id');
        if (status == 'đã nhận hàng') {
            $.ajax({
                    url: "?controller=OrderController&action=updateStatus",
                    type: "POST",
                    data: {
                        id: id,
                        status: 'thành công'
                    }
                })
                .done(function(result) {
                    if (result.flag == true) {
                        $(`#confirm${id}`).closest('tr').remove('tr')
                    }
                })
        }
        if (status == 'chờ xác nhận') {
            $.ajax({
                    url: "?controller=OrderController&action=requestConfirmation",
                    type: "POST",
                    data: {
                        id: id
                    }
                })
                .done(function(result) {
                    console.log(result)
                    if (result.flag == true) {
                        $('.count-request').text(result.count)
                        $('#addToCart').modal('show');
                        setTimeout(function(){
                            $('#addToCart').modal('hide');
                        }, 1000)
                    }
                    if (result.flag == false){
                        $('#addToCart-spam').modal('show');
                        setTimeout(function(){
                            $('#addToCart-spam').modal('hide');
                        }, 1000)
                    }
                })
        }
    })
</script>
<script>
    $(document).ready(function() {
        $('[id^="history"]').click(function() {
            console.log(this)
            var elementClass = $(this).data('name');
            $(`.order`).addClass('d-none')
            $(`.${elementClass}`).removeClass('d-none')
        })
    })
</script>