<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\User;
    use CT271\NLCS\Order;
    $order = new Order($PDO);
    if(isset($_GET['status'])){
        $List_orders = $order->find_orders_status($_GET['status']);
    }
    else{
        $List_orders = $order->all();
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
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
                            <a href="home_admin.php" class="nav-link align-middle px-0">
                                <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline">Trang chủ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-box"></i> <span class="ms-1 d-none d-sm-inline">Đơn hàng</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
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
                <h2>Đơn hàng</h2>
                <div class="container">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Mã</th>
                            <th scope="col">Người nhận</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Tổng đơn</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider table-divider-color">
                    <?php if(isset($List_orders)){
                                    foreach($List_orders as $id => $order){?>
                        <tr>
                            <th scope="row"><?php echo $order->getOrderId()?></th>
                            <td><?php echo $order->full_name?> <span><?php echo $order->phone_number?></span></td>
                            <td><?php echo $order->address?></td>
                            <td><?php echo number_format($order->total_price,0,'','.')."VND";?></td>
                            <td><?php echo $order->payment?></td>
                            <td><?php echo date('Y-m-d', strtotime($order->created_at))?></td>
                            <td><?php echo $order->status?></td>
                            <td><a href="detail_order_admin.php?order_id=<?php echo $order->getOrderId()?>" target="_blank">Xem</a></td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>