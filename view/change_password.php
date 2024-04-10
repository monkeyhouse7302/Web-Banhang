<main class="row ">
            <div class="container w-50">
                <h3 class="text-center">Thay đổi mật khẩu - <?php echo $user->username?></h3>
                <form action="" id="frmLogin" method="POST">
                    <div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password_old">Mật khẩu cũ</label>
                            <input type="password" id="password_old" class="form-control" name="password_old"/>
                            
                            <?php if (isset($password_old_errors)) : ?>
                                    <span class="help-block">
                                        <strong><?= $password_old_errors ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>
                        
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Mật khẩu mới</label>
                            <input type="password" id="password" class="form-control" name="password"/>
                            
                            <?php if (isset($errors["password"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["password"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="rpassword">Mật khẩu mới</label>
                            <input type="password" id="rpassword" class="form-control" name="rpassword"/>
                            
                            <?php if (isset($errors["rpassword"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["rpassword"] ?></strong>
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