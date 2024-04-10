<?php
    session_start();
    require_once '../admin/bootstrap.php';
    use CT271\NLCS\Order;
    use CT271\NLCS\Product;
    $product = new Product($PDO);
    $order = new Order($PDO);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['btn_send'])){
            $status = 'Đã giao';
            $order->update_status_order($_GET['order_id'],$status);
        }
        else {
            $status = 'Đã hủy';
            $order->update_status_order($_GET['order_id'],$status);
        }
    }
    if(isset($_GET['order_id'])){
        $order_full = $order->find($_GET['order_id']);
        $order_detail = $order->find_orders_detail($_GET['order_id']);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <title>Chi tiết đơn hàng - #<?php echo $_GET['order_id']?></title>
    <div id="breadcrumb_background">
        <h2 id="title_breadcrumb" class="text-center mt-3">CHI TIẾT ĐƠN HÀNG</h2>
    </div>
    <main class="container">
        <div class="table-responsive-xl">
            <table class="table caption-top">
                <caption>Đơn hàng: #<?php if(isset($_GET['order_id'])){echo $_GET['order_id'];}?></caption>
                
                <div class="row">
                    <div class="col-md-6">
                        <p>Họ tên: <?php if(isset($order_full->full_name)){echo $order_full->full_name;}?></p>
                        <p>Email: <?php if(isset($order_full->email)){echo $order_full->email;}?></p>
                        <p>Số điện thoại: <?php if(isset($order_full->phone_number)){echo $order_full->phone_number;}?></p>
                    </div>
                    <div class="col-md-6">
                        <p>Địa chỉ giao hàng: <?php if(isset($order_full->address)){echo $order_full->address;}?></p>
                        <p>Ngày tạo: <?php if(isset($order_full->created_at)){echo $order_full->created_at;}?></p>
                        <p>Trạng thái: <?php if(isset($order_full->status)){echo $order_full->status;}?></p>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(isset($order_detail)){
                        foreach($order_detail as $id =>$order_detail){
                            $value = $product->find($order_detail->product_id)
                    ?>
                    <tr>
                        <th>
                                <img src="../admin/img/products/<?= $value->Image ?>" alt="" style="width:89px">
                                <span><?php echo $value->product_name;?></span>
                        </th>
                        <td><?php echo number_format($value->price,0,",",".")."đ";?></td>
                        <td><?php echo $order_detail->amounts;?></td>
                        <td><?php echo number_format($value->price*$order_detail->amounts,0,",",".")."VND";?></td>
                    </tr>
                    <?php
                    }}?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5" class="text-end">Tổng đơn hàng: <?php echo number_format($order_full->total_price,0,",",".")."VND";?></td>
                    </tr>
                    </tfoot>
            </table>
        </div>
        <?php if($order_full->status == 'Đang xử lý'){ ?>
            <form action="" method="post">
                <div class="text-end">
                    <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']?>">
                    <button type="submit" class="btn btn-success" name="btn_send">Xác nhận giao</button></a>
                    <button type="submit" class="btn btn-warning" name="btn_cancel">Hủy</button></a>  
                </div>
            </form>
        <?php } ?>
        
             
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>