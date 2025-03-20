<?php
  session_start();
include('function/userfunctions.php');
include('includes/header.php');

include('authenticate.php');



// include('function/handlecart.php') ?>


<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body">


                <div class="row">
                    <div id="message"></div>
                    <div class="col-md-5">
                        <h5>Thông tin tài khoản</h5>
                        <hr>
                        <div class="row">

                            <?php
                            $user_id = $_SESSION['auth_user']['user_id'];
                            $user_data = getByUID('users', $user_id);
                            if (mysqli_num_rows($user_data) > 0) {
                                foreach ($user_data as $item) {
                                    ?>
                                    <form action="function/authcode.php" method="POST">

                                        <div class="col-md-12">
                                            <label class="fw-bold">Tên </label>

                                            <input type="text" required name="name" value="<?= $item['name'] ?> "
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Email </label>
                                            <div class="border p-1">
                                                <?= $item['email'] ?>
                                            </div>
                                            <input type="hidden" value="<?= $item['email'] ?> " name="email">
                                            <!-- <input type="text" required name="email" value="<?= $item['email'] ?> "
                                                class="form-control"> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Số điện thoại </label>
                                            <input type="text" required name="phone" pattern="0[0-9]{9}"
                                                value="<?= trim($item['phone']) ?>" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Ngày tạo tài khoản</label>
                                            <div class="border p-1">
                                                <?= date('H:i - d/m/Y', strtotime($item['created_at'])) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="fw-bold">Trạng thái : </label>
                                            <?php if ($item['status'] == 0) { ?>
                                                <span class="badge bg-success text-white">Đang hoạt động</span>
                                            <?php } else if ($item['status'] == 1) { ?>
                                                    <span class="badge bg-success"> Khóa tài khoản</span>
                                            <?php } ?>

                                        </div>
                                        <div class="mt-3 row">

                                            <div class="col-md-5">
                                                <button type="button" class="btn btn-outline-danger w-100 fw-bold"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Khóa tài khoản
                                                </button>



                                            </div>

                                            <div class="col-md-4">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#openModal"
                                                    class="btn btn-outline-success w-100 fw-bold">Đổi mật khẩu</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" name="update_account"
                                                    class="btn btn-outline-info w-100 fw-bold">Cập nhật</button>
                                            </div>
                                    </form>
                                </div>

                                <!-- Modal Khóa tài khoản -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Bạn có chắc
                                                    muốn khóa không?
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Nếu khóa tài khoản. Bạn muốn mở thì hãy liên hệ với quản trị viên.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Thoát</button>
                                                <form action="function/authcode.php" method="POST">
                                                    <input type="hidden" name="id_user" value=" <?= $item['id_user'] ?>">
                                                    <button type="submit" name="disabled_account" value="1"
                                                        class="btn btn-outline-danger w-100 fw-bold">Khóa tài
                                                        khoản</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Update mật khẩu -->
                                <div class="modal fade" id="openModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thay đổi mật khẩu
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="function/authcode.php" method="POST">
                                                <div class="modal-body">
                                                <div id="message" class="message"></div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="email" value="<?= $item['email'] ?>">
                                                        <label for="password" class="fw-bold">Mật khẩu cũ</label>
                                                        <input type="password" required name="old_password"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="fw-bold">Mật khẩu mới</label>
                                                        <input type="password" required name="new_password"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="fw-bold">Nhập lại khẩu mới</label>
                                                        <input type="password" required name="comfirm_password"
                                                            class="form-control">
                                                    </div>
                                                    <div id="message_pass"></div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Thoát</button>

                                                    <button type="submit" name="update_password" class="btn btn-primary">Lưu
                                                        lại</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
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