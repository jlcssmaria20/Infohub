<?php   
$files = $_POST['files'];

if(substr($files, -3) == 'pdf') {
    $filename = "../../../../assets/uploadimages/$files";
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($filename));
        readfile($filename);

} elseif(substr($files, -4) == 'xlsx') { 

}
?>