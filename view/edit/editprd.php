<div class="container mt-5 " style="max-width: 450px;">
    <h2 class="text-center mb-4"><span class="text-success">Cập nhật đơn hàng</span></h2>
    <form method="POST" action="?controller=productcontroller&action=updateProduct" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id" class="form-label">id</label>
            <input type="text" class="form-control"  name="id" value="<?php echo $result['id'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Ảnh: </label>
            <input type="file" class="form-control" name="image" >
            <img src="public/images/<?php echo $result['image'] ?>" style="width: 60px; height: 60px; border-radius:10px">
            <input type="hidden" name="imageHidden" value="<?php echo $result['image'] ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Giá: </label>
            <input type="text" class="form-control"  name="price" value="<?php echo $result['price'] ?>" >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Name</label>
            <input type="text" class="form-control"  name="name" value="<?php echo $result['name'] ?>" >
        </div>

        <div class="mb-3">
            <label for="category">Xuất xứ:</label>
            <select id="category" name="category" class="form-control" style="width: 300px;">
                <?php foreach($categories as $key => $value) :?>
                <option value="<?php echo $value['id'] ?> " <?php if($value['id'] == $result['id_cate']) echo "selected"  ?> ><?php echo $value['cate_name'] ?></option>
                <?php endforeach;?>
            </select>

        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Phân loại: </label>
           <select id="factory" name="factory" class="form-control" style="width: 300px;">
                <?php foreach($factories as $key => $value) :?>
                        <option value="<?php echo $value['id'] ?>" <?php if($value['id'] == $result['id_fac']) echo "selected" ?>><?php echo $value['fac_name'] ?></option>
                        <?php endforeach;?>
           </select>

            <div class="d-grid gap-2">
                <button onclick="showgif()"  type="submit" class="btn btn-info mt-4">Gửi</button>
                <a onclick="showgif()" href="?controller=homecontroller&action=index" type="submit" class="btn btn-danger mt-1">Quay lại</a>
            </div>
    </form>
</div>