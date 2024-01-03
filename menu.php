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
   <title>Sản phẩm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
      <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/3411/premium/3411447.png?token=exp=1655746654~hmac=a6a84ab5985010f032dc53a0f937687d">

<style>
   .phan-trang{
      text-align: center;
      font-family: arial;
      font-size: 16px;
      margin-bottom: 10px;

   }
   .phan-trang a{
      color: RGB(130, 122, 125);
      
      
   }
   /* .phan-trang strong{
      
   } */
   .phan-trang a:hover{
      color: RGB(203, 202, 206);
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
   <h3>Sản phẩm của chúng tôi</h3>
   <p><a href="home.php">Trang chủ </a> <span> / Sản phẩm</span></p>
</div>

<?php
      
      
      $category=mysqli_query($connect,"SELECT * FROM `category_menu`ORDER BY `categoryID` ASC");
      $cate_product=mysqli_query($connect,"SELECT * FROM `product_menu`ORDER BY `categoryID`and `productID` ASC");
      if(!empty($_GET['categoryID'])){
        $categoryID=$_GET['categoryID'];
      }else{
         $categoryID=0;
      }
      
   ?>
<section class="category" name="categoryID">

<h1 class="title">Danh mục sản phẩm</h1>
<form action="" method="get">
<div class="box-container">
   <?php 
   while($cate=mysqli_fetch_array($category)){
   //$_SESSION['categoryID']=$row['categoryID'];
   ?>
   <a href="menu.php?categoryID=<?=$cate['categoryID']?>" class="box">
      <img src="images/<?=$cate['images']?> " alt="Danh mục">
      <h3><?=$cate['categoryName']?></h3>
   </a>
   <?php }?>
 
</div>
</form>
</section>
<!--  -->
<section class="products">
   <div class="box-container">
   <?php 
   while($cate_prod=mysqli_fetch_array($cate_product)){
   $_SESSION['categoryID']=$cate_prod['categoryID'];
   ?>
   <?php 
   if($_SESSION['categoryID']==$categoryID){
   ?>


   
      <form accept="" method="post" class="box">
         <a href="detail_prod.php?id=<?=$cate_prod['productID']?>" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/<?=$cate_prod['image']?>" alt="">
         <a href="" class="cat"><?=$cate_prod['productCode']?></a>
         <div class="name"><?=$cate_prod['productName']?></div>
         <div class="flex">
            <div class="price"><span>$</span><?=$cate_prod['price']?><span>/-</span></div>
            <input style="padding-right:10px;" type="number" name="qty" class="qty" min="1"value="1" disabled>
         </div>
      </form>
      <?php } ?>
      <?php }?>
     


   </div>

</section>

<!--  -->

<section class="products">

   <h1 class="title">Sản phẩm mới nhất</h1>

   <div class="box-container">
<?php 
   $item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:4;
   $current_page =!empty($_GET['page'])?$_GET['page']:1;
   $offset= ($current_page-1)*$item_per_page;
   $record=mysqli_query($connect,"SELECT * FROM `product_menu`ORDER BY `productID`asc");
   $totalRecord=$record->num_rows;
   $totalPages=ceil($totalRecord/$item_per_page);
   $products=mysqli_query($connect,"SELECT * FROM `product_menu`ORDER BY `productID`desc  LIMIT ".$item_per_page." OFFSET ".$offset."");
   while($row=mysqli_fetch_array($products)){
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
<?php }?>
     


   </div>

</section>
<form action=""></form>
<div class="phan-trang">
   <!-- ?php if($current_page>2){
      $first_page=1;?>
      <a href="?per_page=?=$item_per_page?>&page=?=$first_page?>">First</a>
      ?php }?> -->

      <?php 
         for($num=1;$num<=$totalPages;$num++)
         {?>
         <?php if($num!=$current_page) { ?>
            <?php if($num > $current_page-3&& $num<$current_page+3) { ?>
           <a href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a> 
         <?php } ?>
         <?php }else{ ?>
            <strong><?=$num?></strong>
         <?php }?>
      <?php }?>
      <!-- ?php if($current_page>$totalPages-3){
      $last_page=$totalPages;?>
      <a href="?per_page=<?=$item_per_page?>&page=<?=$last_page?>">Last</a>
      ?php }?> -->
     </div>
</form>








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