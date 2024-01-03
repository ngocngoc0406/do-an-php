<?php
//Kết nối sql
$connect= mysqli_connect("localhost", "root", "","do_an_co_so");

if (isset($_POST["update_user"])) {
   $sothutu=$_POST["sothutu"];
   $province = $_POST["txt_province"];
   $maquyen = $_POST["maquyen"];
   $khoatk = $_POST["khoataikhoan"];
}
$sql = "UPDATE customerr SET province = '$province', decentralize = '$maquyen', status= '$khoatk' WHERE CustomerID = '$sothutu'";
if (mysqli_query($connect,$sql)) {
   echo '<script language="javascript">alert("Sửa tài khoản thành công"); window.location="taikhoan.php";</script>';
}
else {
   $result = "Lỗi" . mysqli_error($connect);
}
?>