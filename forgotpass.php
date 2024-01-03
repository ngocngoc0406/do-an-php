<?php 
session_start();
require_once("function.php");
$function =new RepositoryFunction();
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -50px;
}
</style>

<?php
 if(isset($_POST['submit']))
{
    $email_forgotpass=$_POST['email'];
    $sql = "SELECT * FROM customerr WHERE email = '$email_forgotpass'";  
    // Thực thi câu truy vấn
    $result = mysqli_query($connect, $sql);
 
    // Nếu kết quả trả về lớn hơn 0 thì nghĩa là email đã tồn tại trong CSDL
    if (mysqli_num_rows($result) >0)
    {
        $newpass=$function->randomPass();
        $function ->GuiMail('Mật khẩu mới của bạn','New password: '.$newpass,$email_forgotpass);
        $mahoaNewPass=md5($newpass);
        $result = mysqli_query($connect, "UPDATE `customerr` SET `password` = '$mahoaNewPass' WHERE `email` LIKE '$email_forgotpass';");
    }else{
        echo '<script language="javascript">alert("Email chưa đăng kí tài khoản");</script>';
    }
    
    
} ?>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Forgot password?</h3>
        <form action=""method="post">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Quên mật khẩu?</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email của bạn">
                            </div>
                            <!-- <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Gửi">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="home.php" class="text-info">Quay lại trang chủ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</body>
