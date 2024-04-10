<title>Đăng ký</title>
<main>
    <div class="container border" style="width:45%" >
        <ul class="nav nav-pills nav-justified m-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a
            class="nav-link"
            id="tab-login"
            href="../controller/index.php?action=login"
            >Đăng nhập</a
            >
        </li>
        <li class="nav-item" role="presentation">
            <a
            class="nav-link active"
            id="tab-register"
            href="../controller/index.php?action=register"
            >Đăng ký</a
            >
        </li>
        </ul>

        <div class="tab-content">
            <div class="" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <form action="" id="frmLogin" method="POST">
                    <div class="text-center mb-3">
                        <p>Đăng ký với</p>
                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-google"></i>
                        </button>

                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-github"></i>
                        </button>
                    </div>

                    <p class="text-center">hoặc</p>

                    <div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="username"/>
                            
                            <?php if (isset($errors["username"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["username"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>
                        

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email"/>
                            
                            <?php if (isset($errors["email"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["email"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="full_name">Họ và tên</label>
                            <input type="text" id="full_name" class="form-control" name="full_name"/>
                            
                            <?php if (isset($errors["full_name"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["full_name"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone_number">Số điện thoại</label>
                            <input type="number" id="phone_number" class="form-control" name="phone_number"/>
                            
                            <?php if (isset($errors["phone_number"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["phone_number"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input type="password" id="password" class="form-control" name="password"/>
                           
                            <?php if (isset($errors["password"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["password"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="rpassword">Lập lại mật khẩu</label>
                            <input type="password" id="rpassword" class="form-control" name="rpassword"/>
                            
                            <?php if (isset($errors["rpassword"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["rpassword"] ?></strong>
                                    </span>
                            <?php endif ?>
                        </div>

                        <div class="form-check d-flex justify-content-center mb-4">
                            <label class="form-check-label" for="registerCheck">
                            <input class="form-check-input me-2" type="checkbox" id="registerCheck" values="1" name="registerCheck" checked/>
                            
                            <p>Tôi đồng ý với các điều kiện</p>
                            </label>
                            <?php if (isset($errors["registerCheck"])) : ?>
                                    <p class="help-block">
                                        <strong><?= $errors["registerCheck"] ?></strong>
                                    </p>
                            <?php endif ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block mb-3">Đăng ký</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</main>