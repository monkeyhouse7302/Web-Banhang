<title>Giỏ hàng</title>
<main>
    <div class="container">
        <h4>Giỏ hàng của bạn</h4>
        <hr>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th class="text-center">Giá tiền</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $total=0;
                if(isset($product_in_cart)){
                    foreach($product_in_cart as $i => $value){
                        $total+=($value['price']*$value['amounts']);
            ?>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="d-flex align-items-center">
                        <img
                            src="../admin/img/products/<?= $value['img'] ?>"
                            alt=""
                            style="width: 145px; height: 145px"
                            />
                        <div class="ms-3">
                            <p class="fw-bold mb-1"><?php echo $value['product_name'] ?></p>
                            <p class="text-muted mb-0"><?php echo $value['brand'] ?></p>
                        </div>
                        </div>
                    </td>
                    <td>
                        <div id="btn_change_amounts_cart" class="">
                            <a href="?action=change_amounts&type=decrease&id_product_cart=<?php echo $i;?>&amounts=<?php echo $value['amounts'];?>">-</a>
                                <?php echo $value['amounts'] ?>
                            <a href="?action=change_amounts&type=increase&id_product_cart=<?php echo $i;?>&amounts=<?php echo $value['amounts'];?>">+</a>
                        </div>
                    </td>
                    <td class="text-center">
                        <p class="fw-bold"><?php echo number_format($value['price'],0,",",".").'VND' ?></p>
                    </td>
                    <td class="text-center">
                        <a href="../controller/index.php?action=delete_product_cart&id_product_cart=<?php echo $i;?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php }};?> 
            </tbody>
            <tfoot class="bg-light">
                <tr>
                    <td colspan="4" class="text-end"><h4>Tổng đơn hàng</h4></td>
                    <td style="width:100px"><h4><?php echo number_format($total,0,",",".").'VND' ?></h4></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end text-muted">Phí ship và thuê đã được tính</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end text-muted">
                        <button type="button" class="btn btn-light"><a href="../controller/index.php?action=products">Tiếp tục mua hàng</a></button>
                        <button type="button" class="btn btn-primary"><a href="../controller/index.php?action=order" class="text-white">Đặt hàng</a></button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</main>