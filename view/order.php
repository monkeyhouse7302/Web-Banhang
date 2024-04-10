<title>Đặt hàng</title>
<main>
    <div class="container">
        <form id="form_info_customer_cart" action="?action=agree_order" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullname_customer_cart" class="form-label">Họ và tên*</label>
                        <input type="text" name="full_name" class="form-control" id="fullname_customer_cart" value="<?php if(isset($_SESSION["userID"])){ echo $user->full_name;}?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_customer_cart" class="form-label">Địa chỉ email*</label>
                        <input type="email" name="email" class="form-control" id="email_customer_cart" aria-describedby="emailHelp" value="<?php if(isset($_SESSION["userID"])){ echo $user->email;}?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number_customer_cart" class="form-label">Số điện thoại nhận hàng*</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number_customer_cart" value="<?php if(isset($_SESSION["userID"])){ echo $user->phone_number;}?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address_customer_cart" class="form-label">Địa chỉ nhận hàng*</label>
                        <div class="input-group">
                            <input type="text" name="address" class="form-control" id="address_customer_cart" required>
                            <div class="input-group-text"><button id="getLocation"><i class="fa-solid fa-location-crosshairs"></i></button></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="note_customer_cart" class="form-label">Ghi chú</label>
                        <textarea class="form-control" name="note" id="note_customer_cart" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="payments_of_customer_cart" class="form-label">Hình thức thanh toán*</label>
                        <select id="payments_of_customer_cart" class="custom-select custom-select-md mb-3" name="payment" required>
                            <option value="Thanh toán tiền mặt khi nhận hàng (COD)" selected>Thanh toán khi nhận hàng (COD)</option>
                            <option value="Thanh toán chuyển khoản (Internet Banking)">Thanh toán chuyển khoản (Internet Banking)</option>
                        </select> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Sản phẩm
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
                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                        <input type="hidden" name="amounts" value="<?php echo $value['amounts'] ?>">
                            <?php }}?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <p>Tạm tính: </p>
                                <p><?php echo number_format($total,0,'','.')."VND"; ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <p>Phí vận chuyển</p>
                                <p>30.000đ</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p>Tổng đơn: </p>
                                <p><?php echo number_format($total+30000,0,'','.')."VND";?></p>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <input type="hidden" name="status" value="Đang xử lý">
                        <input type="hidden" name="total_price" value="<?php echo $total+30000;?>">
                        <button class="btn btn-warning mt-3"><a style="text-decoration: none;" href="?action=products">Tiếp tục mua hàng</a></button>
                        <button type="submit" class="btn btn-primary mt-3 text-end" id="btn_agree_order" name="btn_agree_order">Đồng ý đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>