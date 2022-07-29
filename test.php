<?php
$sql = $GLOBALS['pdo']->prepare("SELECT * FROM users");
$sql->execute();
while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    $newPassword = encryptStr($data['employeeid']);
    
    $sql_update = "UPDATE users SET 
    upass = :upass 
    WHERE employeeid = :employeeid";
    $stmt = $pdo->prepare($sql_update);
    // bind params
    $stmt->bindParam(":upass", $newPassword);
    $stmt->bindParam(":employeeid", $data['employeeid']);
    // execute the UPDATE statment
    $stmt->execute();
    echo $data['employeeid'] . " - $newPassword verified: ".decryptStr($newPassword, $data['employeeid']) . "<br/>";
}

?>