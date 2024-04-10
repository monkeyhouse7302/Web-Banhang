<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\User;
    use CT271\NLCS\Order;
    use CT271\NLCS\Product;
    $user = new User($PDO);
    $order = new Order($PDO);
    $product = new Product($PDO);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
                    <a href="home_admin.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Metric</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="../admin/home_admin.php" class="nav-link align-middle px-0">
                                <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline">Trang chủ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-box"></i> <span class="ms-1 d-none d-sm-inline">Đơn hàng</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="order_admin.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Tất cả</span> </a>
                                </li>
                                <li class="w-100">
                                    <a href="order_admin.php?status=Đang xử lý" class="nav-link px-0"> <span class="d-none d-sm-inline">Đang xử lý</span> </a>
                                </li>
                                <li>
                                    <a href="order_admin.php?status=Đã giao" class="nav-link px-0"> <span class="d-none d-sm-inline">Đã giao</span> </a>
                                </li>
                                <li class="w-100">
                                    <a href="order_admin.php?status=Đã hủy" class="nav-link px-0"> <span class="d-none d-sm-inline">Đã hủy</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="user_admin.php" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-users"></i> <span class="ms-1 d-none d-sm-inline">Khách hàng</span></a>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-grip"></i> <span class="ms-1 d-none d-sm-inline">Sản phẩm</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="product_admin.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Tất cả</span></a>
                                </li>
                                <li>
                                    <a href="product_admin.php?category_id=1" class="nav-link px-0"> <span class="d-none d-sm-inline">Nam</span></a>
                                </li>
                                <li>
                                    <a href="product_admin.php?category_id=2" class="nav-link px-0"> <span class="d-none d-sm-inline">Nữ</span></a>
                                </li>
                                <li>
                                    <a href="product_admin.php?category_id=0" class="nav-link px-0"> <span class="d-none d-sm-inline">Phụ kiện</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline mx-1">@admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="logout_admin.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <h2>Trang chủ</h2>
                <div class="container">
                    <div class="row">
                        <div class="card text-white m-3" style="max-width: 18rem; background-color: #cc4647 !important;">
                            <div class="card-header">Khách hàng</div>
                            <div class="card-body">
                                <h5 class="card-title"><i class=""></i><i class="fa-solid fa-users"></i> <span class="ms-1 d-none d-sm-inline">Khách hàng</span></h5>
                                <p class="card-text">Số lượng khách hàng: <?php echo count($user->all()) ?></p>
                                <a href="../admin/user_admin.php" class="btn btn-primary">Quản lý</a>
                            </div>
                        </div>

                        <div class="text-white m-3" style="max-width: 18rem; background-color: #06880e !important;">
                            <div class="card-header">Đơn hàng</div>
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-box"></i> <span class="ms-1 d-none d-sm-inline">Đơn hàng</span>: <?php echo count($order->all()) ?></h5>
                                <p class="card-text">Số lượng đơn hàng đang xử lý: <?php echo count($order->find_orders_status('Đang xử lý')) ?></p>
                                <a href="../admin/order_admin.php" class="btn btn-primary">Quản lý</a>
                            </div>
                        </div>

                        <div class="card text-white m-3" style="max-width: 18rem; background-color: #0a95dd;">
                            <div class="card-header">Sản phẩm</div>
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-grip"></i> <span class="ms-1 d-none d-sm-inline">Sản phẩm</span></h5>
                                <p class="card-text">Số lượng sản phẩm: <?php echo count($product->all()) ?></p>
                                <a href="../admin/product_admin.php" class="btn btn-primary ">Quản lý</a>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <h5>Thống kê</h5>
                            <div class="col-md-8">
                                <canvas id="order"></canvas>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Tổng đơn hàng</strong>: <?php echo count($order->all()) ?></p>
                                <p><strong>Tổng đơn hàng đã giao</strong>: <?php echo count($order->find_orders_status('Đã giao')) ?></p>
                                <p><strong>Doanh thu</strong>: <?php echo number_format($order->getIncome(),0,",",".").'VND' ?></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('order');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Đơn hàng', 'Đang xử lý', 'Đã giao', 'đã hủy'],
            datasets: [{
                label: 'Bản đơn hàng',
                data: [<?php echo count($order->all()) ?>, <?php echo count($order->find_orders_status('Đang xử lý')) ?>, <?php echo count($order->find_orders_status('Đã giao')) ?>, <?php echo count($order->find_orders_status('Đã hủy')) ?>],
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
</body>
</html>