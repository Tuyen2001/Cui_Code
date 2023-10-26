<?php   

    include '../connect.php';
    include '../header.php';

   
    // var_dump($category);
    $category = mysqli_query($conn,"SELECT * FROM category");
    //
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $id_category = $_POST['id_category'];
        $price = $_POST['price'];
        $sale_price = $_POST['sale_price'];
        $dess = $_POST['dess'];
        $status = $_POST['status'];

        // echo '<pre>';
        // print_r($_FILES);
        // die();
        if(isset($_FILES['image'])){
            $file = $_FILES['image'];
            $file_name = $file['name'];
            if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || 
            $file['type'] == 'image/png'){
                move_uploaded_file($file['tmp_name'],'uploads/'.$file_name);
            }else{
                echo 'không đúng định dạng';
                $file_name = '';
            }
          
        }
        // mô tả nhiều ảnh 
        if(isset($_FILES['images'])){
            $files = $_FILES['images'];
            $file_names = $files['name'];
        //    print_r($_FILES);
        //     die();
        foreach ($file_names as $key => $value) {
            move_uploaded_file($files['tmp_name'][$key],'uploads/'.$value);
        }             
        }


        $sql = "INSERT INTO product(name,slug,price,sale_price,image,status,dess,id_category)
        VALUES ('$name','$lug','$price','$sale_price','$file_name','$status','$dess','$id_category')";
         $query = mysqli_query($conn,$sql);
       
        $id_pro = mysqli_insert_id($conn);
        // var_dump($id_pro); die();
        foreach ($file_names as $key => $value) {
            mysqli_query($conn, "INSERT INTO img_product(id_product,image)
            VALUES ('$id_pro','$value')");
        }

       
        
        
        if($query){
            header('location: indexProduct.php');
        }else{
            echo "error";
        }
    }
   
  
?>






  
    <!-- thêm danh muc -->
    <div class="container">
    <a class="btn btn-primary" href="indexProduct.php">Danh sách</a>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">Tên sản phẩm </label>
                <input name="name" type="text" class="form-control" onkeyup="ChangeToSlug();" id="title">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tên đường dẫn slug </label>
                <input name="slug" type="text" class="form-control" id="slug">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tên danh mục </label>
              <select class="form-control" name="id_category" id="">
                <option value="">Tên danh mục</option>
                <?php foreach ($category as $key => $value) {
                 ?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                <?php  } ?>
              </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gía </label>
                <input name="price" type="text" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gía khuyến mãi </label>
                <input name="sale_price" type="text" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">ảnh </label>
                <input name="image"  type="file" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">ảnh mô tả </label>
                <input name="images[]" type="file" class="form-control"  multiple="multiple">
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
            <div class="mb-3">
                <label for="" class="form-label">Mô tả  </label>

                <textarea name="dess" type="text" class="form-control" id=""></textarea>
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