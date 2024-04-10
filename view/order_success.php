<!-- done -->
<title>Đặt hàng thành công</title>
<main style="background-color: #e6e8ea; padding: 30px 0;" class="container-fluid">
    <div class="text-center">
        <h3 style="color: #1097cf; font-weight: 600; font-size: 30px;">METRIC</h3>
    </div>
    <div class="text-center">
        <i style="font-size: 24px; color: #1097cf;" class="fas fa-cart-plus"></i>&nbsp;&nbsp;&nbsp;
        <span style="font-size: 24px; font-weight: 600;">ĐẶT HÀNG THÀNH CÔNG</span>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div id="info_customer_order_success" class="row">
                    <div class="col-md-6 mb-3">
                        <h4>Thông tin khách hàng</h4>
                        <p><?php if(isset($_POST['full_name'])) echo $_POST['full_name'];?></p>
                        <p><?php if(isset($_POST['email'])) echo $_POST['email'];?></p>
                        <p><?php if(isset($_POST['phone_number'])) echo $_POST['phone_number'];?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4>Địa chỉ nhận hàng</h4>
                        <p><?php if(isset($_POST['address'])) echo $_POST['address'];?></p>
                        <p>Ghi chú: <?php if(isset($_POST['note'])) echo $_POST['note'];?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4>Phương thức thanh toán</h4>
                        <p><?php if(isset($_POST['payment'])) echo $_POST['payment'];?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4>Phương thức vận chuyển</h4>
                        <p>Giao hàng tận nơi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Mã đơn hàng: #<?php echo $order->getOrderId();?>
                    </div>
                    <div id="card_body_order_success" class="card-body">

                    <?php 
                                $total=0;
                                if(isset($product_in_orders)){
                                    foreach($product_in_orders as $i => $value){
                                        $total+=($value['price']*$value['amounts']);  
                            ?>
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <img src="../admin/img/products/<?= $value['img'] ?>" alt="" style="width:89px">
                                                <span><?php echo $value['product_name'];?></span>
                                            </div>
                                            <div class="col-3 d-flex align-items-center">
                                                <p><?php echo $value['amounts'];?></p>
                                            </div>
                                            <div class="col-3 d-flex align-items-center">
                                                <p><?php echo number_format($value['price'],0,'','.')."VND";?></p>
                                            </div>
                                        </div>
                                        <hr style="color: #1097cf;">
                            <?php }}?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Tạm tính: </p>
                            <p><?php if(isset($total)){ echo number_format($total,0,'','.')."đ";} ?></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Phí vận chuyển</p>
                            <p>30.000đ</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>Tổng đơn: </p>
                            <p><?php echo number_format($total+30000,0,'','.')."đ";?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center">
        <a href="?action=delete_cart" class="d-block"><button class="btn btn-primary">Tiếp tục mua hàng</button></a>
    </div>
</main>
