<?php
include 'connect.php';
include 'header.php';
// $product = mysqli_query($conn, "SELECT * FROM product");
$orders = mysqli_query($conn,"SELECT orders.*,
user.name AS 'user_order' FROM orders JOIN user
ON orders.id_user=user.id");


?>
<div class="container mt-2">
    <h2>Danh sách</h2>
    <!-- <a class="btn btn-primary" href="addProduct.php">Thêm</a> -->
    <table class="table">
        <thead>
            <tr>
                
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Tổng giá</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Thời gian đặt</th>
                <th scope="col">Trạng thái</th>
            
                <th scope="col">Ghi chú</th>
                <th scope="col"></th>
                
            </tr>
        </thead>
        <tbody>

            <?php foreach ($orders as $key => $value) : ?>
                <tr>
                    <th scope="row"><?php echo $key + 1   ?></th>
                  
                    <td><?php echo $value['user_order']   ?></td>
                    <td><?php echo number_format($value['total']) ?> VNĐ</td>
                    <td><?php echo $value['address']   ?></td>
                    <td><?php echo $value['create_at'] ?> </td>
                   
                    <td>
                        <?php if($value['status'] == 0)  {?>
                            <span class="badge bg-danger">Chưa xử lý</span>
                            <?php } elseif ($value['status'] == 1) {?>
                                <span class="badge bg-success">Đang xử lý</span>
                                <?php } elseif ($value['status'] == 2) {?>
                                <span class="badge bg-success">Đang giao hàng</span>
                                <?php } elseif ($value['status'] == 3) {?>
                                <span class="badge bg-success">Giao hàng thành công</span>
                                <?php } else {?>
                                    <span class="badge bg-danger">Hủy đơn</span>
                            <?php  }?>
                       
                    
                    </td>
                 
                    <td><?php echo $value['note']   ?></td>
                    <td>
                        <a href="order_detail.php?id=<?php echo $value['id'] ?>"><span class="btn btn-success">Xem chi tiết</span></a>
                        <a onclick="return confirm('Bạn có muốn xóa không ?')" href="deleteOrder.php?id=<?php echo $value['id'] ?>"><span class="btn btn-danger">Xóa</span></a>

                    </td>
                </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php';   ?>