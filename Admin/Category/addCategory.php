<?php   

    include '../connect.php';
    include '../header.php';

   
    // var_dump($category);
    

   if(isset( $_POST['name'])){
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $status = $_POST['status'];
        

        $sql = "INSERT INTO category(name,slug,status) values ('$name','$slug', '$status')";
        $query =mysqli_query($conn,$sql);
        if($query){
            header('location:indexCategory.php');
       }else{
        echo "lỗi";
       }
   }
   
  
?>






  
    <!-- thêm danh muc -->
    <div class="container">
    <a class="btn btn-primary" href="indexCategory.php">Danh sách</a>
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Tên danh mục </label>
                <input name="name" type="text" class="form-control" onkeyup="ChangeToSlug();" id="title">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Đường dẫn slug </label>
                <input name="slug" id="slug" type="text" class="form-control" >
            </div>
            <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div> -->
            <div class="form-group">
                <label for="">Trạng thái</label>
                <div class="radio">
                    <label for="">
                        <input type="radio" name="status" value="1" checked="checked">
                        Hiện
                    </label>
                    <label for="">
                        <input type="radio" name="status" value="0" checked="checked">
                        ẩn
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Thêm</button>
        </form>

        <!-- danh sách danh mục -->
        
        
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
 
    <?php   

        include '../footer.php';
?>