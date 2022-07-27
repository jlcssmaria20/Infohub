<?php 

// INCLUDES
$module = 'login';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

   

 if(isset($_POST['email'])) {


    $rand = rand(0000, 9999);
    $passReset = 'TCAP-'.$rand;

    require 'mailer/PHPMailerAutoload.php';

    ///////////////////////////////////////

    $mail = new PHPMailer(true);   
    // $mail->SMTPDebug = 1;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.office365.com";                   // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'bpodeveloper@transcosmos.com.ph';  // SMTP username
    $mail->Password = 'Drinkingw@ter2020!';                // SMTP password
    $mail->isHTML(true);   
    $mail->Port = 587;     
    $mail->SMTPSecure = 'starlls';                         // Enable starlls encryption, `ssl` also accepted
    $mail->Priority = 1;    
    //Recipients
    $mail->From = 'bpodeveloper@transcosmos.com.ph';
    $mail->setFrom('bpodeveloper@transcosmos.com.ph', 'TAR TEAM');
    ///////////////////////////////////////

    $mail->AddAddress($_POST['email']);
    $mail->Subject = 'Change Password';
    $msg ='<div> 
            <p>Email: '.$_POST['email'].'</p>
            <p>We recieve your request about changing your password via email</p>
            <p>Here\'s the new password for your account on our system
            <br>New Password:<b>'.$passReset.'</b><br>
            <p>
        </div>
        ';
    $mail->Body = $msg;
    if(!$mail->send()) { 
        echo 'message error! Enter a valid account.';
    } else {//display something you want}// end of else
            $hash = encryptStr($passReset);

            $sql = 'UPDATE users SET upass =:upass WHERE email=:email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':upass', $hash, PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION['forgot-password'] = 'forgot-password';
            header('location:/forgot-password');

        }
 }
?>