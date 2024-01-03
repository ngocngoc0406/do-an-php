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
   <title>Cập nhật hồ sơ</title>

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
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php if(isset($_SESSION["IDquantityCart"])){
                                                                              $total= (strlen($_SESSION["IDquantityCart"])+1)/2 ;
                                                                              echo $total;
                                                                           }else{
                                                                           if(!empty($_SESSION["cart"]))
                                                                        {
                                                                           echo count($_SESSION["cart"]);
                                                                        }
                                                                        else echo '0';}?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <?php
         if(empty($_SESSION['member'])):?>
            <div class="profile">
         <p class="account"><a href="login.php">Đăng nhập</a> hoặc <a href="register.php">Đăng kí </a></p>
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
<?php if(isset($_POST['submit']))
      {
         $password=md5($_POST['old_pass']);
         $new_password=md5($_POST['new_pass']);
         
         if($password == $_SESSION['pass'])
         {
         
         if(!empty($password)&&!empty($new_password))
          {
            // echo"<pre>";
            // print_r($_POST);a
            $id=$_SESSION['id'];
            
            $sql="update customerr set password='$new_password'where customerID ='$id'";

            if($connect->query($sql)==true)
            {
               sleep(1);
               
               echo '<script language="javascript">alert("Cập nhật thành công!!!"); window.location="logout.php";</script>';
               
              
             }else echo "Bạn cần nhập đầy đủ thông tin!";}

         }else echo '<script language="javascript">alert("Lỗi:Mật khẩu cũ không đúng!!!"); window.location="update_profile.php";</script>';

      }
         ?> 
<section class="form-container">

   <form action="" method="POST" onsubmit="if(confirm_pass.value!=new_pass.value){alert('Điền lại mật khẩu không khớp');return false;}">
      <h3>Cập nhật hồ sơ</h3>
      <input type="text" required maxlength="20" name="name" placeholder="Nhập tên của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?=$_SESSION['member']?>" disabled>

      <input type="email" required maxlength="50" name="email" placeholder="Nhập email của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?=$_SESSION['hemail']?>" disabled>
      <input type="number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" placeholder="Nhập sdt của bạn" required class="box" name="number" value="<?=$_SESSION['hphone']?>" disabled>



      <input type="password" maxlength="20" name="old_pass" placeholder="Nhập mật khẩu cũ" class="box">
      <input type="password" maxlength="20" name="new_pass" placeholder="Nhập mật khẩ mới" class="box" >
      <input type="password" maxlength="20" name="confirm_pass" placeholder="Xác minh mật khẩu mới" class="box">
      <input type="submit" value="Cập nhật" class="btn" name="submit">
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