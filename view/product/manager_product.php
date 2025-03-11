<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<a onclick="showgif()" href="?controller=homecontroller&action=index" class="fs-1 text-dark">
  <i class="bi bi-arrow-left"></i>
</a>
<div class="text-center mt-1 fs-2">
  <span class="text-danger fw-bold">THÔNG TIN DANH SÁCH SẢN PHẨM</span>
</div>
<table class="table table-bordered mt-2">
  <thead>
    <tr>
      <th>ID</th>
      <th>ẢNH</th>
      <th>TÊN ĐƠN HÀNG</th>
      <th>GIÁ</th>
      <th>XUẤT XỨ</th>
      <th>PHÂN LOẠI</th>
      <th>XOÁ</th>
      <th>CẬP NHẬT</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $key => $value) : ?>
      <tr>
        <td><?php echo $value['id'] ?></td>
        <td>
          <img src="public/images/<?php echo $value['image'] ?>" style="height: 50px; width: 50px">
        </td>
        <td><?php echo $value['name'] ?></td>
        <td><?php echo $value['price'] ?></td>
        <td><?php echo $value['name_cate'] ?></td>
        <td><?php echo $value['name_fac'] ?></td>
        <td>
          <!-- <a href="?controller=productcontroller&action=delete&image=<?php echo $value['image'] ?>&id=<?php echo $value['id'] ?>"> -->
          <i id="delete-item<?php echo $value['id'] ?>" data-id="<?php echo $value['id'] ?>" class="bi bi-trash text-danger fs-3 "></i>
          <input type="hidden" id="image" value="<?php echo $value['image'] ?>">
          <!-- </a> -->
        </td>
        <td class="text-center">
          <a href="?controller=productcontroller&action=edit&image=<?php echo $value['image'] ?>&id=<?php echo $value['id'] ?>">
            <i class="bi bi-pen text-danger fs-3"></i>
          </a>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<script>
    $('[id^=delete-item]').click(function() {
      var id = $(this).data('id');  
      var image = $('#image').val();
      $.ajax({
          url: "?controller=productcontroller&action=delete",
          type: "POST",
          data: {
            id: id,
            image: image
          }
        })
        .done(function(result) {
          if(result.flag == true){
           $(`#delete-item${result.id}`).closest('tr').remove();
          }
        })
        .fail(function() {

        });

    });
</script>