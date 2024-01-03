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
   <title>Theo dõi đơn hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
      <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/3411/premium/3411447.png?token=exp=1655746654~hmac=a6a84ab5985010f032dc53a0f937687d">

<style>
    .button_chitiet{
        border:1px solid RGB(0, 191, 165);
        font-size: 12px;
        background-color: RGB(0, 191, 165);
        color: white;
        padding: 5px 5px;
        font-weight: bold;
    }
</style>
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
         <a href="search.php"><i class="fas fa-search"></i></a>
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
<?php $result= mysqli_query($connect, "SELECT * FROM `order` WHERE `customer_id` = ".$_SESSION['id']."");?>
<div class="heading">
   <h3>Theo dõi đơn hàng</h3>
   <p><a href="home.php">Trang chủ </a> <span> / Theo dõi đơn hàng</span></p>
</div>

<section class="contact">

   <div class="row">

      <!-- <div class="image">
         <img src="images/contact.png" alt="">
      </div> -->
      <form action="" method="post">
         <?php if(!empty($result)) {?>
         <!-- <h3>Đơn hàng của bạn</h3> -->
         <table class="table" style="font-size: 16px;">
  <thead class="thead-dark">
    <tr>
        
        <th scope="col">STT</th>
        <th scope="col">Mã đơn hàng</th>
        <th scope="col">Họ và tên</th>
        <th scope="col">Số điện thoại</th>
        <th scope="col">Tỉnh/Thành phố</th>
        <th scope="col">Quận/Huyện</th>
        <th scope="col">Xã/Phường</th>
        <th scope="col">Ghi chú</th>
        <th scope="col">Đơn giá</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Hành động</td>
    </tr>
  </thead>
  <tbody >
  <?php 
    $stt=1;
   while($row=mysqli_fetch_array($result)){
   ?>
    <tr>
      <th scope="row"><?=$stt++?></th>
              <td><?=$row['id']?></td>
              <td><?=$row['name']?></td>
              <td><?=$row['phone']?></td>
              <td><?=$row['province']?></td>
              <td><?=$row['district']?></td>
              <td><?=$row['commune']?></td>
              <td><?=$row['note']?></td>
              <td><?=$row['total_price']?> <sup style="font-weight: bold;">$</sup></td>
              <td><?php 
              if($row['status']==0) {
               echo "<p style='color:red;font-weight:bold'>Chưa duyệt</p>";
            } else {
               echo "<p style='color:RGB(0, 191, 165);font-weight:bold'>Đã duyệt</p>";
               }?></td>
              <td ><a href="o_tracking_detail.php?id=<?php echo $row['id']; ?>" type="button"class="button_chitiet">Chi tiết</a></td>
              
          <?php }?>
        
    </tr>
  </tbody>
   </table>

   </div>
<?php }?>

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