<?php
// INCLUDES

require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');

    // The list of items to be displayed on screen.

    $id = $_GET['id'];

    $sql = $pdo->prepare("SELECT * FROM documentstemplate WHERE id = ".$id."");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    $filename = "../../../../assets/uploadimages/".$data['files'].""; 

    // if(substr($data['files'], -3) == 'pdf') {
    ?>
    <!-- // <form method="post" action="/htmldl-template" target="_blank">
    //     <input type="hidden" name="files" value="<?php// echo $data['files']; ?>">
    //     <button type="submit" style="dislay:none:" onclick="doSomething()">
    // </form>
    //     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>           
    //     <script>
    //         function doSomething(){}
    //         $(document).ready(function(){
    //             $("button")[0].click();
    //         });
    //     </script>  -->


    <p><a href="<?php echo $filename; ?>"  download></a></p>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>           
    <script>
        function doSomething(){}
        $(document).ready(function(){
            $("a")[0].click();
            window.location.replace("/dx-documents-and-quick-links");
        });
    </script>