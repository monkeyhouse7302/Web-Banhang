<?php
  use CT271\NLCS\User; 
  if (isset($_SESSION["userID"])) {
    $user_id = $_SESSION["userID"];
    $user = new User($PDO);
    $user->find($user_id);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="../view/css/styles.css">
</head>

<body>
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="d-flex flex-row top-header">
          <img src="../view/img/icon1.png" alt="" style="width: 35px; height: 35px;">
          <?php if (isset($_SESSION["userID"])): ?>
            <div class="col d-flex justify-content-end">
              <a class="top-header-nav" href="../controller/index.php?action=contact">Liên hệ</a>
              <div class="dropdown">
                <button class="btn" type="button" id="user_menu" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $user->username ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="user_menu">
                  <li><a class="dropdown-item" href="../controller/index.php?action=account"><?php echo $user->username ?></a></li>
                  <li><a class="dropdown-item" href="../controller/index.php?action=logout">Đăng xuất</a></li>
                </ul>
              </div>
            </div>
          <?php else: ?>
            <div class="col d-flex justify-content-end">
              <a class="top-header-nav" href="../controller/index.php?action=contact">Liên hệ</a>
              <a class="top-header-nav" href="../controller/index.php?action=login">Đăng nhập</a>
            </div>
          <?php endif; ?>
        </div>

        <div class="bottom-header">
          <div class="d-flex">
            <div class="col col-sm-4 col-lg-3">
              <img src="../view/img/favicon.jpg" alt="" srcset="" style="width:89px; height: 89px;">
            </div>

            <nav class="navbar navbar-expand-lg navbar-light col col-sm-4 col-lg-7">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-between" id="nav">
                <ul class="nav navbar-light ">
                  <li class="nav-item"><a class="nav-link" href="../controller/index.php?action=home">Trang chủ</a></li>
                  <li class="nav-item"><a class="nav-link" href="../controller/index.php?action=products" id="category_menu">Danh mục</a></li>
                  <li class="nav-item"><a class="nav-link" href="../controller/index.php?action=products&category_id=1" id="category_menu">Nam</a></li>
                  <li class="nav-item"><a class="nav-link" href="../controller/index.php?action=products&category_id=2" id="category_menu">Nữ</a></li> 
                  <li class="nav-item"><a class="nav-link" href="../controller/index.php?action=products&category_id=0" id="category_menu">Phụ kiện khác</a></li>   
                  <li class="nav-item"><a class="nav-link" href="../controller/index.php?action=about">Giới thiệu</a></li>
                </ul>
                <form id="form_search_product" method="GET" action="../controller/index.php?action=search">
                  <div class="search">
                    <input type="hidden" name="action" value="search">
                    <button class="btn" id="search_btn_header" type="submit"><i class="fa fa-search"></i></button>
                    <input type="text" class="form-control " placeholder="Tìm sản phẩm... " name="txtSearch" value="<?php if (isset($_GET["txtSearch"])){
                                echo $_GET["txtSearch"];
                            }?>">
                  </div>
                </form>
              </div>
            </nav>

            <div class="cart mt-3 d-flex justify-content-end col col-sm-2 col-lg-2">
              <a href="../controller/index.php?action=like"><img src="../view/img/heart.png" alt="" style="width: 40px; height: 40px;"></a>
              <a href="../controller/index.php?action=cart"><img src="../view/img/cart_icon.png" alt="" style="width: 40px; height: 40px;"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
