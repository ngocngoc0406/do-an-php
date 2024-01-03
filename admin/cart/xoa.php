<?php
include_once('../../connect.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM order WHERE id='$id'";
if ($connect->query($sql) === TRUE) {
    echo '<script language="javascript">alert("Đơn hàng đã được xóa"); window.location="donhang.php";</script>';
} else {
echo "Lỗi kết nối đến database " . $connect->error;
}
$connect->close();
}
?>