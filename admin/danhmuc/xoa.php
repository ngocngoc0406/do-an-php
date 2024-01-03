<?php
include_once('../../connect.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM category_menu WHERE categoryID='$id'";
if ($connect->query($sql) === TRUE) {
    echo '<script language="javascript">alert("Danh mục đã được xóa"); window.location="danhmuc.php";</script>';
} else {
echo "Lỗi kết nối đến database " . $connect->error;
}
$connect->close();
}
?>