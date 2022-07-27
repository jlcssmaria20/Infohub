<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session

		$err = 0;

		// PROCESS FORM
        $id = $_POST['id'];
		
		$user_id = $_SESSION['sys_data']['id'];
        $upass = $_POST['upass'];
        
		// verify password
		$sql = $pdo->prepare("SELECT id, upass FROM users WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$user_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
        $upass_db = decryptStr($data['upass']);
        

		// check if passwords match
		if($upass_db == $upass) {
			
			$sql = $pdo->prepare("SELECT id FROM ".$module." WHERE id = :id LIMIT 1");
			$sql->bindParam(":id",$id);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);

			// check if ID exists
			if($sql->rowCount()) {

                if($_POST['nupass'] != $_POST['cupass']) {
                    
                    unset($_SESSION['oldpassnotmatch']);
                    unset($_SESSION['sucessfully']);

                    $_SESSION['passwordnotmatch'] = 'passwordnotmatch';

                    header('location:'.$_POST['module'].'');
                } else {

                    $nupass = encryptStr($_POST['nupass']);

                    $sql = $pdo->prepare("UPDATE ".$module." SET upass = :upass WHERE id = :id LIMIT 1");
                    $sql->bindParam(":upass",$nupass);
                    $sql->bindParam(":id",$id);
                    $sql->execute();

                    unset($_SESSION['oldpassnotmatch']);
                    unset($_SESSION['passwordnotmatch']);

                    $_SESSION['sucessfully'] = 'sucessfully';


                    header('location:'.$_POST['module'].'');

                }
                
				// END ADDITIONALS

				$err_code = 0;

			} else {

				$err_code = 4;

			}

		} else {

            $err_code = 2;
            
            $_SESSION['oldpassnotmatch'] = 'oldpassnotmatch';

            unset($_SESSION['passwordnotmatch']);
            unset($_SESSION['sucessfully']);

            header('location:'.$_POST['module'].'');


		}
		
// renderConfirmDelete($err_code,'sys_'.$module.'_suc',$module.'_messages_'.$prefix.'_removed');
?>