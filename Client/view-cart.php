 <?php
    ob_start();
    include '../Client/header.php';
    include '../Admin/connect.php';
    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [''];
    // var_dump($_SESSION['cart']);
    $product = mysqli_query($conn, "SELECT product.*,
category.name AS 'cate_pro_name' FROM product JOIN category
ON product.id_category=category.id  ");


    ?>
 <main class="main">
     <div class="container">
         <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
             <li class="active">
                 <a href="http://localhost/cui_code/client/view-cart.php">Shopping Cart</a>
             </li>
             <li>
                 <a href="http://localhost/cui_code/client/check-out.php">Checkout</a>
             </li>
             <li class="disabled">
                 <a href="cart.html">Order Complete</a>
             </li>
         </ul>

         <div class="row">
             <div class="col-lg-8">
                 <div class="cart-table-container">
                     <table class="table table-cart">
                         <thead>
                             <tr>
                                 <th class="thumbnail-col"></th>
                                 <th class="product-col">Product</th>
                                 <th class="price-col">Price</th>
                                 <th class="qty-col">Quantity</th>
                                 <th class="text-right">Subtotal</th>
                                 <th class="text-right"></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $total_price = 0;  ?>
                             <?php foreach ($cart as $key => $value) {
                                    $total_price += ($value['price'] * $value['quantity']);
                                ?>

                                 <tr class="product-row">
                                     <td>
                                         <figure class="product-image-container">
                                             <?php foreach ($product as $key => $value2) { ?>
                                                 <a href="product-detail.php?sp=<?php echo $value2['slug'] ?>">
                                                 <?php } ?>
                                                 <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" alt="product">
                                                 </a>

                                                 <a href="cart.php?id=<?php echo $value['id'] ?>&action=delete" class="btn-remove icon-cancel" title="Remove Product"></a>
                                         </figure>
                                     </td>
                                     <td class="product-col">
                                         <h5 class="product-title">
                                             <a href=""><?php echo $value['name'] ?></a>
                                         </h5>
                                     </td>
                                     <td><?php echo number_format($value['price'])  ?></td>
                                     <td>
                                         <form action="cart.php">
                                             <input value="update" name="action" type="hidden">
                                             <input name="id" value="<?php echo $value['id'] ?>" type="hidden">
                                             <div class="product-single-qty">
                                                 <input name="quantity" value="<?php echo $value['quantity'] ?>" class="horizontal-quantity form-control" type="text">
                                             </div><!-- End .product-single-qty -->
                                             <button class="btn btn-shop btn-update-quantity" type="submit">Update</button>
                                         </form>

                                     </td>
                                     <td class="text-right"><span class="subtotal-price"><?php echo number_format($value['price']  * $value['quantity'])   ?> VNĐ </span></td>

                                 </tr>
                             <?php  }  ?>


                         </tbody>


                         <tfoot>
                             <tr>
                                 <td colspan="5" class="clearfix">
                                     <!-- <div class="float-left">
                                        <div class="cart-discount">
                                            <form action="#">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Coupon Code" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm" type="submit">Apply
                                                            Coupon</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div> -->
                                     <!-- End .float-left -->

                                     <!-- <div class="float-right">
                                        <button type="submit" class="btn btn-shop btn-update-cart">
                                            Update Cart
                                        </button>
                                       
                                    </div> -->
                                     <!-- End .float-right -->
                                 </td>
                             </tr>
                         </tfoot>
                     </table>
                 </div><!-- End .cart-table-container -->
             </div><!-- End .col-lg-8 -->

             <div class="col-lg-4">
                 <div class="cart-summary">
                     <h3>CART TOTALS</h3>

                     <table class="table table-totals">
                         <tbody>
                             <tr>
                                 <td>Subtotal</td>
                                 <td><?php echo number_format($total_price) ?> VNĐ</td>
                             </tr>

                             <tr>
                                 <!-- <td colspan="2" class="text-left">
                                    <h4>Shipping</h4>

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="radio" checked>
                                            <label class="custom-control-label">Local pickup</label>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-custom-control mb-0">
                                        <div class="custom-control custom-radio mb-0">
                                            <input type="radio" name="radio" class="custom-control-input">
                                            <label class="custom-control-label">Flat rate</label>
                                        </div>
                                    </div>

                                    <form action="#">
                                        <div class="form-group form-group-sm">
                                            <label>Shipping to <strong>NY.</strong></label>
                                            <div class="select-custom">
                                                <select class="form-control form-control-sm">
                                                    <option value="USA">United States (US)</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="China">China</option>
                                                    <option value="Germany">Germany</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm">
                                            <div class="select-custom">
                                                <select class="form-control form-control-sm">
                                                    <option value="NY">New York</option>
                                                    <option value="CA">California</option>
                                                    <option value="TX">Texas</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm">
                                            <input type="text" class="form-control form-control-sm" placeholder="Town / City">
                                        </div>

                                        <div class="form-group form-group-sm">
                                            <input type="text" class="form-control form-control-sm" placeholder="ZIP">
                                        </div>

                                        <button type="submit" class="btn btn-shop btn-update-total">
                                            Update Totals
                                        </button>
                                    </form>
                                </td> -->
                             </tr>
                         </tbody>

                         <tfoot>
                             <tr>
                                 <td>Total</td>
                                 <td><?php echo number_format($total_price) ?> VNĐ</td>
                             </tr>
                         </tfoot>
                     </table>

                     <div class="checkout-methods">
                         <a href="check-out.php" class="btn btn-block btn-dark">Proceed to Checkout
                             <i class="fa fa-arrow-right"></i></a>
                     </div>
                 </div><!-- End .cart-summary -->
             </div><!-- End .col-lg-4 -->
         </div><!-- End .row -->
     </div><!-- End .container -->

     <div class="mb-6"></div><!-- margin -->
 </main><!-- End .main -->

 <?php
    include '../Client/footer.php';

    ?>