<?php
session_start();
include('function/userfunctions.php');
include('includes/header.php');
 ?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white ">
            <a class="text-white" href="index.php">
                Home /
            </a>
             Danh Mục
        </h6>
    </div>
</div>


<div class="py-5">
    <div class="container">
        <div class="col-md-12">
            <h1>Danh mục</h1>
            <hr>
            <div class="row">


                <?php
                $category = getAll('category');
                if (mysqli_num_rows($category) > 1) {
                    foreach ($category as $item) {
                        ?>
                        <div class="col-md-3 mb-2">
                            <a href="product.php?category=<?= $item['id'] ?>">
                                <div class="card shadow category-card">
                                    <div class="card-body">
                                        <!-- <input type="hidden" name="<?= $item['id'] ?>"> -->
                                        <img src="uploads/<?= $item['image'] ?>" alt="" class="w-100" style='height: 160px;'>
                                        <h4>
                                            <?= $item['name']; ?>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php
                    }
                }

                ?>


            </div>
        </div>
    </div>

</div>




<?php include('includes/footer.php'); ?>