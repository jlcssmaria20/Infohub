<?php   
    $files = $_POST['files'];
    
    echo $files;

    $filename = "../../../../assets/uploadimages/$files";
    header("Content-type: application/pdf");
    header("Content-Length: " . filesize($filename));
    readfile($filename);
?>