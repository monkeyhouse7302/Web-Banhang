<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\Product;
    $product = new Product($PDO);
    if(isset($_GET['product_id'])){
        $product = $product->find($_GET['product_id']);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(empty($_POST['Image'])){
            $_POST['Image']=$product->Image;
        }
        if ($product->update($_POST)) {
            echo "<script>alert('Cập nhật sản phẩm thành công!')</script>";
            echo "<script>window.location = 'product_admin.php?product_id=" . $product->getProductId() . "'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sữa - <?php echo $product->product_name ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <h2 class="text-center m-3">Thay đổi sản phẩm - <?php echo $product->product_name ?></h2>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:60%">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $product->product_name ?>"/>
                            <label class="form-label" for="product_name">Tên sản phẩm</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="number" id="price" name="price" class="form-control" value="<?php echo $product->price ?>"/>
                            <label class="form-label" for="price">Giá tiền</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="brand">Thương hiệu</label>
                            <select class="form-select" name="brand" id="brand">
                                <option value="Nike" <?php if($product->brand == 'Nike') echo 'selected' ?>>Nike</option>
                                <option value="Adidas" <?php if($product->brand == 'Adidas') echo 'selected' ?>>Adidas</option>
                                <option value="Puma" <?php if($product->brand == 'Puma') echo 'selected' ?>>Puma</option>
                                <option value="Converse" <?php if($product->brand == 'Converse') echo 'selected' ?>>Converse</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="category_id">Loại</label>
                                <select class="form-select" name="category_id" id="category_id">
                                    <option value="1" <?php if($product->category_id == '1') echo 'selected' ?>>Nam</option>
                                    <option value="2" <?php if($product->category_id == '1') echo 'selected' ?>>Nữ</option>
                                    <option value="0" <?php if($product->category_id == '1') echo 'selected' ?>>Phụ kiên</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div>
                        <img src="../admin/img/products/<?= $product->Image ?>" alt="" id="selectedImage" class="mb-4" style="width: 200px">
                    </div>
                    <label for="fileInput" class="form-label">Chọn hình ảnh</label>
                    <input class="form-control" type="file" id="fileInput" name="Image" accept="image/png, image/jpeg">
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Lưu</button>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../admin/js/main.js"></script>
</body>
</html>