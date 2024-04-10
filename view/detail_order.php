<title>Chi tiết đơn hàng - #<?php echo $_GET['order_id']?></title>
<div id="breadcrumb_background">
    <h3 id="title_breadcrumb" class="text-center">CHI TIẾT ĐƠN HÀNG</h3>
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
                    <p>Địa chỉ giao hàng: <?php if(isset($order_full->address)){echo $order_full->address;}?></p>
                </div>
                <div class="col-md-6">
                    <p>Ngày tạo: <?php if(isset($order_full->created_at)){echo date('d-m-Y', strtotime($order_full->created_at));}?></p>
                    <p>Thời gian giao dự kiến: <?php if(isset($order_full->created_at)){echo date('d-m-Y', strtotime($order_full->created_at . ' +5 days'));}?></p>
                    <p>Trạng thái: <?php if(isset($order_full->status)){echo $order_full->status;}?></p>
                    <p>Ghi chú: <?php if(isset($order_full->note)){echo $order_full->note;}?></p>
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
    <a href="../controller/index.php?action=account"><button id="btn_back_detail_order">Quay lại</button></a>       
</main>
