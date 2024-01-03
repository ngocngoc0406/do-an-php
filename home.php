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
   <title>Trang chủ</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
   <!-- ?php 
   if(isset($_GET['option']))
   {
      switch($_GET['option'])
      {
         case'logout':
            unset($_SESSION['member']);
            header("location:home.php");
      }
   }
   ?> -->

</header>

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Đặt hàng online</span>
               <h3>Mắt kính người mù </h3>
               <a href="menu.php" class="btn">Xem thêm</a>
            </div>
            <div class="image">
               <img src="images/home-img-1.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Đặt hàng online</span>
               <h3>Gậy chỉ đường</h3>
               <a href="menu.php" class="btn">Xem thêm</a>
            </div>
            <div class="image">
               <img src="images/home-img-2.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Đặt hàng online</span>
               <h3>Sách cho người khiếm thị</h3>
               <a href="menu.php" class="btn">Xem thêm</a>
            </div>
            <div class="image">
               <img src="images/home-img-3.jpg" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- ============================================================================================================================================== -->

<section class="products">

   <h1 class="title">Sản phẩm tiêu biểu</h1>

   <div class="box-container">

   <?php 
   // $mang=array();
   // $sum_quantityProduct=mysqli_query($connect,"SELECT SUM(quantity) as totalPro,productID FROM  order_detail  WHERE productID =2;");
   // $col=mysqli_fetch_array($sum_quantityProduct);
   $product=mysqli_query($connect,"SELECT DISTINCT(p.productID),p.* FROM `product_menu` p left join order_detail o on p.productID=o.productID WHERE o.id>0;");
   while($row=mysqli_fetch_array($product)){
     // $mang[]=$row;
      $sum_quantityProduct=mysqli_query($connect,"SELECT SUM(quantity) as totalPro FROM  order_detail  WHERE productID =".$row['productID'].";");
      $col=mysqli_fetch_array($sum_quantityProduct);
      //$_SESSION["sum_quantityProduct"][$col['productID']]=$col['totalPro'];
      if($col['totalPro']>10){
?>
   
      <form accept="" method="post" class="box">
         <a href="detail_prod.php?id=<?=$row['productID']?>" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/<?=$row['image']?>" alt="">
         <a href="category.html" class="cat"><?=$row['productCode']?></a>
         <div class="name"><?=$row['productName']?></div>
         <div class="flex">
            <div class="price"><span>$</span><?=$row['price']?><span>/-</span></div>
            <input style="padding-right:10px;" type="number" name="qty" class="qty" min="1"value="1" disabled>
         </div>
      </form>
<?php }}?>
   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
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



</footer>















<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   grabCursor:true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>