<?php 
include '../Admin/connect.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

      $sql = mysqli_query($conn,"DELETE FROM orders WHERE id = $id");
        if($sql){
            header('location:order.php');
        }else{
            echo "lỗi";
        }
    }


?>