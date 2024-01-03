<?php
// session_start();
require 'connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
class RepositoryFunction{

    public function updateQuantityCart($id,$quantityCart){
        global $connect;
        $sql = "UPDATE `customerr` SET `quantityCart` = '".$quantityCart."' WHERE `CustomerID` = ".$id.";";
        return mysqli_query($connect,$sql);
    }

    
    function randomPass(){
        $pass='';
        $a=array("5","k","A","8","s","j","f","0","y","T","d","G","h","i","9","7","q","3");
          for($i=0;$i<8;$i++)
          {
              $pass.=$a[rand(0,count($a)-1)]	;
          }
          return $pass;
     }
     function GuiMail($tieude,$noidung,$mailKH){
            require "PHPMailer-master/src/PHPMailer.php";
            require "PHPMailer-master/src/Exception.php";
            require  "PHPMailer-master/src/OAuth.php";
            require  "PHPMailer-master/src/POP3.php";
            require  "PHPMailer-master/src/SMTP.php";
            $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; //chế độ debug                   
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                  
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = '';  //Nhập email muốn là email gửi mật khẩu vào giữa dấu ''                   
            $mail->Password   = '';  //Nhập pass của email                           
            $mail->SMTPSecure ='ssl';           
            $mail->Port       = 465;                                   
            $mail->CharSet="UTF-8";
            $mail->setFrom('', 'CTTNHH_2TV'); //Nhập lại email giống trên vào giữa dấu ''
            $mail->addAddress($mailKH,'');     
        
            $mail->isHTML(true);                                 
            $mail->Subject = $tieude;
            $mail->Body    = '<p><span style="font-size:14px"><span style="font-family:Times New Roman,Times,serif"><strong><u>CTTNHH 2TV</u> xin k&iacute;nh ch&agrave;o bạn</strong></span></span></p>
                            <p><span style="font-size:14px"><span style="font-family:Times New Roman,Times,serif">Cảm ơn bạn đ&atilde; phản hồi cho ch&uacute;ng t&ocirc;i!!!</span></span></p>
                            <p><span style="font-size:14px"><span style="font-family:Times New Roman,Times,serif">'.$noidung.'</span></span></p>';
            
            $mail->smtpConnect(array(
                "ssl" =>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                    "allow_self_signed"=>true
                )
                ));

            
            
            $mail->send();
            echo '<script language="javascript">alert("Vui lòng kiểm tra hộp thư email của bạn"); window.location="login.php";</script>';
        } catch (Exception $e) {
            echo "Mail không gửi được.Lỗi: {$mail->ErrorInfo}";
        }
}
}
?>