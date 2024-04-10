<title>Sản phẩm</title>
<main>
    <div class="container-fluid">
        <form action="" method="POST">
            <div class="row">
                <h3>Sản phẩm | <?php if (isset($_GET['category_id'])){
                                if($_GET['category_id']== 1) echo 'Nam';
                                if($_GET['category_id']== 2) echo 'Nữ';
                                if($_GET['category_id']== 0) echo 'Phụ kiện khác';
                            }
                            elseif (isset($_GET["txtSearch"])){
                                echo 'Tìm Kiếm: '.$_GET["txtSearch"];
                            }
                            else{
                                echo 'Tất cả sản phẩm';
                            }?></h3>
            
                <div class="col-md-3">
                    <div class="container-fluid">
                        <div class="row">

                                <div class="card mt-3 " style="width: 100%;">
                                    <div class="card-header" >
                                        GIÁ TIỀN(VND)
                                    </div>
                                    <div class="price">
                                        <div class="input-group mt-3 mb-3">
                                            <input type="text" class="form-control" name="price_bot" id="price_bot" value="<?php if(isset($_POST['price_bot']) && $_POST['price_bot']!=0){echo $_POST['price_bot'];}else {echo '0';}?>" >
                                            <div class="align-self-center"> đến </div>
                                            <input type="text" class="form-control" name="price_top" id="price_top" value="<?php if(isset($_POST['price_top']) && $_POST['price_top']!=0){echo $_POST['price_top'];}else {echo '10,000,000';}?>">
                                        </div>                             
                                    </div>
                                </div>
                                <div class="card mt-3" style="width: 100%;">
                                    <div class="card-header">
                                        THƯƠNG HIỆU
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" name="brand[]" type="checkbox" value="Nike" id="Nike" <?php if(isset($_POST['brand'])){if(in_array('Nike', $_POST['brand'])){echo 'checked';}}?>>
                                                <label class="form-check-label" for="Nike">
                                                    Nike
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" name="brand[]" type="checkbox" value="Adidas" id="Adidas" <?php if(isset($_POST['brand'])){if(in_array('Adidas', $_POST['brand'])){echo 'checked';}}?> >
                                                <label class="form-check-label" for="Adidas">
                                                    Adidas
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" name="brand[]" type="checkbox" value="Puma" id="Puma" <?php if(isset($_POST['brand'])){if(in_array('Puma', $_POST['brand'])){echo 'checked';}}?> >
                                                <label class="form-check-label" for="Puma">
                                                    Puma
                                                </label>
                                            </div></li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" name="brand[]" type="checkbox" value="Converse" id="Converse" <?php if(isset($_POST['brand'])){if(in_array('Converse', $_POST['brand'])){echo 'checked';}}?> >
                                                <label class="form-check-label" for="Converse">
                                                    New Balance
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3" name="btnLSearch"
                                id="btnLSearch">Tìm
                                kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-end mb-3">
                            <select class="form-select" name="sortOption" id="sortOption" style="width:15%">
                                <option selected disabled>Sắp xếp</option>
                                <option value="asc" <?php if(isset($_POST['sortOption']) && $_POST['sortOption'] == 'asc' ){echo 'selected';}?>>Giá tăng dần</option>
                                <option value="desc"<?php if(isset($_POST['sortOption']) && $_POST['sortOption'] == 'desc'){echo 'selected';}?>>Giá giảm dần</option>
                            </select>
                    </div>
                    <div class="row">
                        <?php foreach ($List_products as $i => $product): ?>
                            <div class="col-6 col-md-3 text-center">
                                <a href="?action=product_detail&product_id= <?php echo $product->getProductId() ?>">
                                    <img src="../admin/img/products/<?= $product->Image ?>" alt="" class="product">
                                    <p><?php echo $product->product_name ?></p>
                                    <p><?php echo number_format($product->price,0,",",".").'VND' ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>