<?php
//Kết nối sql
$connect= mysqli_connect("localhost", "root", "","do_an_co_so");

if (isset($_POST["confirm"])) {
   $sothutu=$_POST["sothutu"];
   $status = $_POST["status"];
}
$sql = "UPDATE `order` SET status = '$status' WHERE id = '$sothutu'";
if (mysqli_query($connect,$sql)) {
   echo '<script language="javascript">alert("Cập nhập đơn hàng thành công"); window.location="donhang.php";</script>';
}
else {
   $result = "Lỗi" . mysqli_error($connect);
}
?>