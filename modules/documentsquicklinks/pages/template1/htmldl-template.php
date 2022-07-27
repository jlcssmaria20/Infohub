<?php   
$files = $_POST['files'];
    $filename = "../../../../assets/uploadimages/$files";
    header("Content-type: application/pdf");
    header("Content-Length: " . filesize($filename));
    readfile($filename);

?>