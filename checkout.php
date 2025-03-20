<?php
 session_start();
include('function/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

$cartItems = getCartItems();
if (mysqli_num_rows($cartItems) == 0) {
    header('Location: index.php');
}


// include('function/handlecart.php') ?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white ">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <a class="text-white" href="cart.php">
                Thanh Toán
            </a>
        </h6>
    </div>
</div>



<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="function/placeorder.php" method="POST">
                    <div id="message"></div>
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Vận chuyển</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Họ và tên</label>
                                    <input type="text" name="name" id="name" required placeholder="Nhập tên..."
                                        class="form-control">
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-7 mb-3">
                                    <label class="fw-bold">Email</label>
                                    <input type="email" name="email" id="email" required placeholder="Nhập email..."
                                        class="form-control">
                                    <small class="text-danger email"></small>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="fw-bold">Số điện thoại</label>
                                    <input type="number" name="phone" id="phone" required placeholder="Nhập SĐT..."
                                        class="form-control">
                                    <small class="text-danger phone"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Địa chỉ</label>
                                    <textarea type="text" name="address" id="address" rows="6" required
                                        placeholder="Nhập địa chỉ..." class="form-control"></textarea>
                                    <small class="text-danger address"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Hình thức vận chuyển:</label>
                                    <select class="form-select" name="shipping" id="shippingSelect">
                                        <option selected>Chọn đơn vị vận chuyển </option>
                                        <?php
                                        $shipping = getAll("shipping_unit");
                                        if (mysqli_num_rows($shipping) > 0) {
                                            foreach ($shipping as $item) {
                                                // $selected = ($data['catid'] == $item['id']) ? 'selected' : '';
                                                ?>
                                                <option value="<?= $item['name_ship']; ?>">
                                                    <?= $item['name_ship']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            echo "Đơn vị vận chuyển trống";
                                        }
                                        ?>
                                    </select>
                                    <small class="text-danger shipping"></small>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Sản phẩm mua</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <label style="font-weight: bold;">Ảnh</label>
                                </div>
                                <div class="col-md-5">
                                    <label style="font-weight: bold;">Tên</label>
                                </div>
                                <div class="col-md-2">
                                    <label style="font-weight: bold;">SL</label>
                                </div>
                                <div class="col-md-3">
                                    <label style="font-weight: bold;">Giá</label>
                                </div>
                            </div>
                            <?php
                            $items = getCartItems();
                            $totalPrice = 0;
                            foreach ($items as $citem) {
                                ?>
                                <div class="card product_data shadow mb-2">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-2">
                                            <img class="mb-3 " src="uploads/<?= $citem['image'] ?>" alt="image" width="40px"
                                                height="50px" style="margin-left : 1rem;">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="">
                                                <?= $citem['productName'] ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">X
                                                <?= $citem['prod_qty'] ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">
                                                <?= number_format($citem['price'], 0, ',', '.') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <?php

                                $totalPrice += $citem['price'] * $citem['prod_qty'];

                            }
                            ?>
                            <!-- <input type="text" id="totalPriceInput" value="<?= $totalPrice; ?>" readonly hidden> -->
                            <div id="shippingInfo">
                                <h5 style="font-weight: bold;"> Vận chuyển: <span class="float-end"
                                        id="selectedShipping">Chưa chọn</span></h5>

                            </div>
                            <h5 style="font-weight: bold;"> Tổng giá: <span class="float-end">
                                    <?= number_format($totalPrice, 0, ',', '.') ?> VNĐ
                                </span>
                            </h5>
                            <div class="">
                                <input type="hidden" value="Thanh toán khi nhận hàng" name="payment_mode">
                                <button type="submit" name="placeOrderBtn"
                                    class="btn btn-outline-info w-100 fw-bold">Thanh toán khi nhận hàng</button>

                                <div id="paypal-button-container" class="mt-2"></div>


                            </div>


                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var shippingSelect = document.getElementById('shippingSelect');
        var selectedShippingSpan = document.getElementById('selectedShipping');

        shippingSelect.addEventListener('change', function () {
            var selectedOption = shippingSelect.options[shippingSelect.selectedIndex];

            // Kiểm tra nếu đã chọn một đơn vị vận chuyển hợp lệ
            if (selectedOption.value !== "") {
                selectedShippingSpan.textContent = selectedOption.text;
            }
        });
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>

<?php include('includes/footer.php'); ?>

<script
    src="https://www.paypal.com/sdk/js?client-id=AeQcASLASx-P3ezJMswPyTH4rp0Mlb-HIU1hCxxpz1Gp_t7Nw1MPvXUD8QbyodmHujg8obB8X72hnKbM&currency=USD"></script>

<script>

    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'blue',
            shape: 'rect',
            label: 'paypal',
            height: 40,
        },
        onClick() {
            // console.log("on click");
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            

            if (name.length == 0) {
                $('.name').text("Tên không được bỏ trống!");
            } else {
                $('.name').text("");
            }
            if (email.length == 0) {
                $('.email').text("Email không được bỏ trống!");
            } else {
                $('.email').text("");
            }
            if (phone.length == 0) {
                $('.phone').text("SĐT không được bỏ trống!");
            } else {
                $('.phone').text("");
            }
            if (address.length == 0) {
                $('.address').text("Địa chỉ không được bỏ trống!");
            } else {
                $('.address').text("");
            }

            if (name.length == 0 || email.length == 0 || phone.length == 0 || address.length == 0) {

                return false;
            }

        },

        createOrder: (data, actions) => {
            // console.log("create order");
            var totalPriceVND = <?= $totalPrice ?>;
            var exchangeRate = 24240; // Tỷ giá chuyển đổi
            var totalPriceUSD = (totalPriceVND / exchangeRate).toFixed(2);

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        // value: '<?= $totalPrice ?>'
                        value: totalPriceUSD
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function (orderData) {
                // console.log(orderData)

                // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                // alert('Transaction ${transaction.satus}:')

                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var shipping = $('#shippingSelect').val();

                var data = {
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'address': address,
                    'shipping':shipping,
                    'payment_mode': "Thanh toán bằng PayPal",
                    'payment_id': transaction.id,
                    'placeOrderBtn': true

                };
                console.log(data)

                $.ajax({
                    type: "POST",
                    url: "function/placeorder.php",
                    data: data,
                    success: function (response) {
                        if (response == 201) {
                            // $_SESSION['message'] = "Thành công! ";

                            // actions.redirect('my-orders.php');
                            window.location.href = 'my-orders.php';
                            alertify.success("Đặt hàng thành công thành công");
                        }

                    }
                });

            });
        }
    }).render('#paypal-button-container');

</script>