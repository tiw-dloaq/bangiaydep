<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
include('../function/statistical.php');

$countOrder = countOrder();
$countWait = countWait();
$countCan = countCanncel();
$countSucc = countSuccess();
$total = gettotal();
$totalWait = gettotalwait();
$totalCancel = gettotalCancel();
$totalSucc = gettotalSucc();
$countAcc = countAcc();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-7 position-relative z-index-2">
                    <div class="card card-plain mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        <h2 class="font-weight-bolder mb-0">Thống kê</h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 col-sm-5">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">weekend</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Tổng đơn hàng</p>
                                        <h4 class="mb-0">
                                            <?php echo $countOrder ?>
                                        </h4>
                                    </div>
                                </div>

                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <p class="mb-0"><span class="text-warning text-sm font-weight-bolder">
                                            <?php echo $countWait ?>
                                        </span>đơn chờ xử lý</p>
                                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                            <?php echo $countCan ?>
                                        </span>đơn đã hoàn thành!</p>
                                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                            <?php echo $countSucc ?>
                                        </span>đơn đã hủy</p>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2 bg-transparent">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">store</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize ">Money</p>
                                        <h4 class="mb-0 ">
                                            <?php $formattedTotal = number_format($total, 0, ',', '.');
                                            echo $formattedTotal ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="horizontal my-0 dark">
                                <div class="card-footer p-3">
                                    <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">
                                            <p class="mb-0"><span class="text-warning text-sm font-weight-bolder">
                                                    <?php $formattotalWait = number_format($totalWait, 0, ',', '.');
                                                    echo $formattotalWait ?>$
                                                </span>đơn chờ xử lý</p>
                                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                                    <?php $formattotalCancel = number_format($totalCancel, 0, ',', '.');
                                                    echo $formattotalCancel ?>$
                                                </span>đơn đã hoàn thành!</p>
                                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                                    <?php $formattotalSucc = number_format($totalSucc, 0, ',', '.');
                                                    echo $formattotalSucc ?>$
                                                </span>đơn đã hủy</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-sm-5 mt-sm-0 mt-4">

                            <div class="card mb-2">
                                <div class="card-header p-3 pt-2 bg-transparent">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">account_circle</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Tài khoản</p>
                                        <!-- Thêm thông tin tài khoản ở đây -->
                                        <h4 class="mb-0">
                                            <?php ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="horizontal my-0 dark">
                                <div class="card-footer p-3">
                                    <!-- Thêm thông tin tài khoản khác nếu cần -->
                                    <p class="mb-0 fs-5 fw-blod">Tổng số tài khoản KHÁCH HÀNG:
                                        <?php echo $countAcc; ?>
                                    </p>
                                    <!-- Các thông tin khác của tài khoản -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">

                </div>

            </div>
            <br>
        </div>
        <!-- index.php -->
        <!-- index.php -->
        <div class="container mt-5">
            <form method="post" action="javascript:void(0);" class="form-inline" id="chartForm">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="weekSelect" class="sr-only">Chọn tuần trong năm:</label>
                    <select name="week" id="weekSelect" class="form-control">
                        <?php
                        for ($i = 1; $i <= 52; $i++) {
                            echo "<option value='$i'>Tuần $i</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="button" class="btn btn-primary mb-2" onclick="submitChartForm()">Tra cứu</button>
            </form>

            <canvas id="chartweek" width="400" height="200"></canvas>
        </div>
        <hr class="dark horizontal my-0">
        <script>
            var chartData = [];
            var selectedWeek;

            function submitChartForm() {
                var weekSelect = document.getElementById('weekSelect').value;

                fetch('process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'week=' + encodeURIComponent(weekSelect),
                })
                    .then(response => response.json())
                    .then(data => {
                        chartData = data;
                        selectedWeek = weekSelect;
                        drawChart();
                    })
                    .catch(error => console.error('Lỗi:', error));
            }

            // JavaScript để vẽ biểu đồ khi trang được tải
            document.addEventListener("DOMContentLoaded", function () {
                drawChart();
            });

            // Hàm vẽ biểu đồ
            function drawChart() {
                var ctx = document.getElementById('chartweek').getContext('2d');

                // Kiểm tra xem chartData có giá trị không
                if (chartData.length > 0) {
                    var chartweek = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartData.map(item => item.day_of_week),
                            datasets: [{
                                label: `Bán được trong tuần: ${selectedWeek}`,
                                data: chartData.map(item => item.daily_sales),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    console.error("Không có dữ liệu để vẽ biểu đồ.");
                    alertify.alert('Thông báo', 'Không có dữ liệu để vẽ biểu đồ.');
                }
            }
        </script>



        <hr class="dark horizontal my-0">
        <h2>Biểu đồ sản phẩm bán</h2>
        <canvas id="myChart" width="400" height="200"></canvas>

        <script>
            var data = <?php echo json_encode(getProductSales()); ?>;

            var labels = data.map(item => item.product_name);
            var values = data.map(item => item.total_sold);

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Đã bán',
                        data: values,
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <?php
        include('includes/footer.php');
        ?>