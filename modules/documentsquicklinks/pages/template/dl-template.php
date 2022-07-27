<?php
// INCLUDES

require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');

    // The list of items to be displayed on screen.

    $id = $_GET['id'];

    $sql = $pdo->prepare("SELECT * FROM documentstemplate WHERE id = ".$id."");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    $filename = "../../../../assets/uploadimages/".$data['files'].""; 
    ?>
    <p><a href="<?php echo $filename; ?>"  download></a></p>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>           
    <script>
        function doSomething(){}
        $(document).ready(function(){
            $("a")[0].click();
            window.location.replace("/dx-documents-and-quick-links-<?php echo $_SESSION['links'].'/'.encryptID($_SESSION['links-no']); ?>");
        });
    </script>

  
