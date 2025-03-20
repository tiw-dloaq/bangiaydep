<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Thêm sản phẩm
                    <a href="product.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i> Trở
                            về</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" class="form-control mb-2 " required name="name"
                                    placeholder="Nhập vào tên sản phẩm...">
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea required name="desc" class="form-control mb-2" placeholder="Leave a comment here"
                                        id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Mô tả sản phẩm</label>
                                </div>
                                <!-- <label for="">Mô tả</label>
                                <input type="text" class="form-control " name="desc" placeholder="Mô tả sản phẩm..."> -->
                            </div>
                            <div class="col-md-3">
                                <label for="">Danh mục</label>
                                <select class="form-select"  name= "catid">
                                    <option selected>Chọn danh mục</option>
                                    <?php
                                    $category = getAll("category");
                                    if (mysqli_num_rows($category) > 0) {
                                        foreach ($category as $item) {
                                            ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name'];?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "Danh mục trống";
                                    }
                                    ?>


                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Thương hiệu</label>
                                <select class="form-select "  name= "brandid">
                                    <option  selected>Chọn thương hiệu</option>
                                    <?php
                                    $brand = getAll("brand");
                                    if (mysqli_num_rows($brand) > 0) {
                                        foreach ($brand as $item) {
                                            ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name'];?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "Thương hiệu trống";
                                    }
                                    ?>
                                  
                                </select>
                            </div>


                            <div class="col-md-12">
                                <label for="">Hình ảnh</label>
                                <input type="file" class="form-control mb-2 " required name="image">
                            </div>
                            <div class="col-md-6">
                                <label for="">Giá (VNĐ)</label>
                                <input type="number" value="0" class="form-control mb-2" required name="price">
                            </div>
                            <div class="col-md-6">
                                <label for="">Số lượng</label>
                                <input type="number" value="0" class="form-control mb-2" required name="quantity">
                            </div>
                            <div class="col-md-3">
                                <label for="">Ưu tiên</label>
                                <input type="checkbox" id="uutienCheckbox" name="trending">
                            </div>
                            <!-- <div class="col-md-3">
                                <label for="">Không ưu tiên</label>
                                <input type="checkbox" id="khonguutienCheckbox" name="khonguutien">
                            </div> -->



                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product_btn"> Lưu</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    const uutienCheckbox = document.getElementById("uutienCheckbox");
    const khonguutienCheckbox = document.getElementById("khonguutienCheckbox");

    uutienCheckbox.addEventListener("change", function () {
        if (uutienCheckbox.checked) {
            khonguutienCheckbox.checked = false;
        }
    });

    khonguutienCheckbox.addEventListener("change", function () {
        if (khonguutienCheckbox.checked) {
            uutienCheckbox.checked = false;
        }
    });
</script> -->

<?php
include('includes/footer.php');
?>