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
                        <span  style="color: var(--black);">Documents and Quick Links > <?php  echo $data['document_name']; ?></span>
                    </h2>
                    
                    <ul class="list-inline mb-4">

                        <?php 
                            //Display Files
                            $count = 0;
                            $sql = $pdo->prepare("SELECT * FROM files WHERE document_name = :document_name");
                            $sql->bindParam(":document_name", $data['document_name']);
                            $sql->execute();

                            if($sql->rowCount() > 0) {

                                while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                                    $count++; 
                                ?>
                                    <input type="hidden" class="copied">
                                
                                    
                                   
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="card card-primary card-outline">
                                                <div class="card-body">
                                                    <h5 class="card-title"> <?php  echo $data['file_linkname']; ?></h5>
                                                    <div class="text-right">
                                                        <button class="btn btn-primary" onClick="copyLink(<?php echo $count ?>)" name="copy<?php echo $count?>" title="Copy this link to access file.">
                                                        Copy Link
                                                        </button>
                                                        
                                                        <a href="<?php echo $data['file_link'] ?>" target="_blank" class="btn btn-primary">Go to Link</a>
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