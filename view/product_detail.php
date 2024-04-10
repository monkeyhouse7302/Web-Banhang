<title>Sản phẩm - <?php echo $product_details->product_name?></title>
<div id="breadcrumb_background">
    <h2 id="title_breadcrumb" class="text-center">CHI TIẾT SẢN PHẨM</h2>
</div>
<main class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-3">
            <img src="../admin/img/products/<?= $product_details->Image ?>" alt="" class="product">
        </div>
        <div id="contain_detail_product" class="col-md-6 mb-3">
            <h2 id="name_of_detail_product"><?php echo $product_details->product_name?></h2>
            <p id="brand_of_detail_product"><?php echo $product_details->brand?></p>
            <hr>
            <h3 id="price_of_detail_product" class=""><span><?php echo number_format($product_details->price,0,",",".").'VND' ?></span></h3>
                <?php if($product_details->category_id == 1): ?>
                    <p>Giày nam</p>
                <?php elseif ($product_details->category_id == 2): ?>
                    <p>Giày nữ</p>
                <?php else: ?>
                    <p>Phụ kiện</p>
                <?php endif; ?>
            <form id="form_add" method="post" class="row mt-5" action="?action=add">
                <div class="col-3">
                    <label for="amount_product_detail_product" style="color: #1097cf; font-size: 16px; font-weight: 600;" >Số lượng</label>
                </div>    
                <div class="col-9 mb-3">
                    <input type="number" id="amount_product_detail_product" class="col-7 mx-sm-3" min="1" name="amounts" value="1">
                </div>
                <input type="hidden" name="product_id" value="<?php echo $product_details->getProductId();?>">
                <button type="submit" id="btn_add_into" name="btn_add_into_cart" class="btn btn-outline-primary rounded mb-3">Thêm vào giỏ hàng</button>
                <button type="submit" id="btn_add_into" name="btn_add_into_like" class="btn btn-outline-danger rounded mb-3">Yêu thích</button>
            </form>
            <hr>
            <div id="service_detail_product" class="row">
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_1.svg?1665539904835" alt="">
                    <span>Giao hàng toàn quốc</span>
                </div>
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_2.svg?1665539904835" alt="">
                    <span>Thanh toán nhiều hình thức</span>
                </div>
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_3.svg?1665539904835" alt="">
                    <span>Cam kết đổi trả hàng miễn phí</span>
                </div>
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_4.svg?1665539904835" alt="">
                    <span>Hàng chính hãng/Bảo hành 1 năm</span>
                </div>
            </div>
        </div>
    </div>
</main>
