<title>Đăng nhập</title>
<main>
    <div class="container border" style="width:45%" >
        <ul class="nav nav-pills nav-justified m-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a
            class="nav-link active"
            id="tab-login"
            href="../controller/index.php?action=login"
            >Đăng nhập</a
            >
        </li>
        <li class="nav-item" role="presentation">
            <a
            class="nav-link"
            id="tab-register"
            href="../controller/index.php?action=register"
            >Đăng ký</a
            >
        </li>
        </ul>

        <div class="tab-content">
            <div>
                <form id="form_login" method="post" action="#">
                    <div class="text-center mb-3">
                        <p>Đăng nhập với</p>
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
                            <?php if (isset($errors["invalid"])) : ?>
                                <p class="help-block text-center">
                                    <strong><?= $errors["invalid"] ?></strong>
                                </p>
                            <?php endif ?>
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="username"/>
                            <?php if (isset($errors["username"])) : ?>
                                    <span class="help-block">
                                        <strong><?= $errors["username"] ?></strong>
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
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="form-check mb-3 mb-md-0">
                                    <label class="form-check-label" for="loginCheck"  name="loginCheck"> Nhớ tôi </label>
                                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                </div>
                            </div>
                            <div class="text-center col-md-6">
                                <button type="submit" class="btn btn-primary btn-block mb-4 " name="btn_login">Đăng nhập</button>
                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <p>Chưa có tài khoản? <a href="../controller/index.php?action=register">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>