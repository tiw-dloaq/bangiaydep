<?php

session_start();

if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
    header('Location: index.php');
    exit();
}

include('includes/header.php');
?>


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['message'])) {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey</strong>
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Lấy lại mật khẩu</h4>
                    </div>
                    <div class="card-body">



                        <form action="function/authcode.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập Email..."
                                    id="exampleInputPassword1">
                            </div>
                            <div>
                                <button type="submit" name="password-reset-link" class="btn btn-primary">Gửi Email</button>

                            </div>
                        </form>




                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>