<main class="row ">
            <div class="container w-50">
                <h3 class="text-center">Thay đổi thông tin - <?php echo $user->username?></h3>
                <form action="" id="frmLogin" method="POST">
                    <div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="full_name">Họ và tên</label>
                            <input type="text" id="full_name" class="form-control" name="full_name" value="<?php echo $user->full_name?>"/>
                            
                            <?php if (isset($errors["full_name"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["full_name"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone_number">Số điện thoại</label>
                            <input type="number" id="phone_number" class="form-control" name="phone_number" value="<?php echo $user->phone_number?>"/>
                            
                            <?php if (isset($errors["phone_number"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["phone_number"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block mb-3">Thay đổi</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </main>