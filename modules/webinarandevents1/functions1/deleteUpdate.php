<?php 
$module = 'webinarandevents'; $prefix = 'webinarandevent'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

    $_SESSION['delete_success'] = 'delete_success';
    $sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE month_set=:month_set ORDER BY date_set ASC LIMIT 1';
    $img_count = 0;
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':month_set', $_SESSION['set-delete-month'], PDO::PARAM_INT);
    $statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
    $statement->execute();

    header('location:/edit-webinarandevent/list/'.encryptID('1').'');

?>