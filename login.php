<?php
session_start();
require 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
      <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/3411/premium/3411447.png?token=exp=1655746654~hmac=a6a84ab5985010f032dc53a0f937687d">

</head>
<body>
   
<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">HOPE</a>

      <nav class="navbar">
         <a href="home.php">Trang chủ</a>
         <a href="about.php">Giới thiệu</a>
         <a href="menu.php">Sản phẩm</a>
         <a href="story.php">Câu chuyện</a>
         <a href="contact.php">Liên hệ</a>
      </nav>

      <div class="icons">
         <a href="search.php?timkiem="><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(0)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <?php
         if(empty($_SESSION['member'])):?>
            <div class="profile">
         <p class="account"><a href="login.php" ><img src="https://img.icons8.com/sf-regular-filled/48/000000/login-rounded-right.png" width="30px"/>Đăng nhập</a>
                hoặc
             <a href="register.php"><img src="https://img.icons8.com/external-glyph-geotatah/64/000000/external-register-training-management-system-glyph-glyph-geotatah.png" width="30px"/>Đăng kí </a>
         </p>
         </div>

         <?php else:?>
      <div class="profile">
         <p class="name">
         <?=$_SESSION['member']?>
         </p>
         <div class="flex">
            <a href="profile.php" class="btn">Hồ sơ</a>
            <a href="logout.php" class="delete-btn">Đăng xuất</a>
            </div>
        <?php endif;?>
      </div>

   </section>

</header>

<section class="form-container">

<?php
         if($_POST)
         {
            $user_name=$_POST['user_name'];
            $user_pass=md5($_POST['user_pass']);
            $result=mysqli_query($connect, "SELECT * from customerr where email='$user_name' and password='$user_pass' ");
            $row=mysqli_fetch_assoc($result);
            if(isset($row))
            {
               if($row['status']==0)
            {
               echo '<script language="javascript">alert("Tài khoản đã bị khóa!!!"); window.location="login.php";</script>';
            }else{
            if($row['decentralize']==0)
            {
               $_SESSION['decentralize']  = $row['decentralize'];
               $_SESSION['pass']   =$row['password'];
               $_SESSION['member'] =$row['CustomerName'];
               $_SESSION['hphone'] =$row['phone'];
               $_SESSION['hemail'] =$row['email'];
               $_SESSION['id']     =$row['CustomerID'];
               $_SESSION['cprovince'] =$row['province'];
               $_SESSION['cdistrict'] =$row['district'];
               $_SESSION['commune'] =$row['commune'];
               $_SESSION["IDquantityCart"] =$row['quantityCart'];
               echo '<script language="javascript">alert("Tài khoản đã đăng nhập vào trang quản lý!!!"); window.location="admin/taikhoan/taikhoan.php";</script>';
            }else{
               $_SESSION['pass']   =$row['password'];
               $_SESSION['member'] =$row['CustomerName'];
               $_SESSION['hphone'] =$row['phone'];
               $_SESSION['hemail'] =$row['email'];
               $_SESSION['id']     =$row['CustomerID'];
               $_SESSION['cprovince'] =$row['province'];
               $_SESSION['cdistrict'] =$row['district'];
               $_SESSION['commune'] =$row['commune'];
               $_SESSION["IDquantityCart"] =$row['quantityCart'];
               
                echo'<script language="javascript">alert("Đăng nhập thành công!!!"); window.location="home.php";</script>';
               // header("Location:home.php");
            }
            }
         }
            else{
            ?>
           
            <form action="" method="post">
            <?php   echo' <h3><p style="color:red">Lỗi: Tên đăng nhập hoặc mật khẩu không đúng!</p></h3> ' ;}?>
              <?php }?>

       <?php if(!isset($row)){?>
      <form action="" method="post">
      <h3>Đăng nhập ngay</h3><?php } ?>
      
      <input type="email" required maxlength="50" name="user_name" placeholder="Nhập email của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" required maxlength="20" name="user_pass" placeholder="Nhập mật khẩu của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Đăng nhập" class="btn" name="submit">
      <p><a href="register.php" style="margin-right: 10px;">Đăng kí tài khoản? </a><a href="forgotpass.php" style="margin-left: 10px;color:RGB(103, 89, 74)">Quên mật khẩu?</a></p>
      
   </form>

</section>




<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>Khiếm thị </h3>
         <p>Các trang mạng xã hội bạn có thể tìm hiểu về chúng tôi thông tin liên lạc</p>
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
      </div>

      <div class="box">
         <h3>Thông tin liên lạc</h3>
         <a href="#" class="links"> <i class="fas fa-phone"></i> +123-456-7890 </a>
         <a href="#" class="links"> <i class="fas fa-phone"></i> +111-222-3333 </a>
         <a href="#" class="links"> <i class="fas fa-envelope"></i> hope@gmail.com </a>
         <a href="#" class="links"> <i class="fas fa-map-marker-alt"></i> Da Nang, VietNam</a>
      </div>

      <div class="box">
         <h3>Đường dẫn nhanh</h3>
         <a href="#" class="links"> <i class="fas fa-arrow-right"></i> Trang chủ </a>
         <a href="#" class="links"> <i class="fas fa-arrow-right"></i> Giới thiệu </a>
         <a href="#" class="links"> <i class="fas fa-arrow-right"></i> Sản phẩm </a>
         <a href="#" class="links"> <i class="fas fa-arrow-right"></i> Câu chuyện </a>
         <a href="#" class="links"> <i class="fas fa-arrow-right"></i> Liên hệ </a>

      </div>

      <div class="box">
         <h3>Nhận thông báo</h3>
         <p>Đăng ký để cập nhật mới nhất</p>
         <input type="email" placeholder="Email của bạn" class="email">
         <input type="submit" value="Đăng ký" class="btn1">
         <img src="image/payment.png" class="payment-img" alt="">
      </div>


   </div>

</section>


<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>