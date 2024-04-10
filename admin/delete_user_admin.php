<?php
session_start();
require_once '../admin/bootstrap.php';
use CT271\NLCS\User;
$user = new User($PDO);
    if(isset($_GET['user_id'])){
        if($user->find($_GET['user_id']) !== null){
            $user->delete();
            echo "<script>alert('Xóa tài khoản thành công')</script>";
            echo "<script>window.location = 'user_admin.php'</script>";
        }
    }
?>