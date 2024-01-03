<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Xác nhận đơn hàng</title>

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
         <a href="../taikhoan/taikhoan.php">Quản lý tài khoản</a>
         <a href="../danhmuc/danhmuc.php">Quản lý danh mục</a>
         <a href="../sanpham/sanpham.php">Quản lý sản phẩm</a>
         <a href="donhang.php">Quản lý đơn đặt hàng</a>
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
$sql = "select * from `order` where id='$sothutu'";
$result = mysqli_query($connect, $sql);
//in
while($row = mysqli_fetch_assoc($result)) {
   $sothutu =$row["id"];
   $name=$row["name"];
   $phone=$row["phone"];
   $province=$row["province"];
   $district=$row["district"];
   $commune=$row["commune"];
   $note=$row["note"];
   $total_price=$row["total_price"];
   $status=$row["status"];
}
?>
<section class="form-container">

   <form action="xuliduyet.php" method="POST">
      <h3>Thông tin đơn hàng</h3><br>
      <h2>Mã đơn hàng</h2>
      <input type="text" required maxlength="100" name="sothutu" class="box" value="<?php echo $sothutu ?>">
      <h2>Tên khách hàng</h2>
      <input type="text" required maxlength="100" name="CustomerName" class="box" value="<?php echo $name ?>" disabled>
      <h2>Số điện thoại</h2>
      <input type="number" min="0" onkeypress="if(this.value.length == 10) return false;" required class="box" name="txt_number" value="<?php echo $phone ?>" disabled>
      <h2>Tỉnh/Thành phố</h2>
      <input type="text" required maxlength="50" name="txt_province" class="box" value="<?php echo $province ?>" disabled>
      <h2>Quận/Huyện</h2>
      <input type="text" required maxlength="50" name="txt_district" class="box" value="<?php echo $district ?>" disabled>
      <h2>Xã/Phường</h2>
      <input type="text" required maxlength="50" name="txt_commune" class="box" value="<?php echo $commune ?>" disabled>
      <h2>Ghi chú</h2>
      <input type="text" required maxlength="50" name="txt_note" class="box" value="<?php echo $note ?>" disabled>
      <h2>Giá đơn hàng</h2>
      <input type="text" required maxlength="50" name="price_number" class="box" value="<?php echo $total_price ?>" disabled>
      <h2>Trạng thái duyệt</h2>
      <select id="" name="status" class="box">
                    <option <?= ($status == '0')?'selected':''?> value="0"> Đơn hàng chưa được duyệt</option>
                    <option <?= ($status == '1')?'selected':''?> value="1"> Xác nhận duyệt đơn hàng</option>
               </select>
      <input type="submit" value="Cập nhật" class="btn" name="confirm">
   </form>
</section>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../../js/script.js"></script>
</body>
</html>