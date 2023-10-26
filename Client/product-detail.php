<?php
include '../Admin/connect.php';
include '../Client/header.php';
include '../cartFunction.php';
if (isset($_GET['sp'])) {
    $slug = $_GET['sp'];
    $product = mysqli_query($conn, "SELECT * FROM product 
        WHERE slug = '$slug' ");
    $data = mysqli_fetch_assoc($product);
    // var_dump($data);

}
$images = mysqli_query($conn, "SELECT img_product.*,
product.image AS 'imgs_pro' FROM product JOIN img_product
ON product.id=img_product.id_product  ");
// $images = mysqli_query($conn,"SELECT img_product.* WHERE product.id=img_product.id_product");
 
// các sản phẩm gần đây sắp xếp theo id
$product_Related = mysqli_query($conn, "SELECT product.*,
    category.name AS 'cate_pro_name' FROM product JOIN category
    ON product.id_category=category.id WHERE product.status =1 ORDER BY id DESC LIMIT 5   ");

// // cacs sản phẩm theo danh mục sp
//  $product_ao = mysqli_query($conn,"SELECT * FROM product WHERE id_category.product = category.id");
?>



<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">“<?php echo $data['name']  ?>”</strong>
                <span>has been added to your cart.</span>
            </div>
            <form method="get" action="cart.php">
                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>

                                <div class="product-label label-sale">
                                    <?php echo ceil(100 - (($data['sale_price'] / $data['price']) * 100))    ?>%
                                </div>
                            </div>

                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                <div class="product-item">
                                    <img class="product-single-image" src="../Admin/Product/uploads/<?php echo $data['image'] ?>" data-zoom-image="../Admin/Product/uploads/<?php echo $data['image'] ?>" width="468" height="468" alt="product" />
                                </div>




                            </div>
                            <!-- End .product-single-carousel -->
                            <span class="prod-full-screen">
                                <i class="icon-plus"></i>
                            </span>
                        </div>

                        <div class="prod-thumbnail owl-dots">
                            <?php foreach ($images as $key => $value2) { ?>
                                <div class="owl-dot">
                                    <img src="../Admin/Product/uploads/<?php echo $value2['imgs_pro'] ?>" width="110" height="110" alt="product-thumbnail" />
                                </div>
                            <?php   } ?>

                            <!-- <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-2.jpg" width="110" height="110" alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-3.jpg" width="110" height="110" alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-4.jpg" width="110" height="110" alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-5.jpg" width="110" height="110" alt="product-thumbnail" />
                            </div> -->
                        </div>
                    </div>
                    <!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title"><?php echo $data['slug']  ?></h1>

                        <div class="product-nav">
                            <div class="product-prev">
                                <a href="#">
                                    <span class="product-link"></span>

                                    <span class="product-popup">
                                        <span class="box-content">
                                            <img alt="product" width="150" height="150" src="assets/images/products/product-3.jpg" style="padding-top: 0px;">

                                            <span>Circled Ultimate 3D Speaker</span>
                                        </span>
                                    </span>
                                </a>
                            </div>

                            <div class="product-next">
                                <a href="#">
                                    <span class="product-link"></span>

                                    <span class="product-popup">
                                        <span class="box-content">
                                            <img alt="product" width="150" height="150" src="assets/images/products/product-4.jpg" style="padding-top: 0px;">

                                            <span>Blue Backpack for the Young</span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:60%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->

                            <a href="#" class="rating-link">( 6 Reviews )</a>
                        </div>
                        <!-- End .ratings-container -->

                        <hr class="short-divider">

                        <div class="price-box">
                            <span class="old-price"></span>
                            <span class="new-price"><?php echo number_format($data['sale_price'])   ?> VND</span>
                        </div>
                        <!-- End .price-box -->

                        <div class="product-desc">

                            <?php
                            echo $data['dess']
                            ?>

                        </div>
                        <!-- End .product-desc -->

                        <ul class="single-info-list">

                            <li>
                                SKU: <strong><?php echo $data['id']  ?></strong>
                            </li>

                            <li>
                                CATEGORY: <strong><a href="#" class="product-category">Aó</a></strong>
                            </li>

                            <li>
                                TAGs: <strong><a href="#" class="product-category"><?php echo $data['slug'] ?></a></strong>,

                            </li>
                        </ul>

                        <div class="product-action">
                            <div class="product-single-qty">
                                <input name="quantity" value="1" class="horizontal-quantity form-control" type="number">
                            </div>
                            <input value="<?php echo $data['id'] ?>" name="id" type="hidden">

                            <!-- End .product-single-qty -->
                            <!-- <a href="" class="btn btn-dark add-cart mr-2">Mua ngay</a> -->



                            <button type="submit" class="btn btn-add-cart">mua ngay</button>
                            <a class="btn btn-add-cart" href="http://localhost/cui_code/client/view-cart.php">Xem giỏ hàng</a>

                        </div>
                        <!-- End .product-action -->

                        <hr class="divider mb-0 mt-0">

                        <div class="product-single-share mb-3">
                            <label class="sr-only">Share:</label>

                            <div class="social-icons mr-2">
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                                <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                                <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                            </div>
                            <!-- End .social-icons -->

                            <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Add to
                                    Wishlist</span></a>
                        </div>
                        <!-- End .product single-share -->
                    </div>
                    <!-- End .product-single-details -->
                </div>
            </form>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (1)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <?php echo $data['dess']  ?>
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                    <div class="product-size-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/images/products/single/body-shape.png" alt="body shape" width="217" height="398">
                            </div>
                            <!-- End .col-md-4 -->

                            <div class="col-md-8">
                                <table class="table table-size">
                                    <thead>
                                        <tr>
                                            <th>SIZE</th>
                                            <th>CHEST(in.)</th>
                                            <th>WAIST(in.)</th>
                                            <th>HIPS(in.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XS</td>
                                            <td>34-36</td>
                                            <td>27-29</td>
                                            <td>34.5-36.5</td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td>36-38</td>
                                            <td>29-31</td>
                                            <td>36.5-38.5</td>
                                        </tr>
                                        <tr>
                                            <td>M</td>
                                            <td>38-40</td>
                                            <td>31-33</td>
                                            <td>38.5-40.5</td>
                                        </tr>
                                        <tr>
                                            <td>L</td>
                                            <td>40-42</td>
                                            <td>33-36</td>
                                            <td>40.5-43.5</td>
                                        </tr>
                                        <tr>
                                            <td>XL</td>
                                            <td>42-45</td>
                                            <td>36-40</td>
                                            <td>43.5-47.5</td>
                                        </tr>
                                        <tr>
                                            <td>XXL</td>
                                            <td>45-48</td>
                                            <td>40-44</td>
                                            <td>47.5-51.5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-size-content -->
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            <tr>
                                <th>Weight</th>
                                <td>23 kg</td>
                            </tr>

                            <tr>
                                <th>Dimensions</th>
                                <td>12 × 24 × 35 cm</td>
                            </tr>

                            <tr>
                                <th>Color</th>
                                <td>Black, Green, Indigo</td>
                            </tr>

                            <tr>
                                <th>Size</th>
                                <td>Large, Medium, Small</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                        <div class="comment-list">
                            <div class="comments">
                                <figure class="img-thumbnail">
                                    <img src="assets/images/blog/author.jpg" alt="author" width="80" height="80">
                                </figure>

                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>

                                        <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>

                                        <span class="comment-by">
                                            <strong>Joe Doe</strong> – April 12, 2018
                                        </span>
                                    </div>

                                    <div class="comment-content">
                                        <p>Excellent.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            <form action="#" class="comment-form m-0">
                                <div class="rating-form">
                                    <label for="rating">Your rating <span class="required">*</span></label>
                                    <span class="rating-stars">
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>

                                    <select name="rating" id="rating" required="" style="display: none;">
                                        <option value="">Rate…</option>
                                        <option value="5">Perfect</option>
                                        <option value="4">Good</option>
                                        <option value="3">Average</option>
                                        <option value="2">Not that bad</option>
                                        <option value="1">Very poor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Your review <span class="required">*</span></label>
                                    <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                </div>
                                <!-- End .form-group -->


                                <div class="row">
                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <!-- End .form-group -->
                                    </div>

                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <!-- End .form-group -->
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="save-name" />
                                            <label class="custom-control-label mb-0" for="save-name">Save my
                                                name, email, and website in this browser for the next time I
                                                comment.</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                        <!-- End .add-product-review -->
                    </div>
                    <!-- End .product-reviews-content -->
                </div>
                <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                <?php foreach ($product_Related as $key => $value) { ?>
                    <div class="product-default">
                    <figure>
                        <a href="product-detail.php?sp=<?php echo $value['slug'] ?>">
                            <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" width="280" height="280" alt="product">
                            <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" width="280" height="280" alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale"><?php echo number_format(ceil(100-(($value['sale_price'] / $value['price']) *100))) ?>%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category"><?php $value['cate_pro_name'] ?></a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html"><?php $value['name'] ?></a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price"><?php echo number_format ($value['price']) ?> VNĐ</del>
                            <span class="product-price"><?php echo number_format($value['sale_price'])  ?> VNĐ</span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>
               <?php } ?>

                
            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->

        <hr class="mt-0 m-b-5" />

        
        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>
<!-- End .main -->



<?php
include '../Client/footer.php';
?>