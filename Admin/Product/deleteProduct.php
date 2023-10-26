<?php 
include '../connect.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

      $sql = mysqli_query($conn,"DELETE FROM product WHERE id = $id");
        if($sql){
            header('location:indexProduct.php');
        }else{
            echo "lỗi";
        }
    }


?>