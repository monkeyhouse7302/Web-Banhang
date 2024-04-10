<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\Product;
    $product = new Product($PDO);
    if(isset($_GET['product_id'])){

        if($product->find($_GET['product_id']) !== null){
            $product->delete();
            echo "<script>alert('Xóa sản phẩm thành công!')</script>";
            echo "<script>window.location = 'product_admin.php'</script>";
        }
        else{
            echo "<script>alert('Xóa sản phẩm không thành công!')</script>";
        }
    }
    