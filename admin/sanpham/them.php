<?php
require '../../connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Thêm khách hàng</title>
      
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="../../css/style.css">
      <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/3411/premium/3411447.png?token=exp=1655746654~hmac=a6a84ab5985010f032dc53a0f937687d">

<style>
   .form-container form{
      max-width: 90%;
   }
   .form-container form h2{
      text-align: left;
      margin-left: 10px;
   }
</style>
   </head>

   <body>

<header class="header">

   <section class="flex">

      <a href="../../home.php" class="logo">HOPE</a>

      <nav class="navbar">
         <a href="../../home.php">Truy cập trang chủ</a>
         <a href="../taikhoan/taikhoan.php">Quản lý tài khoản</a>
         <a href="../danhmuc/danhmuc.php">Quản lý danh mục</a>
         <a href="sanpham.php">Quản lý sản phẩm</a>
         <a href="../cart/donhang.php">Quản lý đơn đặt hàng</a>
      </nav>

      <div class="icons">
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <?php
         if(empty($_SESSION['member'])):?>
            <div class="profile">
         <p class="account"><a href="../../login.php" ><img src="https://img.icons8.com/sf-regular-filled/48/000000/login-rounded-right.png" width="30px"/>Đăng nhập</a>
                hoặc
             <a href="../../register.php"><img src="https://img.icons8.com/external-glyph-geotatah/64/000000/external-register-training-management-system-glyph-glyph-geotatah.png" width="30px"/>Đăng kí </a>
         </p>
         </div>

         <?php else:?>
      <div class="profile">
         <p class="name">
         <?=$_SESSION['member']?>
         </p>
         <div class="flex">
            <a href="../../profile.php" class="btn">Hồ sơ</a>
            <a href="../../logout.php" class="delete-btn">Đăng xuất</a>
            </div>
        <?php endif;?>
      </div>

   </section>

</header>

      
      <section class="form-container" >

      <?php if(isset($_POST['submit']))
      {
         if ($_FILES['photo']['type'] == "image/jpeg" || $_FILES['photo']['type'] == "image/png" || $_FILES['photo']['type'] == "image/gif") {
            $tmp_name = $_FILES['photo']['tmp_name'];
            $name = $_FILES['photo']['name'];


         $photo = $name; 
         $name=$_POST['name'];
         $namecode=$_POST['namecode'];
         $price=$_POST['price'];
         $detailSP = $_POST['chitietsp'];
         $kho = $_POST['kho'];
         $categoryID=$_POST['danhmuc'];
         $describeSP=$_POST['motasp'];
         $sql="INSERT INTO product_menu (productName,productCode, detailSP, amount, image, price, categoryID,describeSP) VALUES ('$name','$namecode','$detailSP','$kho','$photo','$price','$categoryID','$describeSP')";
         $result = mysqli_query($connect, $sql);

         if($result)
            {
               echo '<script language="javascript">alert("Thêm sản phẩm thành công!!!"); window.location="sanpham.php";</script>';
            
            }else{
               echo "Lỗi {$sql}".$connect->error;
            }
         }else echo "Lỗi định dạng file ảnh";


      }

         ?>

         
         <form action="" method="post" enctype="multipart/form-data">
            <h3>Thêm sản phẩm</h3>
            <input type="text" required maxlength="50" name="name" placeholder="Nhập tên của sản phẩm" class="box">
            <input type="text" required maxlength="50" name="namecode" placeholder="Mã sản phẩm" class="box">
            <input type="number" required min="1" max="500" name="kho" placeholder="Nhập hàng tồn kho" class="box">
            <h2> Tải lên ảnh sản phẩm </h2>
            <input type="file" name="photo" class="box">
            <h2>Danh mục</h2>
            <select id="" name="danhmuc" class="box">
                    <option value="1"> Mắt kính</option>
                    <option value="2"> Sách</option>
                    <option value="3"> Gậy chỉ đường</option>
                    <option value="4"> Đồng hồ</option>
                    <option value="5"> Đồ dùng</option>
               </select>
            <input type="number" required min="1" name="price" placeholder="Nhập giá sản phẩm" class="box">
            <h2>Chi tiết sản phẩm</h2>
            <textarea name="chitietsp" id="chitietsp" cols="30" rows="10"><?php if(!empty($detailSP)){echo $detailSP;}else echo $detailSP="";  ?></textarea>
            <h2>Mô tả sản phẩm</h2>
            <textarea name="motasp" id="motasp" cols="30" rows="50"><?php if(!empty($describeSP)){echo $describeSP;}else echo $describeSP=""; ?></textarea>
            <input type="submit" value="Thêm" class="btn" name="submit">
         </form>

      </section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../../js/script.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
      <script>
            CKEDITOR.replace('chitietsp');
            CKEDITOR.replace('motasp');
      </script>

   </body>

</html>