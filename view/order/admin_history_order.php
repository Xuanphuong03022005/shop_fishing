<a onclick="showgif()" href="?controller=homecontroller&action=index" class="fs-1 ms-4 text-dark">
        <i class="bi bi-arrow-left"></i>
    </a>
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
                        <td class="text-danger"><?php echo number_format($value['total_money']) ?>đ</td>
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
<script>
    $('[id^="confirm"]').click(function() {
        var status = $(this).text();
        var id = $(this).closest('#father').find('td.id').data('id');
        console.log(status)
        if (status == 'chờ xác nhận') {
            $.ajax({
                    url: "?controller=OrderController&action=updateStatus",
                    type: "POST",
                    data: {
                        id: id,
                        status: 'đã nhận hàng'
                    }
                })
                .done(function(result) {
                    if (result.flag == true) {
                        $(`#confirm${id}`).text('đã nhận hàng')
                        $(`#confirm${id}`).removeClass()
                        $(`#confirm${id}`).addClass('border-0 badge bg-success')
                    }
                })
        }
    })
</script>
