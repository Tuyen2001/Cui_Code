<?php 
 include '../Admin/connect.php';
session_start();
 // hủy session theo tên
 unset($_SESSION['user']);
// xóa sess 
// session_destroy();

header('location: login.php');
?>