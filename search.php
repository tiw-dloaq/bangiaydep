<?php
session_start();
include('admin/config/dbcon.php');
include('includes/header.php');
include('includes/slider.php');


// Xử lý từ khóa tìm kiếm
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Truy vấn CSDL
    $sql = "SELECT * FROM product WHERE productName LIKE '%$searchQuery%'";
    $result = $con->query($sql);

} else {

    header("Location: index.php");
    exit();
}


?>


<body>
    <div class="container">
        <h1 class="mt-4">Kết quả tìm kiếm cho "<?php echo $searchQuery; ?>"</h1>

        <div class="row mt-4">
            <?php
            if ($result->num_rows > 0) {
                while ($item = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-3 mb-2">
                        <a href="product-view.php?productid=<?= $item['id'] ?>">
                            <div class="card shadow category-card">
                                <div class="card-body">
                                    <img src="uploads/<?= $item['image'] ?>" alt="" class="w-100" style='height: 160px;'>
                                    <h4><?= $item['productName']; ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<p class='mt-4'>Không tìm thấy sản phẩm nào.</p>";
            }
            ?>
        </div>
    </div>

    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>


<?php include('includes/footer.php'); ?>

