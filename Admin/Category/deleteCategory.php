<?php 
include '../connect.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

      $sql = mysqli_query($conn,"DELETE FROM category WHERE id = $id");
        if($sql){
            header('location:indexCategory.php');
        }else{
            echo "lỗi";
        }
    }


?>