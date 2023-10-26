<?php
ob_start(); 
include '../Client/header.php';
include('../Admin/connect.php');

$err = [];
// var_dump($_SESSION['action']);
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql =  "SELECT * FROM user WHERE email = '$email'  ";
    // 

    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
    $check = mysqli_num_rows($query);
    if (empty($email)) {
        $err['email'] = 'Bạn chưa nhập đúng email';
    }
    if (empty($password)) {
        $err['password'] = 'Bạn chưa nhập đúng mật khẩu';
    }
    if ($check == 1) {
        $checkPass = $data['password'];
        if ($checkPass) {
            $_SESSION['user'] = $data;
            if (isset($_GET['action'])) {
                // lưu vào session
                $action = $_GET['action'];
                header('location: '.$action.'.php');
            } else {
                header('location: index.php');
            }
            
        }
    }
}
// --------------------------------------

// if (isset($_POST['email'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $sql = "SELECT * FROM user WHERE email = '$email' and password ='$password' ";
//     $query = mysqli_query($conn, $sql);
//     $data = mysqli_fetch_assoc($query);
//     $checkEmail = mysqli_num_rows($query);
//     if(empty($email)) {
//         $err['email'] = 'Bạn chưa nhập đúng email';
//     }
//     if(empty($password)) {
//         $err['password'] = 'Bạn chưa nhập đúng mật khẩu';
//     }
//     if($checkEmail == 1){
//         $checkPass = password_verify($password, $data['password']);
//         if($checkPass){

//             // lưu vào session
//             $_SESSION['user'] = $data;
//             if(isset($_GET['action'])){
//                 $action = $_GET['action'];
//             header('location: '.$action.'.php');
//             }else{
//                 header('location: index.php');

//             }

//         }else{
//             echo 'Sai mật khẩu';
//         }
//     }
//     else{
//         echo 'Email không tồn tại';
//     }
// }

ob_end_flush();
?>
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="category.html">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            My Account
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>My Account</h1>
        </div>
    </div>

    <div class="container login-container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="heading mb-1">
                            <h2 class="title">Login</h2>


                        </div>

                        <form action="" method="POST">
                           
                            <label for="login-email">
                                Email address
                                <span class="required">*</span>
                            </label>
                            <input name="email" type="email" class="form-input form-wide" id="login-email" required />

                            <label for="login-password">
                                Password
                                <span class="required">*</span>
                            </label>
                            <input name="password" type="password" class="form-input form-wide" id="login-password" required />

                            <div class="form-footer">
                                <div class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" class="custom-control-input" id="lost-password" />
                                    <label class="custom-control-label mb-0" for="lost-password">Remember
                                        me</label>
                                </div>

                                <a href="forgot-password.html"
                                    class="forget-password text-dark form-footer-right">Forgot
                                    Password?</a>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md w-100 mb-2">
                                LOGIN
                            </button>
                            <a href="register.php" class="btn btn-primary btn-md w-100">Register</a>
                        </form>
                    </div>
                     <!-- <div class="col-md-6">
                        <div class="heading mb-1">
                            <h2 class="title">Register</h2>
                        </div>

                        <form action="#">
                            <label for="register-email">
                                Email address
                                <span class="required">*</span>
                            </label>
                            <input type="email" class="form-input form-wide" id="register-email" required />

                            <label for="register-password">
                                Password
                                <span class="required">*</span>
                            </label>
                            <input type="password" class="form-input form-wide" id="register-password"
                                required />

                            <div class="form-footer mb-2">
                                <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>  -->
                </div>
            </div>
        </div>
    </div>
</main><!-- End .main -->

<?php include '../Client/footer.php';  ?>