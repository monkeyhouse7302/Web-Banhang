<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\User;
    use CT271\NLCS\Product;
    $product = new Product($PDO);

    if(isset($_GET['category_id'])){
        $List_products = $product->find_all_category($_GET['category_id']);
    }
    else{
        $List_products = $product->all();
    }
    if(isset($_GET['txtSearch'])){
        $List_products = $product->search($_GET['txtSearch']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm <?php if(isset($_GET['category_id'])){
        if($_GET['category_id'] == 1){
            echo '- Nam';
        }elseif($_GET['category_id'] == 2){
            echo '- Nữ';
        }else{
            echo '- Phụ kiện';
        }
    } ?></title>
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
                            <ul class="collapse show nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
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
                <h2>Sản phẩm <?php if(isset($_GET['category_id'])){
        if($_GET['category_id'] == 1){
            echo '- Nam';
        }elseif($_GET['category_id'] == 2){
            echo '- Nữ';
        }else{
            echo '- Phụ kiện';
        }
    } ?></h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="add_product.php"><button class="btn btn-primary">Thêm sản phẩm</button></a>
                        </div>
                        <div class="col-md-4">
                        <form method="GET" action="">
                            <div class="search">
                                <button class="btn" id="search_btn_header" type="submit"><i class="fa fa-search"></i></button>
                                <input type="text" class="form-control " placeholder="Tìm sản phẩm... " name="txtSearch">
                            </div>
                        </form>
                        </div>
                    </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mã</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Hiệu</th>
                            <th scope="col">Loại</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider table-divider-color">
                    <?php if(isset($List_products)){
                                    foreach($List_products as $i => $product){?>
                        <tr>
                            <th scope="row"><?php echo $product->getProductId()?></th>
                            <td><img src="../admin/img/products/<?php echo $product->Image ?>"  style="width: 80px; height: 80px"/></td>
                            <td><?php echo $product->product_name?></td>
                            <td><?php echo $product->brand?></td>
                            <td>
                                <?php if($product->category_id == 1){echo 'Nam';}
                                      elseif($product->category_id == 2) {echo 'Nữ';}
                                      elseif($product->category_id == 0) {echo 'Phụ kiện';};
                                ?>
                            </td>
                            <td><?php echo number_format($product->price,0,'','.')."VND";?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $i;?>">Xem</button> 
                                <div class="modal fade" id="staticBackdrop<?php echo $i;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $i;?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel<?php echo $i;?>">Sản phẩm - <?php echo $product->product_name?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3 text-center">
                                                    <img src="../admin/img/products/<?= $product->Image ?>" alt="" class="product" style="width: 100%">
                                                </div>
                                                <div id="contain_detail_product" class="col-md-6 mb-3">
                                                    <h2 id="name_of_detail_product"><?php echo $product->product_name?></h2>
                                                    <p id="brand_of_detail_product"><?php echo $product->brand?></p>
                                                    <hr>
                                                    <h3 id="price_of_detail_product" class=""><span><?php echo number_format($product->price,0,",",".").'VND' ?></span></h3>
                                                        <?php if($product->category_id == 1): ?>
                                                            <p>Giày nam</p>
                                                        <?php elseif ($product->category_id == 2): ?>
                                                            <p>Giày nữ</p>
                                                        <?php else: ?>
                                                            <p>Phụ kiện</p>
                                                        <?php endif; ?>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="edit_product.php?product_id=<?php echo $product->getProductId()?>"><button class="btn btn-warning">Sửa</button></a>
                                            <a href="delete_product.php?product_id=<?php echo $product->getProductId()?>"><button class="btn btn-danger">Xóa</button></a>
                                        </div>
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