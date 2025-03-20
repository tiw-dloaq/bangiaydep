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
                    <h4 class="text-white fs-3">Tin nhắn trợ giúp
                        <!-- <a href="order-history1.php" class="btn btn-danger float-end mx-2">Đơn hàng đã hủy</a> -->
                        <!-- <a href="order-history.php" class="btn btn-info float-end">Đơn hàng đã hoàn thành</a> -->
                        <!-- Lịch sử đơn hàng -->

                    </h4>
                </div>
                <div class="card-body">
                    <table class="table  table-hover ">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $message = getAll('helpper');

                            if (mysqli_num_rows($message) > 0) {
                                foreach ($message as $item) {
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <?= $item[''] ?>
                                        </td> -->
                                        <td>
                                            <?= $item['name'] ?>
                                        </td>
                                        <td>
                                            <?= $item['email'] ?>
                                        </td>
                                        <td>
                                            <?= $item['phone'] ?>
                                        </td>
                                        <td>
                                            <?= date('H:i - d/m/Y', strtotime($item['created_at'])) ?>
                                        </td>
                                        <td>
                                            <?php if ($item['status'] == 0) { ?>
                                                <span class="badge bg-warning text-white">Chưa phản hồi</span>
                                            <?php } else if ($item['status'] == 1) { ?>
                                                    <span class="badge bg-success">Đã phản hồi</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="view-message.php?id=<?= $item['id'] ?>" class="btn btn-primary">Xem </a>
                                        </td>
                                    </tr>
                                    <?php
                                }

                            } else {
                                ?>
                                <tr>
                                    <td>
                                    <td colspan="5">Chưa có tin nhắn nào</td>
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