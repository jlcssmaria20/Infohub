<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	$uname = $_POST['uname'];
	if ($_POST["upass"] === $_POST["cpass"]) {
		$upass = $_POST['upass'];

		$employeeid = $_POST['employeeid'];
		$date_start = $_POST['date_start'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$civil_status = $_POST['civil_status'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$data_per_page = 15;
		$roleids = $_POST['roleids'];
	
		$filename = $_POST['filename'];

		$team = $_POST['team'];
		$position = $_POST['position'];
		$skills = $_POST['skills'];
		$personal_details = $_POST['personal_details'];

	   // check table if already exist
	   $sql = $pdo->prepare("SELECT email FROM `users` WHERE email =?");
	   $sql->bindParam(1, $email);
	   $sql->execute();
	   if( $sql->rowCount() > 0 ) { # If rows are found for query
		   unset($_SESSION['add_user_success']);
		   $_SESSION['add_user_exist_success'] = 'add_user_exist_success';
		   header('location:/add-user');	
	   }
	   else {
		unset($_SESSION['add_user_exist_success']);
		$_SESSION['add_user_success'] = 'add_user_success';

		$sql = $pdo->prepare("INSERT INTO users (`uname`, `upass`, `employeeid`, `date_start`, 
		`firstname`, `middlename`, `lastname`, `gender`, `civil_status`, `email`, 
		`mobile`, `photo`,`roleids`, `data_per_page`,`personal_details`, `team`, `position`,`skills`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->bindParam(1, $uname);
			$sql->bindParam(2, $upass);
			$sql->bindParam(3, $employeeid);
			$sql->bindParam(4, $date_start);
			$sql->bindParam(5, $firstname);
			$sql->bindParam(6, $middlename);
			$sql->bindParam(7, $lastname);
			$sql->bindParam(8, $gender);
			$sql->bindParam(9, $civil_status);
			$sql->bindParam(10, $email);
			$sql->bindParam(11, $mobile);
			$sql->bindParam(12, $filename);
			$sql->bindParam(13, $roleids);
			$sql->bindParam(14, $data_per_page);
			$sql->bindParam(15, $team);
			$sql->bindParam(16, $position);
			$sql->bindParam(17, $skills);
			$sql->bindParam(18, $personal_details);
			$sql->execute();

	

				require 'PHPMailerAutoload.php';
				////////////////
				$mail = new PHPMailer(true);   
				// $mail->SMTPDebug = 1;                               // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = "smtp.office365.com";                   // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'bpodeveloper@transcosmos.com.ph';  // SMTP username
				$mail->Password = 'Drinkingw@ter2022!';                // SMTP password
				$mail->isHTML(true);   
				$mail->Port = 587;     
				$mail->SMTPSecure = 'starlls';                         // Enable starlls encryption, `ssl` also accepted
				$mail->Priority = 1;                                  // TCP port to connect to
				
				//Recipients
				$mail->AddAddress($email, $firstname, $middlename, $lastname);
				$mail->From = 'bpodeveloper@transcosmos.com.ph';
				$mail->setFrom('bpodeveloper@transcosmos.com.ph', 'DX INFO HUB');
				$mail->Subject = 'DX INFO HUB: Employee ID: '.$employeeid;
				//Typical mail data
				
				$mail->AddEmbeddedImage("transcosmos.jpg", "my-attach", "transcosmos.jpg");
				$msg ='
					<html>
					<body style="font-size: 15px; font-family: calibri; >
						<div class="container">
							<div class="body">
								<p>Hi '.$firstname.' '.$middlename.' '.$lastname.' ('.$employeeid.'),</p>
								<p class="messages">
									Date Started '.$date_start.'<br>
									Username: '.$uname.'<br>
									Password: '.$upass.'
								</p>
								<p class="messages">Link http://infohub.tcapdmwis.com/admin-login</p>
							
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
					echo "Messsage Sent!";
				} catch(Exception $e){
					//Something went bad
					echo "Mailer Error: - " . $mail->ErrorInfo;
				}
			
				if(!$mail->send()) { 
					echo 'message error! Enter a valid account.';
				} else {
					//display something you want
				}// end of else
			header('location:/add-user');
		}

	} else {
		$_SESSION['cpassword'] = 'cpassword';
		header('location:/add-user');
	}

		
	
?>