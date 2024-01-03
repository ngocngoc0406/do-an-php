<?php
//Kết nối sql
$connect= mysqli_connect("localhost", "root", "","do_an_co_so");

if (isset($_POST["update_product"])) {
   $sothutu=$_POST["sothutu"];
   $name = $_POST["productName"];
   $namecode=$_POST["productCode"];
   $kho = $_POST["kho"];
   $photo = $_POST["image"];
   $price = $_POST["price"];
   $danhmuc = $_POST["categoryID"];
   $detailSP=$_POST["chitietsp"];
   $describeSP=$_POST["motasp"];
}
$sql = "UPDATE product_menu SET productName = '$name',productCode='$namecode', amount ='$kho', image = '$photo', price = '$price', categoryID = '$danhmuc',detailSP='$detailSP', describeSP='$describeSP' WHERE productID = '$sothutu'";
if (mysqli_query($connect,$sql)) {
   echo '<script language="javascript">alert("Sửa sản phẩm thành công"); window.location="sanpham.php";</script>';
}
else {
   $result = "Lỗi" . mysqli_error($connect);
}
?>