<?php
include '../connect.php';
include '../header.php';
// $product = mysqli_query($conn, "SELECT * FROM product");
$product = mysqli_query($conn, "SELECT product.*,
category.name AS 'cate_pro_name' FROM product JOIN category
ON product.id_category=category.id");

// phân trang danh mục sp
// bước1 lấy tất cả các bản ghi co trong category
$total = mysqli_num_rows($product);
// bước 2 lập số bản ghi trên 1 trang
$limit = 5;
// bước 3 tính số trang
$page  = ceil($total / $limit);
// bước 4  lấy trang hiện tại
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
// tính start,
$start = ($cr_page - 1) * $limit;
// query sử dụng
$product = mysqli_query($conn, "SELECT product.*,
category.name AS 'cate_pro_name' FROM product JOIN category
ON product.id_category=category.id LIMIT $start,$limit");
// $product = mysqli_query($conn, "SELECT * FROM product LIMIT $start,$limit");
?>
<div class="container mt-2">
    <h2>Danh sách</h2>
    <a class="btn btn-primary" href="addProduct.php">Thêm</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Danh muc sản phẩm</th>
                <th scope="col">Gía</th>
                <th scope="col">Giá khuyến mãi</th>
                <th scope="col">ảnh</th>
                <th scope="col">Tình Trạng</th>
              
                <th scope="col"></th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($product as $key => $value) : ?>
                <tr>
                    <th scope="row"><?php echo $key + 1   ?></th>
                    <td><?php echo $value['name']   ?></td>
                    <td><?php echo $value['cate_pro_name']   ?></td>
                    <td><?php echo $value['price']   ?></td>
                    <td><?php echo $value['sale_price']   ?></td>
                    <td><img src="uploads/<?php echo $value['image']   ?>" alt="" width="40px"></td>

                    <td><?php echo (($value['status'] == 1) ? 'Hiện' : 'ẩn') ?></td>

                   
                    <td>
                        <a href="editProduct.php?id=<?php echo $value['id'] ?>"><span class="btn btn-success">Sửa</span></a>
                        <a onclick="return confirm('Bạn có muốn xóa không ?')" href="deleteProduct.php?id=<?php echo $value['id'] ?>"><span class="btn btn-danger">Xóa</span></a>

                    </td>
                </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($cr_page - 1 > 0) { ?>
                <li class="page-item"><a class="page-link" href="indexProduct.php?page=<?php echo $cr_page - 1 ?>">&laquo;</a>
                </li>
            <?php } ?>
            <?php for ($i = 1; $i <= $page; $i++) { ?>
                <li class="<?php echo (($cr_page == $i) ? 'active' : '') ?> page-item">
                    <a class="page-link" href="indexProduct.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php } ?>
            <?php if ($cr_page + 1 <= $page) { ?>
                <li class="page-item"><a class="page-link" href="indexProduct.php?page=<?php echo $cr_page + 1 ?>">&raquo;</a>
                </li>
            <?php } ?>
        </ul>
    </nav>

</div>



<?php include '../footer.php';   ?>