<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

 // set page
 $page = 'o-documents';

 $id = (isset($_GET['id']) ? $_GET['id'] : '');
		
 $sql = $pdo->prepare("SELECT * FROM documents WHERE id = :document_id LIMIT 1");
 $sql->bindParam(":document_id",$id);
 $sql->execute();

 // check if ID exists
 if($sql->rowCount()) {

     $data = $sql->fetch(PDO::FETCH_ASSOC);
     
     
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <title><?php echo $dx."Document Files"; ?></title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
        <link href="/assets/css/documents.css" rel="stylesheet" />
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    </head>
    <body>
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4">
                <div class="mb-4">
                    <h2 class="mb-3">
                        <span  style="color: var(--black);">Documents and Quick Links > <?php  echo $data['document_name']; ?></span>
                    </h2>
                    <ul class="list-inline mb-4">
                        <?php 
                            //Display Files
                            $count = 0;
                            $sql = $pdo->prepare("SELECT * FROM files WHERE document_name = :document_name");
                            $sql->bindParam(":document_name", $data['document_name']);
                            $sql->execute();
                            while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                                $count++; 
                                ?>
                                <input type="hidden" class="copied">
                            
                                
                                <button class="btn-block rounded border-0 p-0 btn bg-white" onClick="copyLink(<?php echo $count ?>)" name="copy<?php echo $count?>">
                                    <li class="list-dl-item text-left">
                                        <i class="fa fa-copy" id="fa" aria-hidden="true" title="Copy"></i>
                                        <b>File Name:</b>
                                        <?php  echo $data['file_linkname']; ?>
                                        <br>
                                        <b class="text-center">Link: </b>
                                        <span class="" id="link<?php echo $count ?>"><?php echo $data['file_link'] ?></span>
                                    </li>
                                </button>
                        <?php } ?>
                    </ul>
                    <div class="text-right">
                        <a href="/o-documents" class="btn btn-primary text-right">
                            <i class="fa fa-arrow-left mr-2"></i>
                            <?php echo renderLang($btn_back); ?>
                        </a>
                    </div>
                    
                </div>
            </section>       
            </div>
        </div>
        
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
        <?php } ?>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
        
        <script>

            //Tootltip
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            //Copy
            function copyLink(e) {
                var n = $(`#link${e}`).text();
                $(".copied").attr("value", n);
                $(".copied").attr("type", "text").select();
                document.execCommand("copy")
                $(".copied").attr("type", "hidden")
		    }
			
            $('.copied').bind('copy', function(){
                Toast.fire({
                    icon: 'success',
                    title: 'Copied to clipboard!'
                })
            //    return alert('Copied!');
            
            });
		
       
      
        </script>
    </body>
</html>