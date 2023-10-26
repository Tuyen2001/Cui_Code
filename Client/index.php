<?php
include '../Client/header.php';
// include '../Admin/connect.php';
$category = mysqli_query($conn, "SELECT * FROM category WHERE status =1");
$producthot = mysqli_query($conn, "SELECT * FROM product WHERE status =1 ORDER BY id DESC LIMIT 3");
$product = mysqli_query($conn, "SELECT product.*,
    category.name AS 'cate_pro_name' FROM product JOIN category
    ON product.id_category=category.id   ");
// phân trang danh mục sp
// bước1 lấy tất cả các bản ghi co trong category
$total = mysqli_num_rows($product);
// bước 2 lập số bản ghi trên 1 trang
$limit = 9;
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
?>
<main class="main">
    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
            <div class="container position-relative">
                <div class="row">
                    <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1">
                        <h3>Electronic<br>Deals</h3>
                        <a href="category.html" class="btn btn-dark">Get Yours!</a>
                    </div>
                    <div class="pl-lg-3 col-sm-4 offset-sm-0 offset-1 pt-3">
                        <div class="coupon-sale-content">
                            <h4 class="m-b-1 coupon-sale-text bg-white text-transform-none">Exclusive COUPON
                            </h4>
                            <h5 class="mb-2 coupon-sale-text d-block ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-dark">$100</b> OFF</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Men</a></li>
                <li class="breadcrumb-item active" aria-current="page">Accessories</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9 main-content">
                <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                    <div class="toolbox-left">
                        <a href="#" class="sidebar-toggle">
                            <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                            </svg>
                            <span>Filter</span>
                        </a>

                        <div class="toolbox-item toolbox-sort">
                            <label>Sort By:</label>

                            <div class="select-custom">
                                <select name="orderby" class="form-control">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->


                        </div>
                        <!-- End .toolbox-item -->
                    </div>
                    <!-- End .toolbox-left -->

                    <div class="toolbox-right">
                        <!-- <div class="toolbox-item toolbox-show">
                            <label>Show: <?php echo $start ?></label>

                            <div class="select-custom">
                                <select name="count" class="form-control">
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                </select>
                            </div>
                          
                        </div> -->
                        <!-- End .toolbox-item -->

                        <div class="toolbox-item layout-modes">
                            <?php if ($cr_page - 1 > 0) { ?>
                                <a href="index.php?page=<?php echo $cr_page - 1 ?>" class="layout-btn btn-grid active" title="Grid">
                                    &laquo; <i class="icon-mode-grid"></i>
                                </a>
                            <?php } ?>
                            <?php if ($cr_page + 1 <= $page) { ?>
                                <a href="index.php?page=<?php echo $cr_page + 1 ?>" class="layout-btn btn-list" title="List">
                                    &raquo; <i class="icon-mode-list"></i>
                                </a>
                            <?php } ?>
                        </div>
                        <!-- End .layout-modes -->
                    </div>
                    <!-- End .toolbox-right -->
                </nav>

                <div class="row">
                    <?php foreach ($product as $key => $value) { ?>
                        <div class="col-6 col-sm-4">
                            <div class="product-default">
                                <figure>

                                    <a href="product-detail.php?sp=<?php echo $value['slug'] ?>">
                                        <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" width="280" height="280" alt="product" style="50px" />

                                    </a>

                                    <div class="label-group">
                                        <div class="product-label label-hot">HOT</div>
                                        <div class="product-label label-sale"><?php echo ceil(100 - (($value['sale_price'] / $value['price']) * 100))    ?>%</div>
                                    </div>
                                </figure>

                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="category.html" class="product-category"><?php echo $value['cate_pro_name'] ?></a>
                                        </div>
                                    </div>

                                    <h3 class="product-title"> <a href="product.html"><?php echo $value['name'] ?></a> </h3>

                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->

                                    <div class="price-box">
                                        <span class="old-price"><?php echo number_format($value['price']) ?> VND</span>
                                        <span class="product-price"><?php echo number_format($value['sale_price']) ?> VND</span>
                                    </div>
                                    <!-- End .price-box -->

                                    <div class="product-action">
                                        <a href="product-detail.php?sp=<?php echo $value['slug'] ?>" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                        <a href="cart.php?id=<?php echo $value['id'] ?>" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></a>
                                        <a href="product-detail.php?sp=<?php echo $value['slug'] ?>"><i class="fas fa-external-link-alt"></i></a>
                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                    <?php } ?>

                    <!-- End .col-sm-4 -->





                    <!-- End .col-sm-4 -->
                </div>
                <!-- End .row -->

                <nav class="toolbox toolbox-pagination">
                    <!-- <div class="toolbox-item toolbox-show">
                        <label>Show: <?php echo ($start) ?></label>

                        <div class="select-custom">
                            <select name="count" class="form-control">
                                <option value="12">12</option>
                                <option value="24">24</option>
                                <option value="36">36</option>
                            </select>
                        </div>

                    </div> -->


                    <ul class="pagination">
                        <?php if ($cr_page - 1 > 0) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $cr_page - 1 ?>">&laquo;</a>
                            </li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                            <li class="<?php echo (($cr_page == $i) ? 'active' : '') ?> page-item">
                                <a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <?php if ($cr_page + 1 <= $page) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $cr_page + 1 ?>">&raquo;</a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- <nav aria-label="Page navigation example">

                </nav> -->
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Categories</a>
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    <li>

                                        <div class="collapse show" id="widget-category-1">
                                            <ul class="cat-sublist">
                                                <?php foreach ($category as $key => $value) { ?>
                                                    <li><?php echo $value['name'] ?><span class="products-count"></span></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body pb-0">
                                <form action="#">
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div>
                                        <!-- End #price-slider -->
                                    </div>
                                    <!-- End .price-slider-wrapper -->

                                    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text">
                                            Price:
                                            <span id="filter-price-range"></span>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <!-- End .filter-price-action -->
                                </form>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->


                    <!-- End .widget -->


                    <!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Featured</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">

                                <div class="featured-col">
                                    <?php foreach ($producthot as $key => $value) { ?>
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="product-detail.php?sp=<?php echo $value['slug'] ?>">
                                                    <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" width="75" height="75" alt="product" />
                                                    <img src="../Admin/Product/uploads/<?php echo $value['image'] ?>" width="75" height="75" alt="product" />
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a href="product.html"><?php echo $value['name'] ?></a> </h3>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price"><?php echo $value['sale_price'] ?> VNĐ</span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- End .featured-col -->


                                <!-- End .featured-col -->
                            </div>
                            <!-- End .widget-featured-slider -->
                        </div>
                        <!-- End .widget-body -->
                    </div>

                    <!-- End .widget -->

                    <div class="widget widget-block">
                        <h3 class="widget-title">Custom HTML Block</h3>
                        <h5>This is a custom sub-title.</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus </p>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->

    <div class="mb-4"></div>
    <!-- margin -->
</main>
<!-- End .main -->


<?php
include '../Client/footer.php'

?>