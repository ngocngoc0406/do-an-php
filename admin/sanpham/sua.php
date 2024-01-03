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
         <p class="account"><a href="../../login.php">Đăng nhập</a> hoặc <a href="../../register.php">Đăng kí </a></p>
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
<?php
// Kết nối Database
$connect= mysqli_connect("localhost", "root", "","do_an_co_so");
$sothutu=$_GET["id"];
$sql = "select * from product_menu where productID='$sothutu'";
$result = mysqli_query($connect, $sql);
//in
while($row = mysqli_fetch_assoc($result)) {
   $sothutu =$row["productID"];
   $name=$row["productName"];
   $namecode=$row['productCode'];
   $kho=$row["amount"];
   $photo=$row["image"];
   $price=$row["price"];
   $danhmuc=$row["categoryID"];
   $describeSP=$row["describeSP"];
   $detailSP=$row["detailSP"];
}
?>
<section class="form-container">

   <form action="xulisua.php" method="POST">
      <h3>Cập nhật sản phẩm</h3><br>
      <h2>Số thứ tự</h2>
      <input type="text" required maxlength="100" name="sothutu" class="box" value="<?php echo $sothutu ?>">
      <h2>Tên sản phẩm</h2>
      <input type="text" required maxlength="100" name="productName" class="box" value="<?php echo $name ?>">
      <h2>Mã sản phẩm</h2>
      <input type="text" required maxlength="100" name="productCode" class="box" value="<?php echo $name ?>">
      <h2>Ảnh</h2>
      <input type="file" required class="box" name="image" value="<?php echo $photo ?>">
      <h2>Giá</h2>
      <input type="number" required min="1" name="price" class="box" value="<?php echo $price ?>">
      <h2>Tồn kho</h2>
      <input type="number" required min="1" max="500" name="kho" class="box" value="<?php echo $kho ?>">
      <h2>Danh mục</h2>
      <select id="" name="categoryID" class="box">
                    <option <?= ($danhmuc == '1')?'selected':''?> value="1"> Mắt kính</option>
                    <option <?= ($danhmuc == '2')?'selected':''?> value="2"> Sách</option>
                    <option <?= ($danhmuc == '3')?'selected':''?> value="3"> Gậy chỉ đường</option>
                    <option <?= ($danhmuc == '4')?'selected':''?> value="4"> Đồng hồ</option>
                    <option <?= ($danhmuc == '5')?'selected':''?> value="5"> Đồ dùng</option>
               </select>
      <h2>Chi tiết sản phẩm</h2>
      <textarea name="chitietsp" id="chitietsp" cols="30" rows="10"><?php if(!empty($detailSP)){echo $detailSP;}else echo $detailSP="";  ?></textarea>
      <h2>Mô tả sản phẩm</h2>
      <textarea name="motasp" id="motasp" cols="30" rows="10"><?php if(!empty($describeSP)){echo $describeSP;}else echo $describeSP=""; ?></textarea>
      <input type="submit" value="Cập nhật" class="btn" name="update_product">
   </form>
</section>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../../js/script.js"></script>
<script src="../../js/script.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
      <script>
            CKEDITOR.replace('chitietsp');
            CKEDITOR.replace('motasp');
      </script>
</body>
</html>