<?php
 session_start();
include('function/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

// include('function/handlecart.php') ?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white ">
            <a class="text-white" href="index.php">
                Home /
            </a> 
            <a class="text-white" href="my-orders.php">
                Đơn Hàng
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
                    <table class="table  table-hover ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Giá</th>
                                <th>Ngày đặt</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $orders = getOrders();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $item['id'] ?>
                                        </td>
                                        <td>
                                            <?= $item['tracking_no'] ?>
                                        </td>
                                        <td>
                                        <?= number_format($item['total_price'], 0, ',', '.') ?> VNĐ
                                            <!-- <?= $item['total_price'] ?> -->
                                        </td>
                                        <td>
                                            <?= date('H:i - d/m/Y', strtotime($item['created_at'])) ?>
                                        </td>
                                        <td>
                                            <a href="view-order.php?t=<?= $item['tracking_no'] ?>" class="btn btn-primary">Xem
                                                chi tiết</a>
                                        </td>
                                    </tr>
                                    <?php
                                }

                            } else {
                                ?>
                                <tr>
                                    <td>
                                    <td colspan="5">Bạn chưa mua sản phẩm nào</td>
                                    </td>
                                </tr>
                                <?php

                            }

                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>