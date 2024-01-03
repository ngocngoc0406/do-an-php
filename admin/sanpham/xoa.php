<?php
include_once('../../connect.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM product_menu WHERE productID='$id'";
if ($connect->query($sql) === TRUE) {
    echo '<script language="javascript">alert("Sản phẩm đã được xóa"); window.location="sanpham.php";</script>';
} else {
echo "Lỗi kết nối đến database " . $connect->error;
}
$connect->close();
}
?>