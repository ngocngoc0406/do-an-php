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


</head>
<body>
   
<header class="header">

   <section class="flex">

      <a href="../../home.php" class="logo">HOPE</a>

      <nav class="navbar">
         <a href="../../home.php">Truy cập trang chủ</a>
         <a href="taikhoan.php">Quản lý tài khoản</a>
         <a href="../danhmuc/danhmuc.php">Quản lý danh mục</a>
         <a href="../sanpham/sanpham.php">Quản lý sản phẩm</a>
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
$sql = "select * from customerr where CustomerID='$sothutu'";
$result = mysqli_query($connect, $sql);
//in
while($row = mysqli_fetch_assoc($result)) {
   $sothutu =$row["CustomerID"];
   $name=$row["CustomerName"];
   $email=$row["email"];
   $phone=$row["phone"];
   $province=$row["province"];
   $maquyen=$row["decentralize"];
   $khoatk=$row["status"];
}
?>
<section class="form-container">

   <form action="xulisua.php" method="POST">
      <h3>Cập nhật hồ sơ</h3><br>
      <h2>Số thứ tự</h2>
      <input type="text" required maxlength="100" name="sothutu" class="box" value="<?php echo $sothutu ?>">
      <h2>Tên khách hàng</h2>
      <input type="text" required maxlength="100" name="CustomerName" class="box" value="<?php echo $name ?>"disabled>
      <h2>Email</h2>
      <input type="email" required maxlength="50" name="txt_email" class="box" value="<?php echo $email ?>"disabled>
      <h2>Số điện thoại</h2>
      <input type="number" min="0" onkeypress="if(this.value.length == 10) return false;" required class="box" name="txt_number" value="<?php echo $phone ?>"disabled>
      <h2>Địa chỉ</h2>
      <input type="text" required maxlength="50" name="txt_province" class="box" value="<?php echo $province ?>">
      <h2>Phân quyền</h2>
      <select id="" name="maquyen" class="box">
                    <option <?= ($maquyen == '0')?'selected':''?> value="0"> Quản trị viên</option>
                    <option <?= ($maquyen == '1')?'selected':''?> value="1"> Khách hàng</option>
               </select>
      <h2>Khóa tài khoản</h2>
      <select id="" name="khoataikhoan" class="box">
                    <option <?= ($khoatk == '0')?'selected':''?> value="0"> Có</option>
                    <option <?= ($khoatk == '1')?'selected':'1'?> value="1"> Không</option>
               </select>
      <input type="submit" value="Cập nhật" class="btn" name="update_user">
   </form>
</section>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../../js/script.js"></script>
</body>
</html>