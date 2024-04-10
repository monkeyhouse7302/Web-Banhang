<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['username_admin']=='metric' && $_POST['password_admin']=='admin'){
      echo "<script>alert('Đăng nhập admin thành công!')</script>";
      echo "<script>window.location = 'home_admin.php'</script>";
    }
    else{
      echo "<script>alert('Sai tài khoản hoặc mật khẩu!')</script>";
    }  
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../admin/css/styles_admin.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login Form</h2>
        <div class="text-center mb-5 text-dark">Admin</div>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" method="post" action="">
            <div class="text-center">
              <img src="../view/img/icon1.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="text" class="form-control" id="username_admin" name="username_admin" aria-describedby="emailHelp" placeholder="Username Admin">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password_admin" name="password_admin" placeholder="password Admin">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
          </form>
        </div>

      </div>
    </div>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>