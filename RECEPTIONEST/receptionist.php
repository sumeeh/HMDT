<?php
//link to other file that has a session started inside it bc its safer than starting the session in the same file
require_once '../includes/config_session.inc.php';
//check if the user logged in
//this code prevent anyone to enter the page without logging in
if(!(isset($_SESSION['password']))){
    header('Location: ../login_page/login.php');
}

$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients Files | HMDT </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="reception.css">
    
    <!-- Favicons -->
    <link href="../img/favicon_io/favicon.ico" rel="imges/x-icon">
    <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body style="background-color:#DCF0EE ;">

    <!-- logo, logout btn-->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-lg-4 col-md-4 col-sm-4">
            </div>
            <!-- logo -->
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div style="width: 180px;height: 120px"><img style="width: 180px;height: 120px" src="../img/logo.png" alt=""></div>
            </div>
            <!-- log out btn -->
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-1 col-md-1 col-sm-1">
                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                    <a class="dropdown-item d-flex align-items-center" href="../login_page/logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </h5>
            </div>
            
        </div>  
    </div> 
    

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
            
                    <div class="card" style="background-color: #DCF0EE; border: none">
                        <div class="card-body" style="background-color: #DCF0EE">
                        <div class="row">
                            <div class="col-lg-3">
                                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">PATIENT FILES</h5>
                            </div>
                        <div class="col-lg-6"></div>
                            <div class="col-lg-3">
                                <div class="search-bar">
                                <form class="search-form d-flex align-items-center" method="POST">
                                    <input type="text" name="search" placeholder="Search" title="Enter search keyword">
                                    <button type="submit" name="send" title="Search"><i class="bi bi-search"></i></button>
                                </form>
                                </div> <!-- End Search Bar -->
                            </div>
                        </div>   


        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
            <div class="row">
                <!-- <div class="col-lg-1"></div> -->
                <div style="font-weight: bold" class="col-lg-4 col-sm-3">Patient Name</div>
                <div style="font-weight: bold" class="col-lg-3 col-sm-3">Patient Number</div>
                <div style="font-weight: bold" class="col-lg-2 col-sm-2">Print Barcode</div>
                <div style="font-weight: bold" class="col-lg-2 col-sm-4">Create Barcode</div>
            </div>
        </div>  

        <?php

        //to check if the user didnt search the patients name then all the patients files will be displayed
        if(!isset($_POST['send'])){
            require_once '../db/db.inc.php';
            $sql = $pdo->prepare("SELECT * FROM patients");
            $sql->execute();
            $rows = $sql->fetchAll();

            foreach($rows as $info){

                $patient_id = $info['patient_id'];

                $sqll = $pdo->prepare("SELECT * FROM checkin WHERE patient_id='$patient_id'");
                $sqll->execute();
                $rowss22 = $sqll->fetch();
                ?>
            <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                <div class="row">
                    <div style="font-weight: bold" class="col-lg-4 col-sm-3"><?php echo $info['patient_name']; ?></div>
                    <div style="font-weight: bold" class="col-lg-3 col-sm-3"><?php echo $info['patient_code']; ?></div>
                    <div class="col-lg-2 col-sm-2">


                        <!-- to print the barcode  -->
                        <?php 
                        //check if the patient has a barcode saved in the db
                        if(!empty($rowss22['barcode_text'])){?> 

                        <img src="barcode.php?text=<?php echo $rowss22['barcode_text']; ?> &codetype=<?php echo $rowss22['barcode_type']; ?>&orientation=<?php echo $rowss22['barcode_display']; ?>&size=<?php echo $rowss22['barcode_size']; ?>&print=<?php  echo $rowss22['print_text']; ?>" alt="" style="width: 80px;height: 80px">
                        
                        <?php
                        }else{
                            echo "Barcode Not Found";} ?></div>

                            <!-- to create new barcode  -->
                            <div class="col-lg-2 col-sm-4">
                            <?php if(empty($rowss22['barcode_text'])){ ?>
                            <a style="background-color: #329287;border: 1px solid #329287" href="add_barcode.php?patient_code=<?php echo $info['patient_code']; ?>&patient_id=<?php echo $info['patient_id']; ?>" class="btn btn-primary"><i class="bi bi-plus"></i> Add Barcode</a> 
                            <?php }else{ ?>
                                <a style="background-color: #329287;border: 1px solid #329287" href="print_barcode.php?text=<?php echo $rowss22['barcode_text']; ?>&codetype=<?php echo $rowss22['barcode_type']; ?>&orientation=<?php echo $rowss22['barcode_display']; ?>&size=<?php echo $rowss22['barcode_size']; ?>&print=<?php  echo $rowss22['print_text']; ?>" class="btn btn-primary"  target="_blank"><i class="bi bi-file-text"></i> Print Barcode</a> 
                            <?php } ?>
                        </div>
                    </div>
                </div>  
                
                <!-- if the user searched the patient  -->
                <?php }} 
                else{
                    require_once '../db/db.inc.php';
                    $search = $_POST['search'];
                    $sql = $pdo->prepare("SELECT * FROM patients WHERE (patient_name LIKE ? OR patient_code LIKE ?)");
                    // Sanitize the search input by binding it as a parameter
                    $searchParam = "%$search%";
                    $sql->bindParam(1, $searchParam);
                    $sql->bindParam(2, $searchParam);
                    
                    // Execute the prepared statement 
                    $sql->execute();
                    $rows = $sql->fetchAll();

                        foreach($rows as $info){

                            $patient_id = $info['patient_id'];
            
                            $sqll = $pdo->prepare("SELECT * FROM checkin WHERE patient_id='$patient_id'");
                            $sqll->execute();
                            $rowss22 = $sqll->fetch();
                            ?>
                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                            <div class="row">
                                <div style="font-weight: bold" class="col-lg-4 col-sm-3"><?php echo $info['patient_name']; ?></div>
                                <div style="font-weight: bold" class="col-lg-3 col-sm-3"><?php echo $info['patient_code']; ?></div>
                                <div class="col-lg-2 col-sm-2">
            
            
                                    <!-- to print the barcode  -->
                                    <?php 
                                    //check if the patient has a barcode saved in the db
                                    if(!empty($rowss22['barcode_text'])){?> 
            
                                    <img src="barcode.php?text=<?php echo $rowss22['barcode_text']; ?> &codetype=<?php echo $rowss22['barcode_type']; ?>&orientation=<?php echo $rowss22['barcode_display']; ?>&size=<?php echo $rowss22['barcode_size']; ?>&print=<?php  echo $rowss22['print_text']; ?>" alt="" style="width: 80px;height: 80px">
                                    
                                    <?php
                                    }else{
                                        echo "Barcode Not Found";} ?></div>
            
                                        <!-- to create new barcode  -->
                                        <div class="col-lg-2 col-sm-4">
                                        <?php if(empty($rowss22['barcode_text'])){ ?>
                                        <a style="background-color: #329287;border: 1px solid #329287" href="add_barcode.php?patient_code=<?php echo $info['patient_code']; ?>&patient_id=<?php echo $info['patient_id']; ?>" class="btn btn-primary"><i class="bi bi-plus"></i> Add Barcode</a> 
                                        <?php }else{ ?>
                                            <a style="background-color: #329287;border: 1px solid #329287" href="print_barcode.php?text=<?php echo $rowss22['barcode_text']; ?>&codetype=<?php echo $rowss22['barcode_type']; ?>&orientation=<?php echo $rowss22['barcode_display']; ?>&size=<?php echo $rowss22['barcode_size']; ?>&print=<?php  echo $rowss22['print_text']; ?>" class="btn btn-primary"  target="_blank"><i class="bi bi-file-text"></i> Print Barcode</a> 
                                        <?php } } } ?>
                                    </div>
                                </div>
                            </div>  

        </div>
    </div>

    </div>
</div>
</section>

</main>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>