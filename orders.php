<?php
// session_start();
include('includes/header.php');
include('../middleware/adminMiddleware.php');



// include('function/handlecart.php') ?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white fs-3">Đơn hàng
                        <a href="order-history1.php" class="btn btn-danger float-end mx-2">Đơn hàng đã hủy</a>
                        <a href="order-history.php" class="btn btn-info float-end">Đơn hàng đã hoàn thành</a>
                        <!-- Lịch sử đơn hàng -->

                    </h4>
                </div>
                <div class="card-body">
                    <table class="table  table-hover ">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Người dùng</th>
                                <th>Mã đơn hàng</th>
                                <th>Giá (VNĐ)</th>
                                <th>Ngày đặt</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $orders = getAllOrders();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <?= $item['id'] ?>
                                        </td> -->
                                        <td>
                                            <?= $item['name'] ?>
                                        </td>
                                        <td>
                                            <?= $item['tracking_no'] ?>
                                        </td>
                                        <td>
                                            <?= number_format($item['total_price'], 0, ',', '.') ?>
                                            <!-- <?= $item['total_price'] ?> -->
                                        </td>
                                        <td>
                                            <?= date('H:i - d/m/Y', strtotime($item['created_at'])) ?>
                                        </td>
                                        <td>
                                            <a href="view-orders.php?t=<?= $item['tracking_no'] ?>" class="btn btn-primary">Xem
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