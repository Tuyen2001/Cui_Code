<?php
include '../Admin/connect.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
    // session_destroy();
    // die();
// echo $id;


$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';

$quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;
// if($quantity <=0){
    // $quantity = 1;
// }

// echo $action;
// echo "<br>";
// echo $id;
// var_dump($action);
// die();

if ($query = mysqli_query($conn, "SELECT * FROM product 
WHERE id = $id")) {
    $product = mysqli_fetch_assoc($query);
}

// lấy những trường muốn cần có trong mảng
$item = [
    'id' => $product['id'],
    'name' => $product['name'],
    // 'slug' => $product['slug'],
    'image' => $product['image'],
    'price' => ($product['sale_price'] > 0)  ? $product['sale_price'] : $product['price'],
    'quantity' => $quantity

];
// dùng session để lưu thông tin
// $_SESSION['cart'][$id]]: [][] mảng nhiều chiều để lấy nhiều mảng
//  nếu sesstion đã có trong giỏ hàng thì quantity tăng lên +1
//  còn lại thì thêm sản phẩm khác

if ($action == 'add') {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = $item;
    }
}

if ($action == 'update'){
    $_SESSION['cart'][$id]['quantity']  = $quantity;
}

if ($action == 'delete'){
    
   unset( $_SESSION['cart'][$id]);
}

header('location: view-cart.php');
echo '<pre>';
print_r($_SESSION['cart']);

// thêm mới vào giỏ hàng
 
//Cập nhật cart

// Xóa sản phẩm khỏi cart
