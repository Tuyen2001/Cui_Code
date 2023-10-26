<?php   

    include '../connect.php';
    include '../header.php';

    $category = mysqli_query($conn,"SELECT * FROM category");
    // var_dump($category);
    //sửa
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $data= mysqli_query($conn, "SELECT *FROM category WHERE id= $id");
        
        $cate = mysqli_fetch_assoc($data);

    }

   if(isset( $_POST['name'])){
        $name = $_POST['name'];
        $status = $_POST['status'];
        $slug = $_POST['slug'];

        $sql = "UPDATE category SET name = '$name',slug = '$slug',status= '$status' WHERE id='$id'";
        $query = mysqli_query($conn,$sql);
        if($query){
            header('location:Indexcategory.php');
        }else{
            echo "lỗi";
        }
   }
   
?>





    <!-- thêm danh muc -->
    <div class="container">
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Tên danh mục </label>
                <input value="<?php echo $cate['name'] ?>" name="name" type="text" class="form-control" onkeyup="ChangeToSlug();" id="title">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tên đường dẫn slug </label>
                <input value="<?php echo $cate['slug'] ?>" name="slug" type="text" class="form-control" id="slug">
            </div>
            <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div> -->
            <div class="form-group">
                <label for="">Trạng thái</label>
                <div class="radio">
                    <label for="">
                        <input type="radio" name="status" value="1" <?php echo (($cate['status'] ==1)? 'checked' : '') ?>>
                        Hiện
                    </label>
                    <label for="">
                        <input type="radio" name="status" value="0"  <?php echo (($cate['status'] ==0)? 'checked' : '') ?>>
                        ẩn
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Sửa</button>
        </form>

        <!-- danh sách danh mục -->
        
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    
    <?php  include '../footer.php'  ?>