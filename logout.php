<?php 
session_start();
require_once("function.php");
$function =new RepositoryFunction();
?>
<?php 
// implode(",",array_keys($_SESSION["cart"]))
// Lưu lại sản phẩm trong giỏ hàng mỗi lần đăng nhập:
             if(isset($_SESSION["cart"]))
             {
                 $quanCart_String="";
                 $quanCart_String=implode(",",array_keys($_SESSION["cart"]));
                  $function->updateQuantityCart($_SESSION['id'],$quanCart_String);
              }
            unset($_SESSION['decentralize']);
            unset($_SESSION['member']);
            unset($_SESSION['hphone']);
            unset($_SESSION['hemail']);
            unset($_SESSION['id']);
            unset($_SESSION['cprovince']);
            unset($_SESSION['cdistrict']);
            unset($_SESSION['commune'] );
            unset($_SESSION['pass']);
            unset($_SESSION["cart"]);
            unset($_SESSION["IDquantityCart"]);
   header("location:login.php");
   ?>