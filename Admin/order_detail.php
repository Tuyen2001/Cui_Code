<?php
// include 'connect.php';
include 'header.php';
include '../cartFunction.php';
if (isset($_GET['id'])) {
    $id_order = $_GET['id'];
    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id = $id_order");
    $order = mysqli_fetch_assoc($order_query);
    $id_user = $order['id_user'];
    $user_query = mysqli_query($conn, "SELECT * FROM user
    WHERE id = $id_user");


    //lấy ra danh sách sản phẩm trong  chi tiet đơn hàng
    $product = mysqli_query($conn, "SELECT  order_detail.id_order, order_detail.price,
    order_detail.quantity, product.image, product.name FROM order_detail JOIN product ON
    order_detail.id_product = product.id WHERE order_detail.id_order = $id_order");
    $user = mysqli_fetch_assoc($user_query);
}

if(isset($_POST['status'])) {

    $status = $_POST['status'];
    mysqli_query($conn,"UPDATE  orders SET
    status = '$status' WHERE id = $id_order ");
    header('location: order.php');
}


?>
<div class="container mt-2">

    <!-- <a class="btn btn-primary" href="addProduct.php">Thêm</a> -->
    <div class="row">
        <div class="panel panel-infor">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin khách hàng</h3>

            </div>
            <div class="panel-body">
                <p>Tên khách hàng: <?php echo $user['name'] ?></p>
                
                <p>Email khách hàng: <?php echo $user['email'] ?></p>
                <p>Số điện thoại: <?php echo $order['phone'] ?></p>

                <p>Địa chỉ nhận hàng: <?php echo $order['address'] ?></p>

                <p>Ghi chú: <?php echo $order['note'] ?></p>

                <p>Ngày đặt hàng: <?php echo $order['create_at'] ?> </p>
                <p>Trạng thái đơn hàng:
                    <?php if($order['status'] == 0)  { ?>
                        Chưa xử lý
                    <?php } elseif ($order['status'] == 1) { ?>
                        Đang xử lý
                    <?php } elseif ($order['status'] == 2) { ?>
                        Đang giao hàng
                    <?php } elseif ($order['status'] == 3) { ?>
                        Giao hàng thành công
                    <?php } else { ?>
                        Hủy đơn
                    <?php } ?>
                </p>
            </div>
        </div>

        <div class="panel panel-infor">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách đơn hàng</h3>

            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">ảnh</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Gía</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?php echo $key + 1 ?></th>

                                <td><?php echo $value['name']  ?></td>
                                <td>
                                  <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" width="40px" alt="">
                                </td>
                                <td><?php echo $value['quantity']  ?></td>
                                <td><?php echo number_format($value['price'])  ?></td>
                                <td><?php echo number_format($value['price'] * $value['quantity'])  ?></td>
                            </tr>
                        <?php endforeach  ?>
                        <tr class="bg-danger">
                            <td>Tổng tiền</td>
                            <td colspan="6"><?php echo number_format(total_price($product))  ?> VNĐ</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label class="sr-only" for="">Trạng thái: </label>
                    <select class="form-control" name="status" id="">
                        <option value="0">Chưa xử lý</option>
                        <option value="1">Đã xử lý</option>
                        <option value="2">Đang giao hàng</option>
                        <option value="3">Đã giao hàng</option>
                        <option value="4">Hủy</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Cập nhật</button>

            </form>
        </div>
    </div>
</div>

<?php include 'footer.php';   ?>