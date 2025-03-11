<?php  if(isset($flag) && $flag == true )  : ?>
    
<!-- Modal -->
  
<div class="modal fade show " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block; margin-top: 100px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Thành công!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hãy tiếp tục thêm sự kiện
                </div>
                <div class="modal-footer">
                    <a href="?controller=EventController&action=showAddEvent">
                        <button type="button" class="btn btn-primary">Tiếp tục</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="container mt-5 " style="max-width: 450px;">
    <h2 class="text-center mb-4"><span class="text-success">Thêm sự kiện</span></h2>
    <form method="POST" action="?controller=EventController&action=addEvent" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Ảnh: </label>
            <input type="file" class="form-control"  name="image" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Sự kiện</label>
            <input type="text" class="form-control"  name="event" placeholder="Nhập tên hàng" required>
        </div>
            <div class="d-grid gap-2">
                <button onclick="showgif()"  type="submit" class="btn btn-info mt-4">Gửi</button>
                <a onclick="showgif()" href="?controller=homecontroller&action=index" type="submit" class="btn btn-danger mt-1">Quay lại</a>
            </div>
    </form>
</div>