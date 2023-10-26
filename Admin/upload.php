<?php   
    include 'connect.php';
    include 'header.php';

    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $file_name = $file['name'];
        echo $_FILES['file']['name'];
        move_uploaded_file($file['tmp_name'],'uploads/'.$file_name);
    }  
    // var_dump($_FILES);

     ?>

<div class="container mt-4">

<form action="" method="post" role="form" enctype="multipart/form-data">
<div class="mb-3">
  <label  for="formFile" class="form-label">Chọn file ảnh</label>
  <input name="file" class="form-control" type="file" id="formFile">
</div>

<button type="submit" class="btn btn-primary">Thêm</button>
</form>
</div>


<?php   include 'footer.php'; ?>