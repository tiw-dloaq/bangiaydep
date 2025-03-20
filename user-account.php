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
                    <h4 class="text-white fs-3">
                        Tài khoản người dùng
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table  table-hover ">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $user = getAll('users');

                            if (mysqli_num_rows($user) > 0) {
                                foreach ($user as $item) {
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <?= $item['id_user'] ?>
                                        </td>  -->
                                        <td>
                                            <?= $item['name'] ?>
                                            <?php 
                                                if($item['type']== 1){ ?>
                                                
                                                 <span class=" ms-3 badge bg-light text-dark fw-bold">Admin</span> 
                                                    <?php
                                                }
                                                if($item['type']== 2){ ?>
                                                
                                                    <span class=" ms-3 badge bg-light text-dark">Nhân viên</span> 
                                                       <?php
                                                   }
                                            ?>
                                        </td>
                                        <td>
                                            <?= $item['phone'] ?>
                                        </td>
                                        <td>
                                            <?= $item['email'] ?>
                                        </td>
                                        <td>
                                            <?= date('H:i - d/m/Y', strtotime($item['created_at'])) ?>
                                        </td>
                                        <td>
                                            <?php if ($item['status'] == 0) { ?>
                                                <span class="badge bg-success text-white">Hoạt động</span>
                                            <?php } else if ($item['status'] == 1) { ?>
                                                    <span class="badge bg-warning">Bị khóa</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <form action="../function/authcode.php" method="POST">
                                                <input type="hidden" name="id_user" value="<?= $item['id_user'] ?>">
                                                <input type="hidden" name="name" value="<?= $item['name'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm " name="admin_disabled_account"
                                                    <?= $item['status'] == '0' ? '' : 'style="display:none;"' ?>>Khóa</button>
                                                <button type="submit" class="btn btn-primary btn-sm " name="admin_enabled_account"
                                                    <?= $item['status'] == '1' ? '' : 'style="display:none;"' ?>>Mở</button>
                                                <button type="submit" class="btn btn-light btn-sm" name="remove-nhanvien"
                                                <?=  $item['type'] == '2' ? '' : 'style="display:none;"' ?>>Thu Hồi</button>
                                                <button type="submit" class="btn btn-light btn-sm" name="add-nhanvien"
                                                <?=  $item['type'] == '0' ? '' : 'style="display:none;"' ?>>Nhân viên</button>

                                                <!-- <button type="submit" class="btn btn-danger"
                                                    name="admin_disabled_account">Khóa</button>
                                                <button type="submit" class="btn btn-primary"
                                                    name="admin_disabled_account">Mở</button> -->
                                            </form>
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