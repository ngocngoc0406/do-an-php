<?php
include_once('../../connect.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM customerr WHERE CustomerID='$id'";
if ($connect->query($sql) === TRUE) {
    echo '<script language="javascript">alert("Tài khoản đã được xóa"); window.location="taikhoan.php";</script>';
} else {
echo "Lỗi kết nối đến database " . $connect->error;
}
$connect->close();
}
?>