<?php
session_start();
require '../../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý sản phẩm</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../css/style1.css">
      <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/3411/premium/3411447.png?token=exp=1655746654~hmac=a6a84ab5985010f032dc53a0f937687d">


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
   <section>
   <?php
   if(isset($_GET["search_box1"])&&!empty($_GET["search_box1"])) {
      $key = $_GET["search_box1"];
      $sql = "SELECT * FROM product_menu WHERE productID LIKE '%$key%' OR productName LIKE '%$key%' OR describeSP LIKE '%$key%' OR price LIKE '%$key%' ";
   } else {
      $sql = "SELECT * FROM product_menu";
   }
   $result = mysqli_query($connect, $sql);
   ?>
   <p><h3 style="text-align:center; font-size:40px">QUẢN LÝ SẢN PHẨM</h3></p><br>
   <section class="search-form">
   <form action="" method="GET">
      <input type="text" name="search_box1" placeholder="Tìm kiếm..." value="<?php if(isset($_GET["search_box1"])) { echo $_GET["search_box1"];} ?>" maxlength="50">
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
    </section>
   <a href="them.php" type="button "class="btn btn-success">Thêm mới &#43;</a><br><br>
   <table>
      <div>
         <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Ảnh</th>
              <th>Giá</th>
              <th>Tồn kho</th>
              <th>Hành động</td>
            </tr>
      </div>
             <?php 
   while($row=mysqli_fetch_array($result)){
   ?>
            <tr>
              <td><?=$row['productID']?></td>
              <td><?=$row['productName']?></td>
              <td><?=$row['image']?></td>
              <td><?=$row['price']?>$</td>
              <td><?=$row['amount']?></td>
              
              <td>
          <a href="sua.php?id=<?php echo $row['productID']; ?>" type="button "class="button1">Sửa</a>
          <a href="xoa.php?id=<?php echo $row['productID']; ?>" onclick="return confirm('Hành động sẽ xóa đi sản phẩm. Xóa ?');" type="button" class="button1">Xóa</a>
          <?php }?>
        </td>
            </tr>
   </table>
            </section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../../js/script.js"></script>
</body>
</html>