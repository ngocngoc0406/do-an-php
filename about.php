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
   <title>Giới thiệu</title>

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

      <div class="heading">
         <h3>Về chúng tôi</h3>
         <p><a href="home.php">Trang chủ </a> <span> / GIới thiệu</span></p>
      </div>

      <section class="about">

         <div class="row">

            <div class="image">
               <img src="images/about.png" alt="">
            </div>

            <div class="content">
               <h3>Tại sao chọn chúng tôi ?</h3>
               <p>Tại đây chúng tôi luôn mang đến những sản phẩm và những câu chuyện về người khiếm thị. Chúng tôi hiểu được và đồng cảm với những 
                  gì mà người khiếm thị đang gặp phải. Sản phẩm của chúng tôi cam kết đảm bảo chất lượng, giá thành tốt nhất. Và nơi bạn có thể liên hệ
                  để đi cùng chúng tôi giúp đỡ người khiếm thị.
               </p>
               <a href="menu.php" class="btn">Sản phẩm của chúng tôi  </a>
            </div>

         </div>

      </section>

      <section class="steps">

         <h1 class="title">3 cam kết</h1>

         <div class="box-container">

            <div class="box">
               <img src="images/step-1.png" alt="">
               <h3>Uy tín</h3>
               <p> Chúng tôi cam kết 100% lợi nhuận sẽ được quyên góp vào quỹ hỗ trợ người khiếm thị</p>
            </div>

            <div class="box">
               <img src="images/step-2.png" alt="">
               <h3>Giao hàng nhanh chóng</h3>
               <p>Sản phẩm sẽ đến tay người dùng trong vòng 3-4 ngày</p>
            </div>

            <div class="box">
               <img src="images/step-3.png" alt="">
               <h3>Chất lượng</h3>
               <P>Cam kết mang đến sản phẩm tốt nhất</P>
            </div>

         </div>

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

      <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

      <script src="js/script.js"></script>


   </body>

</html>