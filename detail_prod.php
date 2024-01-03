<?php
session_start();
require 'connect.php';
require_once("function.php");
$function =new RepositoryFunction();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   
   <title>Chi tiết sản phẩm</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- boostrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
      <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/3411/premium/3411447.png?token=exp=1655746654~hmac=a6a84ab5985010f032dc53a0f937687d">
<style>

.product-content{
   display: flex;
   /* flex-wrap: wrap; */
   
}
.product-top{
margin-bottom: 30px;
}

.product-content-left {
   width: 50%;
   /* display: inline-flex; */
   /* margin-right: 100px; */
}
.product-content-right{
   width: 50%;
}

/* .product-content-left-big-img{
   width:100%;
   
} */
.product-content-left-big-img img{
   width:500px;
   height: 550px;
   border: 2px solid #38D0C6;

}
/* .product-content-left-small-img{
   width:20%;
}
.product-content-left-small-img img{
   width:100%;
   padding-bottom: 3px;
} */
.product-content-right-product-name{
   
   font-size: 16px;
}
.product-content-right-product-name p{
color: #cccccc;
font-size: 14px;
margin-bottom: 0px;
}
.product-content-right-product-price{
 
   font-size: 25px;
   font-weight: bold;
   
}

.quantity{
display: flex;

font-size: 15px;
}
.quantity input{
   width: 30px;
   padding-left: 3px;
}
.quantity p {
   padding-top:10px ;
}
.product-content-right{
   padding-left: 40px;
}
.product-content-right-product-icon{
   display: flex;
}
.product-content-right-product-icon-item{
   margin:10px 10px;
   cursor: pointer;
}
.product-content-right-bottom{
   padding-top: 10px;
   /* border: 1px solid #3333; */
   position: relative;
}

.product-content-right-bottom-top{
   position: absolute;
   width: 30px;
   height: 30px;
   
   display: flex;
   justify-content: center;
   align-items: center;
   top: -15px;
   left: 50%;
   border-radius: 50%;
   transform: translateX(-50%);
   cursor: pointer;
}
.product-content-right-bottom-content-title{
   display: flex;
   font-size: 16px;
   border-bottom: 2px solid #cccccc;
   justify-content: center;
   
}
.product-content-right-bottom-content-title-item{
   margin-right: 20px;
    font-weight: bold;
   cursor: pointer;
}
.product-content-right-bottom-content p{
   font-family: Serif;
   font-size: 20px;
}
.product-content-right-bottom-content-mota{
   display: none;
} 
.active9{
   display: none;
}
.product-content-left-small-comment{
   display: flex;
   justify-content: center;
   margin: 10px 0;
   cursor: pointer;
   /* border-bottom: 2px solid #cccccc; */
   padding-right: 39px;
   
}

.product-content-right-bottom-content-chitiet p{
   justify-content: center;
   
}
/* -----------------contact------------------- */

</style>
      
</head>
<?php
   $result=mysqli_query($connect,"SELECT * FROM `product_menu` WHERE productID=".$_GET['id']);
   
   
?>
<body>
   

<header class="header">

   <section class="flex">
         <a href="home.php" class="logo">HOPE</a>

      <nav class="navbar">
         <a href="home.php">Trang chủ</a>
         <a href="about.php">Giới thiệu</a>
         <a href="menu.php">Sản phẩm</a>
         <a href="orders.php">Câu chuyện</a>
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
   <h3>Thông tin sản phẩm</h3>
   <p><a href="menu.php">Sản phẩm</a> <span> / Chi tiết sản phẩm</span></p>
</div>
<!--  -->
<?php
while($product=mysqli_fetch_assoc($result)){
?>


<section class="product">
         <div class="container">
            <div class="product-top">
               <h4><marquee behavior="alternate" direction="right" scrolldelay="61">Cảm ơn bạn đã quan tâm sản phẩm!</marquee></h4>
            </div>
            <div class="product-content">
               <div class="product-content-left">
                     <div class="product-content-left-big-img">
                        <img src="uploaded_img/<?=$product['image']?>" alt="">
                    </div>
                  <div class="product-content-left-small-comment">
                     <div class="comment"><i class="fa-regular fa-comments"> Comment</i></div>
                  </div>
                  <div class="contact">
                     <div class="media border p-3">
                        <i class='fas fa-user-circle mr-3 mt-3 rounded-circle' style='font-size:48px;'></i>
                        <div class="media-body">
                           <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
                           <p>Sản phẩm rất tốt!!!</p>      
                        </div>
                        </div>
                     </div>
                     <!-- <div class="product-content-left-small-img">
                        <img src="uploaded_img/dochoilego_khiemthi.png" alt="">
                        <img src="uploaded_img/dochoilego_khiemthi.png" alt="" >
                        <img src="uploaded_img/dochoilego_khiemthi.png" alt="" >
                     </div> -->
               </div>
               
               <div class="product-content-right">
                     <div class="product-content-right-product-name">
                        <h1 style="margin-bottom: 0px;font-family:Tahoma;font-weight:bold"><?=$product['productName']?></h1>
                        <p><?=$product['productCode']?></p>
                     </div>
                     <div class="product-content-right-product-price">
                        <p style="margin-bottom: 0px;"><?=$product['price']?><sup>$</sup></p>
                     </div>
                     <div class="product-content-right-product-delivery">
                        <p style="margin-bottom: 0px; font-size:20px;color:#00BFA5"><i class="fa-solid fa-truck-fast"> </i> Miễn phí vận chuyển</p>
                     </div>
                     <form action="cart.php?action=add" method="POST">
                     <div class="quantity">
                        <p style="font-weight: bold;">Số lượng:</p>
                        <input type="number" min="1" value="1" name="quantity[<?=$product['productID']?>]" max="<?=$product['amount']?>">
                        <p style="font-size:10px ;"><?php if($product['amount']>=1)
                                                            {echo "(".$product['amount']." sản phẩm có sẵn)";}   
                                                            else echo"<p style='color:red;'>( Hết hàng!!!)</p>";                      
                                                                                 ?></p>
                     </div>
                     <div class="product-content-right-product-button">
                     <a href=""><input type="submit" class="btn bg-success text-white" value="Mua sản phẩm"> </a>
                    
                     </div>
                     </form>
                     <div class="product-content-right-product-icon">
                        <div class="product-content-right-product-icon-item">
                        <i class="fa-solid fa-phone"> Hotline</i>
                        </div>
                        <div class="product-content-right-product-icon-item">
                        <i class="fa-regular fa-comments"> Chat</i>
                        </div>
                        <div class="product-content-right-product-icon-item">
                        <a href="contact.php" style="color: black;"><i class="fa-regular fa-envelope"> Mail</i></a>  
                        </div>
                     </div>
                     <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                        <div class="arrow"><i class='fas fa-angle-down'></i></div>
                        </div>
                        <div class="product-content-right-bottom-content-big">
                           <div class="product-content-right-bottom-content-title">
                              <div class="product-content-right-bottom-content-title-item ">
                                 <p class="chitiet" style="margin-right:80px ;">Chi tiết</p>
                              </div>
                              <div class="product-content-right-bottom-content-title-item ">
                                 <p class="mota"style="margin-left:80px ;">Mô tả</p>
                              </div>
                           </div>
                           <div class="product-content-right-bottom-content">
                              <div class="product-content-right-bottom-content-chitiet">
                                 <p><?=$product['detailSP']?></p>
                                 <p>Kho hàng          : <?=$product['amount']?></p>
                                 <p>Thời gian bảo hành: 3-6 tháng</p>
                                 <p>Gửi từ            : Đà Nẵng</p>
                                 
                              </div>
                              <div class="product-content-right-bottom-content-mota">
                                 <p><?=$product['describeSP']?></p>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
</section>
<?php }?>

<!-- ================================================================= -->
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
<script>
   const chitiet= document.querySelector(".chitiet");
const mota= document.querySelector(".mota");
if(mota){
   mota.addEventListener("click",function(){
      document.querySelector(".product-content-right-bottom-content-chitiet").style.display="none";
      document.querySelector(".product-content-right-bottom-content-mota").style.display="block";
   })
}
if(chitiet){
   chitiet.addEventListener("click",function(){
      document.querySelector(".product-content-right-bottom-content-chitiet").style.display="block";
      document.querySelector(".product-content-right-bottom-content-mota").style.display="none";
   })
}
const butTon= document.querySelector(".product-content-right-bottom-top");
if(butTon){
   butTon.addEventListener("click",function(){
      document.querySelector(".product-content-right-bottom-content-big").classList.toggle("active9");
   })
}
const suBmit= document.querySelector(".product-content-left-small-comment");
if(suBmit){
   suBmit.addEventListener("click",function(){
      document.querySelector(".contact").classList.toggle("active9");
   })
}
</script>

</body>
</html>