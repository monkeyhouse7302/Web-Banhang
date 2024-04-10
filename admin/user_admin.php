<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\User;
    use CT271\NLCS\Order;
    use CT271\NLCS\Product;
    $order = new Order($PDO);
    $user = new User($PDO);
    $List_user = $user->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../admin/css/styles_admin.css">
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
            <h2>Khách hàng</h2>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Username</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Số đơn</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider table-divider-color">
                        <?php if(isset($List_user)){
                                        foreach($List_user as $i => $user){?>
                            <tr>
                                <th scope="row"><?php echo $user->getUserId()?></th>
                                <td><?php echo $user->username?></td>
                                <td><?php echo $user->full_name?></td>
                                <td><?php echo $user->email?></td>
                                <td><?php echo $user->phone_number?></td>
                                <td><?php echo count($order->find_orders_user($user->email)) ?></td>
                                <td><?php echo $user->created_at?></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $i;?>"><i class="fa-solid fa-user-slash"></i></button> 
                                    <div class="modal fade" id="staticBackdrop<?php echo $i;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $i;?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel<?php echo $i;?>">Xóa - <?php echo $user->username;?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Xóa khách hàng <?php echo $user->username;?> ra khỏi hệ thống</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                            <button type="button" class="btn btn-danger"><a class="text-white " href="delete_user_admin.php?user_id=<?php echo $user->getUserId();?>">Đồng ý</a></button>
                                        </div>
                                        </div>
                                    </div>
                                </td>
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