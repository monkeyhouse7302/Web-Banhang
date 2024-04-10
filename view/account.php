<title>Tài khoản - <?php echo $user->username;?></title> <!-- dùng php chèn title là tên full_name -->
<div id="breadcrumb_background">
    <p id="title_breadcrumb" class="text-center">THÔNG TIN TÀI KHOẢN</p>

</div>
<main class="container">
    <div class="row">
        <div id="nav_account_info" class="col-md-2">
            <a href="?action=edit_account" class="d-block mt-3">Đổi thông tin</a>
            <a href="?action=change_password" class="d-block mt-3">Đổi mật khẩu</a>
        </div>
        <div id="info_account_info" class="col-md-9 offset-md-1">
            <h2>Thông tin</h2>
            <div class="row mt-3">
                <div class="col-md-3">
                    Họ và tên <span style="color: red;">*</span>
                </div>
                <div class="col-md-9">
                    <?php echo $user->full_name;?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    Địa chỉ email <span style="color: red;">*</span>
                </div>
                <div class="col-md-9">
                    <?php echo $user->email;?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    Số điện thoại <span style="color: red;">*</span>
                </div>
                <div class="col-md-9">
                    <?php echo $user->phone_number;?>
                </div>
            </div>
        </div>            
    </div>
    <div class="row mt-3">
        <h3 class="text-center">Các đơn hàng đã đặt</h3>
        <div>
            <table class="table align-middle">
                <thead class="table-success">
                    <tr>
                        <th scope="col">Mã đơn - Xem</th>
                        <th scope="col">Tên người nhận</th>
                        <th scope="col">Địa chỉ nhận</th>
                        <th scope="col">Điện thoại</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tổng</th>
                        <th scope="col">Hình thức thanh toán</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($List_order_user)){
                            $count = count($List_order_user);
                            for($i = $count - 1; $i >= 0; $i--){
                                $value = $List_order_user[$i];
                    ?> 
                    <tr>
                        <td><a style="text-decoration: none;" href="?action=detail_order&order_id=<?php echo $value->getOrderId();?>">#<?php echo $value->getOrderId();?>-Xem</a></td>
                        <td> <?php echo $value->full_name;?> </td>
                        <td> <?php echo $value->address;?> </td>
                        <td> <?php echo $value->phone_number;?> </td>
                        <td> <?php echo $value-> email;?> </td>
                        <td> <?php echo number_format($value->total_price,0,",",".")."đ";?> </td>
                        <td> <?php echo $value->payment;?> </td>
                        <td> <?php echo $value->status;?> </td>
                        <td>
                            <?php if($value->status =='Đang xử lý'){ ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $i;?>">Hủy</button> 
                                <div class="modal fade" id="staticBackdrop<?php echo $i;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $i;?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel<?php echo $i;?>">Hủy đơn hàng - #<?php echo $value->getOrderId();?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Đơn hàng đang được xử lý bạn có chắc chắn hủy đơn hàng này không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="../controller/index.php?action=account&cancel_order&order_id=<?php echo $value->getOrderId();?>">Đồng ý</a></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>
        </div>    
    </div>
</main>
