<?php
 session_start();

include('function/userfunctions.php');
include('includes/header.php');



if (isset($_GET['category'])) {
    $category_id = $_GET['category'];

    // echo $category_id;
// $product_get_cid = getID('product',$category_id);
// $product_get_cid_run = mysqli_fetch_array($product_get_cid);
//lấy tên cho thằng dưới
    $category_name = getID('category', $category_id);
    $category_name_run = mysqli_fetch_array($category_name);


    if ($category_name_run) {
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
                    <?= $category_name_run['name'] ?>



                </h6>
            </div>
        </div>

        <div class="py-5">
            <div class="container">
                <div class="col-md-12">
                    <h1>
                        <?= $category_name_run['name'] ?>
                    </h1>
                    <hr>
                    <div class="row">


                        <?php
                        $product = getProductbyCid('product', $category_id);
                        if (mysqli_num_rows($product) > 0) {
                            foreach ($product as $item) {

                                ?>
                                <div class="col-md-3 mb-2">
                                    <a href="product-view.php?productid=<?= $item['id'] ?>">

                                        <div class="card shadow category-card">
                                            <div class="card-body">

                                                <img src="uploads/<?= $item['image'] ?>" alt="" class="w-100" style='height: 160px;'>
                                                <h4>
                                                    <?= $item['productName']; ?>

                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <?php

                            }
                        } else {
                            ?>
                            <div class=" text-center " style=" height: 100vh;">
                                <h4 class=" text-info fs-2 fw-bold">Danh mục không có sản phẩm!</h4>
                            </div>
                            <?php
                            // echo "Danh mục không có sản phẩm";
                        }

                        ?>


                    </div>
                </div>
            </div>

        </div>




        <?php

    } else {
        echo "Đừng có phá dùm";
    }
} else {
    echo "Danh mục không có id đó đừng có cố chấp!";
}

include('includes/footer.php'); ?>