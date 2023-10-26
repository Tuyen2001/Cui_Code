<?php
ob_start();
include '../Client/header.php';
include '../cartFunction.php';
// $user = $_SESSION['user'] ; //  lấy dữ liệu từ sesion đổ ra thông  tin hóa đơn
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];

if (isset($_POST['name'])) {
    $id_user = $user['id'];
    $note = $_POST['note'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    // $create_at = $_POST['create_at'];
    $total = $_POST['total'];
    // 
    $query = mysqli_query($conn, "INSERT INTO orders(id_user,note,address,phone,create_at,total)
    VALUES('$id_user','$note','$address','$phone',NOW(),'$total') "); // hàm now lấy tgian hiện tại
    if ($query) {
        $id_order  = mysqli_insert_id($conn);
        foreach ($cart as  $value) {
            mysqli_query($conn, "INSERT INTO order_detail(id_order,id_product,quantity,price)
            VALUES('$id_order','$value[id]','$value[quantity]','$value[price]')");
        }
        unset($_SESSION['cart']);
        header('Location: index.php');
    }
}
ob_end_flush();
?>

<main class="main main-test">
    <?php if (isset($_SESSION['user'])) { ?>
        <form method="post">
            <div class="container checkout-container">
                <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                    <li>
                        <a href="http://localhost/cui_code/client/view-cart.php">Shopping Cart</a>
                    </li>
                    <li class="active">
                        <a href="http://localhost/cui_code/client/check-out.php">Checkout</a>
                    </li>
                    <li class="disabled">
                        <a href="#">Order Complete</a>
                    </li>
                </ul>
                <!-- 
                <div class="login-form-container">
                    <h4>Returning customer?
                        <button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">Login</button>
                    </h4>

                    <div id="collapseOne" class="collapse">
                        <div class="login-section feature-box">
                            <div class="feature-box-content">
                                <form action="#" id="login-form">
                                    <p>
                                        If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.
                                    </p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-0 pb-1">Username or email <span class="required">*</span></label>
                                                <input type="email" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-0 pb-1">Password <span class="required">*</span></label>
                                                <input type="password" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn">LOGIN</button>

                                    <div class="form-footer mb-1">
                                        <div class="custom-control custom-checkbox mb-0 mt-0">
                                            <input type="checkbox" class="custom-control-input" id="lost-password" />
                                            <label class="custom-control-label mb-0" for="lost-password">Remember
                                                me</label>
                                        </div>

                                        <a href="forgot-password.html" class="forget-password">Lost your password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="checkout-discount">
            <h4>Have a coupon?
                <button data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">ENTER YOUR CODE</button>
            </h4>

            <div id="collapseTwo" class="collapse">
                <div class="feature-box">
                    <div class="feature-box-content">
                        <p>If you have a coupon code, please apply it below.</p>

                        <form action="#">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm w-auto" placeholder="Coupon code" required="" />
                                <div class="input-group-append">
                                    <button class="btn btn-sm mt-0" type="submit">
                                        Apply Coupon
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Billing details</h2>


                                <!-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First name
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <input type="text" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last name
                                                    <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="form-control" required />
                                            </div>
                                        </div>
                                    </div> -->
                                <input hidden type="datetime" name="create-at" value="" />

                                <input hidden value="<?php echo total_price($cart) ?>" name="total" type="text" class="form-control" />
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input value="<?php echo $user['name'] ?>" name="name" type="text" class="form-control" />
                                </div>

                                <!-- <div class="select-custom">
                                        <label>Country / Region
                                            <abbr class="required" title="required">*</abbr></label>
                                        <select name="orderby" class="form-control">
                                            <option value="" selected="selected">Vanuatu
                                            </option>
                                            <option value="1">Brunei</option>
                                            <option value="2">Bulgaria</option>
                                            <option value="3">Burkina Faso</option>
                                            <option value="4">Burundi</option>
                                            <option value="5">Cameroon</option>
                                        </select>
                                    </div> -->
                                <div class="form-group">
                                    <label>Email address
                                        <abbr class="required" title="">*</abbr></label>
                                    <input value="<?php echo $user['email'] ?>" name="email" type="email" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label>Phone <abbr class="required" title="">*</abbr></label>
                                    <input name="phone" type="tel" class="form-control" required />
                                </div>

                                <div class="form-group mb-1 pb-2">
                                    <label>Street address
                                        <abbr class="required" title="">*</abbr></label>
                                    <input required name="address" type="text" class="form-control" placeholder="House number and street name" />
                                </div>

                                <!-- <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Apartment, suite, unite, etc. (optional)" required />
                                    </div> -->

                                <!-- <div class="form-group">
                                        <label>Town / City
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control" required />
                                    </div> -->

                                <!-- <div class="select-custom">
                                        <label>State / County <abbr class="required" title="required">*</abbr></label>
                                        <select name="orderby" class="form-control">
                                            <option value="" selected="selected">NY</option>
                                            <option value="1">Brunei</option>
                                            <option value="2">Bulgaria</option>
                                            <option value="3">Burkina Faso</option>
                                            <option value="4">Burundi</option>
                                            <option value="5">Cameroon</option>
                                        </select>
                                    </div> -->

                                <!-- <div class="form-group">
                                        <label>Postcode / Zip
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control" required />
                                    </div> -->





                                <!-- <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create-account" />
                                            <label class="custom-control-label" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree" for="create-account">Create an
                                                account?</label>
                                        </div>
                                    </div>

                                    <div id="collapseThree" class="collapse">
                                        <div class="form-group">
                                            <label>Create account password
                                                <abbr class="required" title="required">*</abbr></label>
                                            <input type="password" placeholder="Password" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mt-0">
                                            <input type="checkbox" class="custom-control-input" id="different-shipping" />
                                            <label class="custom-control-label" data-toggle="collapse" data-target="#collapseFour" aria-controls="collapseFour" for="different-shipping">Ship to a
                                                different
                                                address?</label>


                                        </div>
                                    </div> -->

                                <!-- <div id="collapseFour" class="collapse">
                                <div class="shipping-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First name <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last name <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Company name (optional)</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="select-custom">
                                        <label>Country / Region <span class="required">*</span></label>
                                        <select name="orderby" class="form-control">
                                            <option value="" selected="selected">Vanuatu</option>
                                            <option value="1">Brunei</option>
                                            <option value="2">Bulgaria</option>
                                            <option value="3">Burkina Faso</option>
                                            <option value="4">Burundi</option>
                                            <option value="5">Cameroon</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1 pb-2">
                                                <label>Street address <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" class="form-control" placeholder="House number and street name" required />
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Town / City <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" class="form-control" required />
                                            </div>

                                            <div class="select-custom">
                                                <label>State / County <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <select name="orderby" class="form-control">
                                                    <option value="" selected="selected">NY</option>
                                                    <option value="1">Brunei</option>
                                                    <option value="2">Bulgaria</option>
                                                    <option value="3">Burkina Faso</option>
                                                    <option value="4">Burundi</option>
                                                    <option value="5">Cameroon</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Postcode / ZIP <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" class="form-control" required />
                                            </div> 
                                </div>
                            </div> -->

                                <div class="form-group">
                                    <label class="order-comments">Order notes (optional)</label>
                                    <textarea name="note" class="form-control" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>YOUR ORDER</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_price = 0; ?>
                                    <?php foreach ($cart as $key => $value) {
                                        $total_price += ($value['price'] * $value['quantity']);
                                    ?>
                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    <?php echo $value['name'] ?> ×
                                                    <span class="product-qty"><?php echo $value['quantity'] ?> x <?php echo number_format($value['price'])  ?> VĐN</span>
                                                </h3>
                                            </td>

                                            <td class="price-col">
                                                <span><?php echo number_format($value['quantity'] * $value['price']) ?> VNĐ</span>
                                            </td>
                                        </tr>
                                    <?php } ?>



                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Subtotal</h4>
                                        </td>

                                        <td class="price-col">
                                            <span><?php echo number_format($total_price) ?> VNĐ</span>
                                        </td>
                                    </tr>
                                    <tr class="order-shipping">
                                        <td class="text-left" colspan="2">
                                            <h4 class="m-b-sm">Shipping</h4>

                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" class="custom-control-input" name="radio" checked />
                                                    <label class="custom-control-label">Local Pickup</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->

                                            <div class="form-group form-group-custom-control mb-0">
                                                <div class="custom-control custom-radio d-flex mb-0">
                                                    <input type="radio" name="radio" class="custom-control-input">
                                                    <label class="custom-control-label">Flat Rate</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->
                                        </td>

                                    </tr>

                                    <tr class="order-total">
                                        <td>
                                            <h4>Ship Total + 30,000 VNĐ</h4>
                                        </td>
                                        <td>
                                            <b class="total-price"><span><?php echo number_format($total_price + 30000) ?> VNĐ</span></b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="payment-methods">
                                <h4 class="">Payment methods</h4>
                                <div class="info-box with-icon p-0">
                                    <p>
                                        Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.
                                    </p>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark btn-place-order">
                                Place order
                            </button>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
                <!-- End .row -->
            </div>
        </form>
    <?php } else { ?>


        <div style="text-align: center;" class="alert alert-warning alert-dismissible fade show" role="alert">

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
                <strong>Vui lòng đăng nhập để mua hàng</strong> <a class="btn btn-global" href="login.php?action=check-out">Login</a>
            </div>
        </div>
    <?php } ?>
    <!-- End .container -->
</main>
<!-- End .main -->

<?php include '../Client/footer.php' ?>