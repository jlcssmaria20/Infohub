<?php 

require($_SERVER['DOCUMENT_ROOT'].'/tcapWebsite/pages/mailer/PHPMailerAutoload.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['uname'];
$email = $_POST['email'];

////////////////
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
$mail->Priority = 1;                                  // TCP port to connect to

//Recipients
$mail->AddAddress($email, $firstname);
$mail->From = 'bpodeveloper@transcosmos.com.ph';
$mail->setFrom('bpodeveloper@transcosmos.com.ph', 'TAR TEAM');
$mail->Subject = 'TCAP: Careers registration password';
//Typical mail data

$mail->AddEmbeddedImage("transcosmos.jpg", "my-attach", "transcosmos.jpg");
$msg ='
    <html>
    <body style="font-size: 15px; font-family: calibri; >
        <div class="container">
            <div class="body">
                <p>Hi '.$firstname.' '.$lastname.',</p>
                <p class="messages">
                    You have registered to Transcosmos Asia Philippines website.
                </p>
                <p class="messages">Here`s the password generated. <b>'.$password.'</b></p>
                
            </div>
            <div class="footer1">
                This is an auto generated email. Please do not reply
            </p>
            </div>
        </div>
    </body>
    </html>
    ';
$mail->Body = $msg;

try{
    $mail->Send();
    echo "password will be sent to your email address!";
} catch(Exception $e){
    //Something went bad
    echo "Mailer Error: - " . $mail->ErrorInfo;
}

if(!$mail->send()) { 
    echo 'message error! Enter a valid account.';
} else {
    //display something you want
}// end of else
        
?>