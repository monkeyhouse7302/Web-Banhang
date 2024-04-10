<?php 
    ob_start();
    session_start();
    require_once '../libraries/Psr4AutoloaderClass.php'; //Thư viện tự động nạp lớp
    $loader = new Psr4AutoloaderClass;
    $loader->register();
    $loader->addNamespace('CT271\NLCS', '../model');
    require_once '../model/pdo_connect.php'; //Kết nối cơ sở dữ liệu
    include '../view/layouts/header.php'; //header dùng chung
    
    use CT271\NLCS\User;
    use CT271\NLCS\Product;
    use CT271\NLCS\Category;
    use CT271\NLCS\Order;

    $category = new Category($PDO);
    $List_category = $category->all();
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'contact'://done                   
                include '../view/contact.php';
                break;
            case 'login'://done
                $errors = [];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $user = new User($PDO);
                    $user->fill($_POST);
                    if ($user->validateLogin($_POST["username"],$_POST["password"])) {
                        header("Location: ?action=home");
                    }
                    $errors = $user->getValidationErrors();
                }         
                include '../view/login.php';
                break;
            case 'logout'://done
                if(isset($_SESSION["userID"])){
                    unset($_SESSION["userID"]);
                    unset($_SESSION["cart"]);
                    echo "<script>alert('Đăng xuất thành công!')</script>";
                    header("Location: ?action=home");
                } else {
                    echo "<script>Không thể đăng xuất</script>";
                }
                break;
            case 'register'://done    
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $user = new User($PDO);
                    $user->fill($_POST);
                    if ($user->validate()) {
                        $user->saveUser();
                        echo "<script>alert('Tạo tài khoản thành công!')</script>";
                        echo "<script>window.location = '?action=login'</script>";
                    }
                    $errors = $user->getValidationErrors();
                }
                include '../view/register.php';
                break;
            case 'products'://done
                $product = new Product($PDO);
                if(isset($_GET['category_id'])){
                    $List_products = $product->find_all_category($_GET['category_id']);
                }                
                else{
                    $List_products = $product->all();
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                    if(isset($_POST['price_bot']) && isset($_POST['price_top']) && isset($_POST['brand'])){
                        $List_products_filter = $product->FindByFilter($List_products);
                        if(isset($List_products_filter)){
                            $List_products = $List_products_filter;
                        }
                    }
                    if(isset($_POST['sortOption'])){
                        $sortOption = $_POST['sortOption'];
                        usort($List_products, function ($a, $b) use ($sortOption) {
                            if ($sortOption === 'desc') {
                                return $b->price - $a->price;
                            }
                            else{
                                return $a->price - $b->price;
                            }
                        });
                    }
                }
                
                include '../view/products.php';
                break;
            case 'search'://done
                $product = new Product($PDO);
                $List_products = $product->search($_GET["txtSearch"]);
                if(isset($_POST['btnLSearch'])){
                    $List_products = $product->FindByFilter($List_products);
                }
                include '../view/products.php';
                break;
            case 'product_detail'://done
                if(isset($_GET['product_id'])){
                    $product = new Product($PDO);
                    $product_details = $product->find($_GET['product_id']);
                }
                include '../view/product_detail.php';
                break;
            case 'about'://done                   
                include '../view/about.php';
                break;
            case 'like'://done
                if(isset($_SESSION["userID"])){
                    $product = new Product($PDO);
                    $List_products_like = $product->products_like($_SESSION["userID"]);
                }
                else {
                    echo "<script>alert('Vui lòng đăng nhập!')</script>";
                    echo "<script>window.location = '?action=login'</script>";
                }
                include '../view/like_product.php';
                break;
            case 'delete_like'://done
                $product = new Product($PDO);
                $product->delete_like($_GET['product_id']);
                header("Location: ?action=like");
            case 'add':
                if(isset($_POST['btn_add_into_cart'])){
                    if(isset($_POST['amounts'])){
                        $amounts=$_POST['amounts'];
                        $product_id_cart=$_POST['product_id'];
                        if(isset($_SESSION['cart'][$product_id_cart])){
                            $_SESSION['cart'][$product_id_cart]['amounts']+=$amounts;
                        }else{
                            $product = new Product($PDO);
                            $products_cart = $product->find($product_id_cart);
                            $_SESSION['cart'][$product_id_cart]['product_id']=$product_id_cart;
                            $_SESSION['cart'][$product_id_cart]['amounts']=$amounts;
                            $_SESSION['cart'][$product_id_cart]['img']=$products_cart->Image;
                            $_SESSION['cart'][$product_id_cart]['product_name']=$products_cart->product_name;
                            $_SESSION['cart'][$product_id_cart]['price']=$products_cart->price;
                            $_SESSION['cart'][$product_id_cart]['brand']=$products_cart->brand;
                            $_SESSION['cart'][$product_id_cart]['category_id']=$products_cart->category_id;
                        }
                    }
                    header("Location: ?action=cart");
                }
                
                if(isset($_POST['btn_add_into_like'])){
                    if(isset($_SESSION["userID"])){
                        if(isset($_POST['product_id'])){
                            $product = new Product($PDO);
                            $product->saveProducts_like($_SESSION["userID"],$_POST['product_id']);
                            header("Location: ?action=like");
                        }
                    }else{
                        echo "<script>alert('Vui lòng đăng nhập!')</script>";
                        echo "<script>window.location = '?action=login'</script>";
                    }
                }
                break;
            case 'cart'://done        
                if(isset($_SESSION['cart'])){
                    $product_in_cart=$_SESSION['cart'];
                }           
                include '../view/cart.php';
                break;
            case 'delete_product_cart'://done
                unset($_SESSION['cart'][$_GET['id_product_cart']]);
                header("Location: ?action=cart");
                break;
            case 'change_amounts'://done
                if(isset($_GET['type']) && isset($_GET['id_product_cart']) && isset($_GET['amounts'])){
                    $amounts = $_GET['amounts'];
                    if($_GET['type']=='decrease')
                        $amounts--;
                    if($_GET['type']=='increase')
                        $amounts++;  
                    if($amounts==0){
                        unset($_SESSION['cart'][$_GET['id_product_cart']]);
                    }else{
                        $_SESSION['cart'][$_GET['id_product_cart']]['amounts']=$amounts;
                    }  
                    header("Location: ?action=cart");
                }
                break;
            case 'order'://done
                if (isset($_SESSION["userID"])) {
                    $user_id = $_SESSION["userID"];
                    $user = new User($PDO);
                    $user->find($user_id);
                  }  
                if(isset($_SESSION['cart'])){
                    $product_in_orders=$_SESSION['cart'];
                }
                else {
                    echo '<script>alert("Vui lòng thêm sản phẩm vào giỏ hàng!")</script>';
                    echo "<script>window.location = '?action=products'</script>";
                }                   
                include '../view/order.php';
                break;
            case 'agree_order'://done
                if(isset($_POST['btn_agree_order'])){
                    $product_in_orders=$_SESSION['cart'];
                    $order = new Order($PDO);
                    $order->fill($_POST);
                    $order->saveOrder();
                    foreach($product_in_orders as $id => $value){
                        $order->saveOrder_Detail($order->getOrderId(),$value['product_id'],$value['amounts']);
                    }
                }
                include '../view/order_success.php';
                break;
            case 'delete_cart'://done
                unset($_SESSION['cart']);
                header("Location: ?action=products");
                break;
            case 'account'://done
                $order = new Order($PDO);
                $List_order_user=$order->find_orders_user($user->email);
                if(isset($_GET['cancel_order']) && isset($_GET['order_id'])){
                    $order->update_status_order($_GET['order_id'],'Đã hủy');
                    header("Location: ?action=account");
                }
                include '../view/account.php';
                break;
            case 'edit_account'://done   
                $user = new User($PDO);
                $user = $user->find($_SESSION["userID"]); 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($user->update($_POST)) {
                        echo "<script>alert('Cập nhật tài khoản thành công!')</script>";
                        echo "<script>window.location = '?action=account'</script>";
                    }
                    $errors = $user->getValidationErrors();
                }
                    include '../view/edit_account.php';
                    break;
            case 'change_password'://done   
                $user = new User($PDO);
                $user = $user->find($_SESSION["userID"]); 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if(password_verify($_POST['password_old'],$user->password)){
                        if ($user->update_password($_POST)) {
                            echo "<script>alert('Cập nhật mật khẩu tài khoản thành công!')</script>";
                            echo "<script>window.location = '?action=account'</script>";
                        }
                    } else{
                        $password_old_errors = "Sai mật khẩu";
                    }
                    $errors = $user->getValidationErrors();
                }
                include '../view/change_password.php';
                break;
            case 'detail_order'://done
                if($_GET['order_id']){
                    $order = new Order($PDO);
                    $order_full = $order->find($_GET['order_id']);
                    $order_detail = new Order($PDO);
                    $order_detail = $order_detail->find_orders_detail($_GET['order_id']);
                    $product = new Product($PDO);
                }
                include '../view/detail_order.php';
                break;
            default://done
                require '../vendor/autoload.php';
                include '../view/home.php';    
                break; 
        }
    }
    else{
        require '../vendor/autoload.php';
        include '../view/home.php';  
    }
    include '../view/layouts/footer.php'; 
    ob_end_flush();
?>