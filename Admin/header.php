<?php
include 'connect.php';
ob_start(); // khai bao Bộ nhớ đệm
session_start(); //kiểm tra xem một phiên đã được bắt đầu chưa 

if (isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
} else {
    header('location: login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Trang quản trị</title>
</head>

<body>

    <div class="container mt-4">

        <h2>Trang quản trị</h2>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://localhost/cui_code/admin/category/indexcategory.php">Quản lý danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="http://localhost/cui_code/admin/product/indexproduct.php">Quản lý sản phẩm</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="">Quản lý nhân viên</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="http://localhost/cui_code/admin/order.php">Quản lý đơn hàng</a>

                        </li>
                        <li class="nav-item" >
                            <a class="nav-link active" href="">Quản lý tin tức</a>

                        </li>

                    </ul>
                    <li class="dropdown user user-menu">
                        
                           
                            <span class="btn btn-primary">Xin chào: <?php echo $admin['name'] ?></span>
                       

                        <div class="pull-right">
                            <a href="http://localhost/cui_code/admin/logout.php" class="btn btn-danger">Sign out</a>
                        </div>
                    </li>
                    
                   
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>