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
         <h3>Kiểm tra thông tin đơn hàng</h3>
         <p><a href="cart.php">Giỏ hàng </a> <span> / Kiểm tra thông tin đơn hàng</span></p>
      </div>

<!--=======================================code php =================================================-->
<?php
   if(isset($_GET['action'])){
     
      switch($_GET['action']){
         case "submit": $note=$_POST['note'];
            if(!empty($_SESSION["cart"])){
            $products=mysqli_query($connect,"SELECT * FROM `product_menu` WHERE `productID` IN (".implode(",",array_keys($_SESSION["cart"])).")");
            $total=0;
            $orderProduct=array();
            $sum=0;
            while($row=mysqli_fetch_array($products)){
               
               $_SESSION["count_cart"][$row['productID']]=$row['amount'];
               $orderProduct[]=$row;
               $total+=$row['price']*$_SESSION["cart"][$row['productID']];
            }
            $insertOrder=mysqli_query($connect,"INSERT INTO `order` (`id`,`customer_id`, `name`, `phone`, `province`, `district`, `commune`, `note`, `total_price`, `created_time`) VALUES (NULL,".$_SESSION['id'].", '".$_SESSION['member']."', '".$_SESSION['hphone']."', '".$_SESSION['cprovince']."', '".$_SESSION['cdistrict']."', '".$_SESSION['commune']."', '".$note."', '".$total."', '".time()."')");
            //Đặt hàng thành công
            $orderID=$connect->insert_id;
            $insertString="";//chuỗi
            foreach( $orderProduct as $key => $product)
            {
               $insertString.="(NULL, '".$orderID."', '".$product['productID']."', '".$_SESSION["cart"][$product['productID']]."', '".$product['price']."', '".time()."')";
               if( $key != count($orderProduct) - 1){
                  $insertString .= ",";
               }
            }
            $insertOrderDetail=mysqli_query($connect,"INSERT INTO `order_detail` (`id`, `order_id`, `productID`, `quantity`, `price`, `created_time`) VALUES ".$insertString.";");
            // thêm thông tin chi tiêt hàng đã order thành công 
            foreach( $orderProduct as $productID=> $row){//Giảm số lượng trong kho
               $sum=$_SESSION["count_cart"][$row['productID']]-$_SESSION["cart"][$row['productID']];
               $update_amount_sql=mysqli_query($connect,"UPDATE `product_menu` SET `amount` = '".$sum."' WHERE `productID` = ".$row['productID'].";");
            }
            unset($_SESSION["count_cart"]);
            unset($_SESSION["cart"]);
            echo'<script language="javascript">alert("Đặt hàng thành công!!!"); window.location="order_tracking.php";</script>';
         }
            break;
         case "kiemtra":
            $products=mysqli_query($connect,"SELECT * FROM `product_menu` WHERE `productID` IN (".implode(",",array_keys($_SESSION["cart"])).")");
            while($row=mysqli_fetch_array($products)){
               if($row['amount']<=0)
               {
                  echo'<script language="javascript">alert("Có sản phẩm hết hàng!!!"); window.location="cart.php";</script>';exit;
               }
            }
            header("Location:checkout.php");
            break;
      }
   }
?>
      <section class="checkout">

         <h1 class="title">order summary</h1>

         <form action="checkout.php?action=submit" method="POST">
            <div class="cart-items">
               <h3>cart items</h3>
               <?php if(!empty($_SESSION["cart"])){
                $cartItem=mysqli_query($connect,"SELECT * FROM `product_menu` WHERE `productID` IN (".implode(",",array_keys($_SESSION["cart"])).")");
               }?>
            <?php while($row=mysqli_fetch_array($cartItem)){ ?>
               <p><span class="name"><?=$row['productName']?></span><span class="price"><?=$row['price']*$_SESSION["cart"][$row['productID']]?> $</span></p>
               <?php } ?>
               <p class="grand-total"><span class="name" style="font-size: 20px;">Tổng:</span> <span class="price"><?=$_SESSION['total']?> $</span></p>
               <a href="cart.php" class="btn">view cart</a>
            </div>
            <div class="user-info">
               <h3>your info</h3>
               <p><i class="fas fa-user"></i> <span><?=$_SESSION['member']?></span></p>
               <p><i class="fas fa-phone"></i> <span><?=$_SESSION['hphone']?></span></p>
               <p><i class="fas fa-envelope"></i> <span><?=$_SESSION['hemail']?></span></p>
               <a href="update_profile.php" class="btn">update info</a>
               
               <h3>delivery address</h3>
               <p class="address"><i class="fas fa-map-marker-alt"></i>
               <span> <?php if( empty($_SESSION['cdistrict'])&&empty($_SESSION['cprovince'])&&empty($_SESSION['commune'])):echo '<script language="javascript">alert("Bạn cần phải cập nhật địa chỉ!!!"); window.location="update_address.php";</script>'; ?>
                        <?php else: ?>
                        <?=$_SESSION['commune']?>,<?=$_SESSION['cdistrict']?>,<?=$_SESSION['cprovince']?>
                        <?php endif;?>
               </span></p>    
               <a href="update_address.php" class="btn">update address</a>
               <div class="form-group">
                  <label for="note"></label>
                  <textarea class="form-control font-weight-bold" id="note" name="note" rows="3" placeholder="Note:" style="font-family:serif ;font-size: 16px;"></textarea>
               </div>
               <select name="method" class="box" required>
                  <option value="" disabled selected>Hình thức thanh toán</option>
                  <option value="cash on delivery">Thanh toán khi nhận được hàng</option>
                  <option value="credit card">Thẻ tín dụng</option>
                  <!-- <option value="paytm">paytm</option>
                  <option value="paypal">paypal</option> -->
               </select>
            </div>
            <input type="submit" value="place order" name="order" class="btn order-btn">
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