<title>Yêu thích</title>
<main>
    <div class="container">
        <h4>Danh mục yêu thích</h4>
        <hr>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>Tên sản phẩm</th>
                <th>Giá tiền</th>
                <th>Xem chi tiết</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($List_products_like as $i => $product): ?>
                        <td>
                            <div class="d-flex align-items-center">
                            <img
                                src="../admin/img/products/<?= $product->Image ?>"
                                alt=""
                                style="width: 145px; height: 145px"
                                />
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?php echo $product->product_name ?></p>
                                <p class="text-muted mb-0"><?php echo $product->brand ?></p>
                            </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-bold"><?php echo number_format($product->price,0,",",".").'VND' ?></p>
                        </td>
                        <td><a href="?action=product_detail&product_id= <?php echo $product->getProductId() ?>"><p>Xem chi tiết</p></a></td>
                        <td>
                            <a href="?action=delete_like&product_id= <?php echo $product->getProductId() ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</main>