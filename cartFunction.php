<?php  

// tổng tiền các sản phẩm ng dùng đã mua
function total_price($cart){
    $total_price = 0;
foreach ($cart as $key => $value) {
    $total_price +=  $value["price"] * $value["quantity"];

}
return $total_price;
}

function total_item($cart){
    $total_item = 0;
    foreach ($cart as $key => $value) {
       $total_item +=  $value[ "quantity"];
    }
    return $total_item;

}

// function total_percent($cart){
//     $total_percent = 0;
//     foreach ($cart as $key => $value) {
//         $total_percent = ceil(100-(($value['sale_price'] / $value['price']) *100));
//     }
//     return $total_percent;

// }








?>