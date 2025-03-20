<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Sản phẩm
                    <a href="add-product.php" class="btn btn-info float-end">Thêm sản phẩm</a>
                    </h4>
                </div>
                <div class="card-body" id="product_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <!-- <th>ID</th> -->
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá (VNĐ)</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Tùy chỉnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product = getAll("product");
                            if (mysqli_num_rows($product) > 0) {
                                foreach ($product as $item) {
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <?= $item['id'] ?>
                                        </td> -->
                                        <td>
                                            <?= $item['productName'] ?>
                                        </td>
                                  
                                        <td>
                                            <img src="../uploads/<?= $item['image'] ?>" width="50px" height="50px" alt="<?= $item['productName'] ?>">
                                            
                                        </td>
                                        <td>
                                        <?= number_format($item['price'], 0, ',', '.') ?> 
                                            <!-- <?= $item['price'] ?> -->
                                        </td>
                                        <td>
                                            <?= $item['quantity'] ?>
                                        </td>
                                        <td>
                                            <?= $item['trending'] == '1' ? "Nổi bật":"Không nổi bật" ?>
                                        </td>
                                        <td>
                                            <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-primary">Sửa</a>
                                            <input type="hidden" name = product_id value=<?= $item['id'] ?>>
                                            <button type="button" class="btn btn-danger delete_product_btn" value="<?= $item['id'] ?>">Xóa</button>
                                        </td>
                                
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "Không có danh mục";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>