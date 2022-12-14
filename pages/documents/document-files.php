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
        <link rel="icon" type="image/x-icon" href="/assets/images/favicon.png">
        <title><?php echo $dx."Document Files"; ?></title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link href="/assets/css/documents.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4">
                <div class="mb-4">
                    <h2 class="mb-3">
                        <span  >Documents and Quick Links <i class="fa fa-angle-right mx-2 text-secondary" aria-hidden="true"></i> <?php  echo $data['document_name']; ?></span>
                    </h2>
                    
                    <ul class="list-inline mb-4">

                        <?php 
                            //Display Files
                            $count = 0;
                            $sql = $pdo->prepare("SELECT * FROM files WHERE document_name = :document_name ORDER BY id DESC");
                            $sql->bindParam(":document_name", $data['document_name']);
                            $sql->execute();

                            if($sql->rowCount() > 0) {

                                while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                                    $count++; 
                                ?>
                                    <input type="hidden" class="copied">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="card card-secondary mx-1" style="border-top: 2px solid #cbcdcf;">
                                                <div class="card-body py-2">
                                                    <div class="row">
                                                        <div class="col-8"><h5 class="card-title text-dark m-1"><?php  echo $data['file_linkname']; ?></h5></div>
                                                        <div class="col-4">
                                                            <div class="d-flex justify-content-end">
                                                                <span id="link<?php echo $count?>" style="display:none"><?php echo $data['file_link'] ?></span>
                                                                <button class="btn border-primary bg-none mr-2" style="color:var(--blue);" onClick="copyLink(<?php echo $count ?>)" name="copy<?php echo $count?>" title="Copy this link to access file.">
                                                                    <i class="fas fa-paperclip mr-1" aria-hidden="true"></i> Copy Link
                                                                </button>
                                                                <?php
                                                                    $drive_z_keyword = "Z:\DX";
                                                                    $file_link = $data['file_link'];
                                                                    if(strpos($file_link, $drive_z_keyword) !== false){
                                                                        //word found
                                                                        echo "<div style='display:inline;' title='Drive Z Link'><a href='#' class='btn btn-primary disabled' style='background-color: var(--blue);' ><i class='fa fa-link mr-1' aria-hidden='true'></i>Go to Link</a></div>";
                                                                    } else{
                                                                        echo "<a href='$file_link' target='_blank' class='btn btn-primary' style='background-color: var(--blue);' ><i class='fa fa-link mr-1' aria-hidden='true'></i>Go to Link</a>";
                                                                    }       
                                                                ?>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                          <?php 
                                 }
                             }   else {     
                                echo '<br><p><strong>No data links available.</strong></p>';
                             }
                        ?>
                       
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