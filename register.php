<?php
require 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Đăng ký</title>

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
         <?php if(isset($_SESSION['decentralize'])){?>
         <a href="admin/taikhoan/taikhoan.php">Admin</a>
         <?php }?>
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
           
            <a href="order_tracking.php" class="btn" style="font-size: 10px;font-weight: bold;">Theo dõi đơn hàng</a>

        <?php endif;?>
      </div>

   </section>

</header>

      
      <section class="form-container">

      <?php if(isset($_POST['submit']))
      {
         $name=$_POST['name'];
         $user_name=$_POST['user_name'];
         $phone_number=$_POST['phone_number'];
         $user_pass=md5($_POST['user_pass']);

         $sql = "SELECT * FROM customerr WHERE phone = '$phone_number' OR email = '$user_name'";  
         // Thực thi câu truy vấn
         $result = mysqli_query($connect, $sql);
      
         // Nếu kết quả trả về lớn hơn 0 thì nghĩa là phone hoặc email đã tồn tại trong CSDL
         if (mysqli_num_rows($result) > 0)
         {
            // Sử dụng javascript để thông báo
            echo '<script language="javascript">alert("SĐT hoặc email đăng kí đã tồn tại"); window.location="register.php";</script>';
               
            // Dừng chương trình
            die ();
         }
         else {
         if(!empty($name)&&!empty($user_name)&&!empty($phone_number)&&!empty($user_pass))
         {
            echo"<pre>";
            print_r($_POST);

            $sql="INSERT INTO `customerr`(`CustomerName`,`email`,`phone`,`password`) VALUE('$name','$user_name','$phone_number','$user_pass')";

            if($connect->query($sql)==true)
            {
               
               echo '<script language="javascript">alert("Đăng kí thành công!!!"); window.location="login.php";</script>';
            //header("location:login.php");
            
            }else{
               echo "Lỗi {$sql}".$connect->error;
            }
         }else echo "Bạn cần nhập đầy đủ thông tin!";


      }
   }
         ?>

         
         <form action="" method="post" onsubmit="if(repass.value!=user_pass.value){alert('Điền lại mật khẩu không khớp');return false;}"
         >
            <h3>Đăng ký ngay bây giờ</h3>
            <input type="text" required maxlength="100" name="name" placeholder="Nhập tên của bạn" class="box"
              >
            <input type="email" required maxlength="100" name="user_name" placeholder="Nhập email của bạn" class="box"
                >
            <input type="number" required pattern="0\d{9}" onkeypress="if(this.value.length == 10) return false;"
               placeholder="Nhập số điện thoại" required class="box" name="phone_number">
            <input type="password" required maxlength="50" name="user_pass" placeholder="Nhập mật khẩu" class="box"
              >
            <input type="password" required maxlength="50" name="repass" placeholder="Xác minh mật khẩu" class="box"
              >
            <input type="submit" value="Đăng kí" class="btn" name="submit">
            <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
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
         <a href="#" class="links"> <i class="fas fa-envelope"></i> khiemthi@gmail.com </a>
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