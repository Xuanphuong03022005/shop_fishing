<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-3  text-info" id="userleModalLabel">Thông tin người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body d-grid">
                <div class="class mb-4">
                    <span class=" fs-5">Họ và tên:</span>
                    <span class=" fw-bold text-success fs-5"><?php echo $_SESSION['info_users']['name'] ?></span>
                </div>
                <div class="class mb-4">
                    <span class=" fs-5">Số điện thoại:</span>
                    <span class=" fw-bold text-success fs-5"><?php echo $_SESSION['info_users']['phone'] ?></span>
                </div>
                <div class="class mb-4">
                    <span class=" fs-5">Tên tài khoản:</span>
                    <span class=" fw-bold text-success fs-5"><?php echo  $_SESSION['info_users']['acc'] ?></span>
                </div>
                <div class="class mb-4">
                    <span class=" fs-5">Email: </span>
                    <span class=" fw-bold text-success fs-5"><?php echo  $_SESSION['info_users']['email'] ?></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>