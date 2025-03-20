<?php
session_start();
include('function/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white ">
            <a class="text-white" href="index.php">
                Home /
</a>
            <a class="text-white" href="cart.php">
            Giỏ hàng
</a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div id="message"></div>
            <div class="row">
                <div class="col-md-12">
                    <div id="mycart">
                    <?php
                    $items = getCartItems();
                    if (mysqli_num_rows($items) > 0) {
                        ?>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <h5>Hình ảnh</h5>
                            </div>
                            <div class="col-md-3">
                                <h5>Tên Sản phẩm</h5>
                            </div>
                            <div class="col-md-2">
                                <h5>Giá (VNĐ)</h5>
                            </div>
                            <div class="col-md-2">
                                <h5>Số lượng</h5>
                            </div>
                            <div class="col-md-1">
                                <h5>Size</h5>
                            </div>
                            <div class="col-md-2">
                                <h5>Tác vụ</h5>
                            </div>
                        </div>
                        <div id="">
                            <?php
                            foreach ($items as $citem) {
                                ?>
                                <div class="card product_data shadow mb-2">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-2 ">
                                            <img class="mb-3 " style="margin-left: 1rem" src="uploads/<?= $citem['image'] ?>"
                                                alt="image" width="60px" height="60px">
                                        </div>
                                        <div class="col-md-3">
                                            <h5>
                                                <?= $citem['productName'] ?>
                                            </h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>
                                               <?= number_format($citem['price'], 0, ',', '.') ?>
                                            </h5>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="hidden" class="prodId" value="<?= $citem['product_id'] ?>">
                                            <div class="input-group mb-3 " style="width:130px">
                                                <button class="input-group-text update_qty tru_btn">-</button>
                                                <input type="text" class="form-control text-center input-qty bg-white"
                                                    value="<?= $citem['prod_qty'] ?>" disabled>
                                                <button class="input-group-text update_qty cong_btn">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <h5><?= isset($citem['size']) ? $citem['size'] : 'Chưa chọn' ?></h5>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger mb-3 deleteItem" value="<?= $citem['cart_id'] ?>">
                                                Xóa</button>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                    ?>
                    </div>
                    <div class="float-start">
                        <a href="category.php" class="btn btn-outline-danger mt-3" style=" padding: 6px 40px; ">Tiếp tục
                            mua hàng</a>
                    </div>
                    <div class="float-end">
                        <a href="checkout.php" class="btn btn-outline-primary mt-3" style=" padding: 6px 40px; ">Thanh
                            Toán</a>
                    </div>
                    <?php
                    }else{
                        ?>
                        <div class="card card-body text-center shadow" >
                            <h4 class="py-3">Giỏ hàng trống!</h4>
                        </div>
                        <?php
                    }  
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
