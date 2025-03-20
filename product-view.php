<?php
session_start();
include('function/userfunctions.php');
include('includes/header.php');

if (isset($_GET['productid'])) {
    $product_id = $_GET['productid'];
    $product_data = getID('product', $product_id);
    $product = mysqli_fetch_array($product_data);
    if ($product) {
        ?>

        <div class="py-3 bg-primary">
            <div class="container">
                <h6 class="text-white">
                    <a class="text-white" href="index.php">
                        Home /
                    </a>
                    <a class="text-white" href="category.php">
                        Danh Mục /
                    </a>
                    <?= $product['productName'] ?>
                </h6>
            </div>
        </div>
        <div id="message" class="message"></div>
        <div class="py-4 bg-light">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image'] ?>" alt="" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8 ">
                        <h4 style="font-weight: bold; position: relative; ">
                            <?= $product['productName'] ?>
                            <span class=" col float-end text-danger"
                                style=" font-weight: normal; position: absolute; top: -10px; font-style: italic; font-size: 16px;">
                                <?php if ($product['trending'] == 1) {
                                    // echo "Nổi bật";
                                } ?>
                            </span>
                        </h4>
                        <h6 class=" text-danger mt-3" style="font-weight: bold; ">
                            <?= number_format($product['price'], 0, ',', '.') ?> VNĐ
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3 " style="width:130px">
                                    <button class="input-group-text tru_btn">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <button class="input-group-text cong_btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select size-selection">
                                    <option value="">Chọn size</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <button class="btn btn-primary px-4 AddtoCartbtn" value="<?= $product['id'] ?>"> <i
                                        class="fa fa-shopping-cart me-2"> Thêm giỏ
                                        hàng</i></button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4 AddtoWishlist" value="<?= $product['id'] ?>"> <i
                                        class="fa fa-heart me-2"> Sản phẩm yêu
                                        thích</i></button>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h4 class="fw-bold">Chi tiết sản phẩm</h4>
                            <h6 style="word-wrap: break-word; overflow-wrap: break-word;width: 60ch; ">
                                <?= $product['product_desc'] ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {
        ?>
        <div class="card card-body text-center shadow" style=" height: 100vh;">
            <h4 class="py-3 text-danger fs-1 fw-bold" >Sản phẩm không tồn tại!</h4>
        </div>
        <?php
    }
} else {
    echo "Bị lỗi rồi!";
}
include('includes/footer.php'); ?>
