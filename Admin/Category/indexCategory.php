<?php
include '../connect.php';
include '../header.php';
$category = mysqli_query($conn, "SELECT * FROM category");

// phân trang danh mục sp
// bước1 lấy tất cả các bản ghi co trong category
$total = mysqli_num_rows($category);
// bước 2 lập số bản ghi trên 1 trang
$limit = 5;
// bước 3 tính số trang
$page  = ceil($total / $limit);
// bước 4  lấy trang hiện tại
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
// tính start,
$start = ($cr_page - 1) * $limit;
// query sử dụng
$category = mysqli_query($conn, "SELECT * FROM category LIMIT $start,$limit");

?>
<div class="container mt-2">
    <h2>Danh sách</h2>
    <a class="btn btn-primary" href="addCategory.php">Thêm</a>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($category as $key => $value) : ?>
                <tr>
                    <th scope="row"><?php echo $key + 1   ?></th>
                    <td><?php echo $value['name']   ?></td>
                    <?php if ($value['status'] == 1) { ?>
                        <td>Hiện</td>
                    <?php } else {
                    ?>
                        <td>ẩn</td>
                    <?php  } ?>

                    <td>
                        <a href="editCategory.php?id=<?php echo $value['id'] ?>"><span class="btn btn-success">Sửa</span></a>
                        <a onclick="return confirm('Bạn có muốn xóa không ?')" href="deleteCategory.php?id=<?php echo $value['id'] ?>"><span class="btn btn-danger">Xóa</span></a>

                    </td>
                </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($cr_page - 1 > 0) { ?>
                <li class="page-item"><a class="page-link" href="indexCategory.php?page=<?php echo $cr_page - 1 ?>">&laquo;</a>
                </li>
            <?php } ?>
            <?php for ($i = 1; $i <= $page; $i++) { ?>
                <li class="<?php echo (($cr_page == $i) ? 'active' : '') ?> page-item">
                    <a class="page-link" href="indexCategory.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php } ?>
            <?php if ($cr_page + 1 <= $page) { ?>
                <li class="page-item"><a class="page-link" href="indexCategory.php?page=<?php echo $cr_page + 1 ?>">&raquo;</a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>


<?php include '../footer.php';   ?>