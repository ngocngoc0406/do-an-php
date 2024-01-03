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
   <title>Giỏ hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
   <h3>Giỏ hàng mua sắm</h3>
   <p><a href="menu.php">Sản phẩm </a> <span> / Giỏ hàng</span></p>
</div>
<!-- ====================================================================== -->


<section class="products">

   <h1 class="title">Giỏ hàng của bạn</h1>
<?php 
if(isset($_SESSION['member'])){
   if(!isset($_SESSION["cart"])){
      $_SESSION["cart"]=array();
   }
   if(isset($_GET['action'])){
      function update_cart($add=false){
         foreach($_POST['quantity'] as $productID => $quantity)
         {
            
            if($add)
            {
               $_SESSION["cart"][$productID]+=$quantity;

               header("Location:cart.php");
            }else{
               $_SESSION["cart"][$productID]=$quantity;
            }
         }
      }
      switch($_GET['action']){
         case "add":
            update_cart(true);
            
            break;
         case "delete":
            if(isset($_GET['id']))
            {
               unset($_SESSION["cart"][$_GET['id']]);
               header("Location:cart.php");
            }
            break;
          case "deleteAll":
             unset($_SESSION["cart"]);
             header("Location:cart.php");
            break; 
         case "submit":
            update_cart();
               
             break;  
      }
   }
 if(!empty($_SESSION["IDquantityCart"])){
    $product_cart=mysqli_query($connect,"SELECT * FROM `product_menu` WHERE `productID` IN (".$_SESSION["IDquantityCart"].")");
    while($row=mysqli_fetch_assoc($product_cart)){
      $_SESSION["cart"][$row['productID']]=1;
    }
 }
   if(!empty($_SESSION["cart"])){
      //  var_dump(implode(",",array_keys($_SESSION["cart"])));exit;
      
      
      $productss=mysqli_query($connect,"SELECT * FROM `product_menu` WHERE `productID` IN (".implode(",",array_keys($_SESSION["cart"])).")");
       unset($_SESSION["IDquantityCart"]);
   }

}else {
   echo '<script language="javascript">alert("Bạn cần phải đăng nhập!!!"); window.location="login.php";</script>';
}

?>

<form action="cart.php?action=submit" method="POST">
   <?php $total=0;
      if(!empty($productss)){?>
   
  
   <div class="totalcart"></div>
   <div class="box-container">
   
       
   <?php
      while($row=mysqli_fetch_assoc($productss)){
   ?>
      <div class="box">
         <a href="detail_prod.php?id=<?=$row['productID']?>" class="fas fa-eye"></a>
         <a href="cart.php?action=delete&id=<?=$row['productID']?>"><button class="fas fa-times bg-danger text-white" type="button" name="delete" onclick="return confirm('Xóa sản phẩm này?')"></button></a>
         <img src="uploaded_img/<?=$row['image']?>" alt="">
         <p><?php if($row['amount']>=1){echo "(".$row['amount']." sản phẩm có sẵn)";
            }else{echo"<h8 style='color:red;font-weight:bold;'>( Hết hàng!!!)</h8>";}?></p>
         <div class="name"><?=$row['productName']?></div>
         <div class="flex">
            <div class="price"><span>$</span><?=$row['price']?></div>
            <input type="number" name="quantity[<?=$row['productID']?>]" class="qty" min="1" max="<?php if($row['amount']==0) echo "1";?>" value="<?=$_SESSION["cart"][$row['productID']]?>" >
            <button type="submit" class="fas fa-edit" name="edit"></button>
         </div>
         <div class="sub-total" style=" color: #04354B;font-size: 15px;font-weight: bold;">Tổng giá : <span><?=$row['price']*$_SESSION["cart"][$row['productID']]?></span><sup>$</sup></div>
      </div>

     <?php
     
     $total+=$row['price']*$_SESSION["cart"][$row['productID']];
     $_SESSION['total']=$total;
      }?>
      <div class="cart-total" style=" color: #04354B;font-size: 15px;font-weight: bold;">
      <p>Tổng giá đơn hàng : <span><?=$total?><sup>$</sup>/-</span></p>
      <a href="checkout.php?action=kiemtra" class="btn bg-success  text-white">__Đặt hàng__</a>
      </div>
      </div>
   


   </div>

   <div class="more-btn">
      <a href="cart.php?action=deleteAll" class="delete-btn bg-danger text-white" onclick="return confirm('Xóa tất cả sản phẩm?');">Xóa tất cả</a>
   </div>   
   <?php
   }else {
       ?> 
</form>

   <div >
    <h2 style="display: flex;justify-content: center;color:#C9C9C9">(Giỏ hàng trống)</h2>
   
   </div> <?php }?>
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