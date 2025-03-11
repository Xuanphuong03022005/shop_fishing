<!-- Offcanvas Menu -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="demoMenu" aria-labelledby="demoMenuLabel">
  <div class="offcanvas-header">
    <h5 id="demoMenuLabel">Xin chào <?php echo isset($_SESSION['info_users']['name']) ? $_SESSION['info_users']['name'] : " " ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body ">
    <ul class="list-unstyled d-grid gap-3">
      <a class="btn btn-success btn-sm  w-50 position-relative" href="?controller=OrderController&action=historyOrderAdmin">Quản lí đơn hàng
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          Yêu cầu
          <?php if (isset($_SESSION['request-confirmation'])) : ?>
            <?php $count = is_array($_SESSION['request-confirmation']) ? count($_SESSION['request-confirmation']) : 0; ?>
            <span class="count-request"><?php echo $count; ?></span>
            <?php else: ?>
              <span class="count-request">0</span> 
          <?php endif ?>
          <span class="visually-hidden">unread messages</span>
        </span>
      </a>
      <a class="btn btn-success btn-sm  w-50" href="?controller=EventController&action=showAddEvent">Thêm sự kiện</a>
      <a class="btn btn-success btn-sm  w-50" href="?controller=productcontroller&action=managerProduct">Quản lí sản phẩm</a>
      <a onclick="showgif()" href="?controller=productcontroller&action=getByProduct" class="btn btn-success btn-sm w-50">Thêm sản phẩm</a>
      <button type="button" class="btn btn-success btn-sm  w-50"
        <?php if (isset($_SESSION['info_users'])) : ?>
        data-bs-toggle="modal" data-bs-target="#userModal"
        <?php else : ?>
        data-bs-toggle="modal" data-bs-target="#exampleModal"
        <?php endif ?>>Thông tin người dùng</button>
      <a class="btn btn-danger btn-sm  w-50 rounded-pill" href="?controller=logincontroller&action=logOut">Đăng xuất</a>
    </ul>
  </div>
</div>