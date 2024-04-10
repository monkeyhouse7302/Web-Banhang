<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\Product;
    $product = new Product($PDO);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product = new Product($PDO);
        $product->fill($_POST);
        if ($product->validate()) {
            $product->saveProducts();
            echo "<script>alert('Thêm sản phẩm thành công!'); window.location='product_admin.php';</script>";
            exit();
        }
        $errors = $product->getValidationErrors();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
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
                <h2>Thêm sản phẩm</h2>
                <div class="container">
                    <form action="" method="post">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-outline">
                                    <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Nhập tên sản phẩm"/>
                                    <label class="form-label" for="product_name">Tên sản phẩm</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline">
                                    <input type="number" id="price" name="price" class="form-control" placeholder="Nhập giá sản phẩm"/>
                                    <label class="form-label" for="price">Giá tiền</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-outline">
                                    <label class="form-label" for="brand">Thương hiệu</label>
                                    <select class="form-select" name="brand" id="brand">
                                        <option selected>-- Chọn --</option>
                                        <option value="Nike">Nike</option>
                                        <option value="Adidas">Adidas</option>
                                        <option value="Puma">Puma</option>
                                        <option value="Converse">Converse</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline">
                                    <label class="form-label" for="category_id">Loại</label>
                                        <select class="form-select" name="category_id" id="category_id">
                                            <option selected>-- Chọn --</option>
                                            <option value="Nike">Nam</option>
                                            <option value="Adidas">Nữ</option>
                                            <option value="Puma">Phụ kiên</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                        <div>
                            <img src="" alt="" id="selectedImage" class="mb-4" style="width: 200px">
                        </div>
                            <label for="fileInput" class="form-label">Chọn hình ảnh</label>
                            <input class="form-control" type="file" id="fileInput" name="Image" accept="image/png, image/jpeg" require>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-4">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../admin/js/main.js"></script>
</body>
</html>