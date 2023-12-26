<?php
//link to other file that has a session started inside it bc its safer than starting the session in the same file
require_once '../includes/config_session.inc.php';

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
    <title>Patients | HMDT </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="nurse.css">
    
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
<body style="background-color:#DCF0EE">

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
        
                <div class="card" style="background-color: #DCF0EE;border: none;">
                    <div class="card-body" style="background-color: #DCF0EE">
                    <div class="row">
                        <div class="col-lg-3 col-md-2 col-sm-3">
                            <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">PATIENT FILES</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6"></div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="search-bar">
                            <form class="search-form d-flex align-items-center" method="POST" action="#">
                            <input type="text" name="search" placeholder="Search" title="Enter search keyword">
                                <button type="submit" name="send" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                            </div><!-- End Search Bar -->
                        </div>
                    </div>   
                        
                    <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                        <div class="row">
                            <div class="col-lg-1 col-sm-1"></div>
                            <div style="font-weight: bold" class="col-lg-2 col-sm-3">Patient Name</div>
                            <div class="col-lg-2 col-sm-1"></div>
                            <div style="font-weight: bold" class="col-lg-2 col-sm-4">Patient Number</div>
                            <div class="col-lg-2 col-sm-1"></div>
                        </div>
                    </div>  

                    <?php
                    date_default_timezone_set('Asia/Riyadh');
                    $time_now =  date("h:i");

                    $counting = 0;
                    $counting2 = 0;
                    
                    $counting_status = 0;
                    $counting_status2 = 0;
                
                    if(!isset($_POST['send'])){
                        include('../db/db.inc.php');
                        $stmt = $pdo->prepare("SELECT * FROM patients");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();


                        foreach($rows as $info){
                            $patient_id = $info['patient_id'];


                            $stmte = $pdo->prepare("SELECT * FROM follow_up_record WHERE patient_id='$patient_id'");
                            $stmte->execute();
                            $rowss = $stmte->fetchAll();

                            foreach($rowss as $infoo){

                                $miding_time = date('h:i', strtotime(date('h:i', strtotime($infoo['meds_time'])) . '- 1 hours'));
                                $miding_time_now = date('h:i', strtotime($infoo['meds_time']));
                                $miding_time_10min = date("h:i", strtotime($infoo['meds_time'] . ' + 10 minutes'));


                                if(strtotime($time_now) == strtotime($miding_time_now) || strtotime($miding_time) == strtotime($time_now) || strtotime($miding_time_10min) == strtotime($time_now)){

                                    $counting += 1;
                                    
                                    if($infoo['status' == 0]){
                                        $counting_status = 1;
                                    }

                                }

                            }

                                if($counting > 0 ){
                                    if($counting_status == 1){

                                        ?>

                                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                                            <div class="row">
                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_name']; ?></div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                                                <div class="col-lg-3 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold;position:relative" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-bell"></i><span style="background-color:red;width:20px;height:20px;border-radius:50%;position:absolute;top:-15px;right:-6px;text-align:center;font-size:10px;color:#FFF !important"><?php echo $counting; ?></span></a> </div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-chevron-right"></i></a> </div>
                                            </div>
                                        </div>  

                    <?php

                                    }else{
                                        ?>
                                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                                            <div class="row">
                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_name']; ?></div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                                                <div class="col-lg-3 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-bell"></i></a> </div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-chevron-right"></i></a> </div>
                                            </div>
                                        </div>  
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                                            <div class="row">
                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_name']; ?></div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                                                <div class="col-lg-3 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-bell"></i></a> </div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-chevron-right"></i></a> </div>
                                            </div>
                                        </div>  
                                    <?php
                            }
                            
                            $counting = 0;  $counting_status = 0;  } 
                        
                        }else{

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


                            $stmte = $pdo->prepare("SELECT * FROM follow_up_record WHERE patient_id='$patient_id'");
                            $stmte->execute();
                            $rowss = $stmte->fetchAll();

                            foreach($rowss as $infoo){

                                $miding_time = date('h:i', strtotime(date('h:i', strtotime($infoo['meds_time'])) . '- 1 hours'));
                                $miding_time_now = date('h:i', strtotime($infoo['meds_time']));

                                if(strtotime($time_now) == strtotime($miding_time_now) || strtotime($miding_time) == strtotime($time_now)){

                                    $counting += 1;
                                    
                                    if($infoo['status' == 0]){
                                        $counting_status = 1;
                                    }

                                }

                            }

                                if($counting > 0 ){
                                    if($counting_status == 1){

                                        ?>

                                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                                            <div class="row">
                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_name']; ?></div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                                                <div class="col-lg-3 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-bell"></i></a> </div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-chevron-right"></i></a> </div>
                                            </div>
                                        </div>  

                    <?php

                                    }else{
                                        ?>
                                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                                            <div class="row">
                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_name']; ?></div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                                                <div class="col-lg-3 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-bell"></i></a> </div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-chevron-right"></i></a> </div>
                                            </div>
                                        </div>  
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px;line-height: 2.2">
                                            <div class="row">
                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_name']; ?></div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                                                <div class="col-lg-3 col-sm-2"></div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-bell"></i></a> </div>
                                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"><a style="color: #329287;font-size: 25px;font-weight: bold" href="patient_barcode.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-chevron-right"></i></a> </div>
                                            </div>
                                        </div>  
                                    <?php
                            }
                            
                            $counting = 0;  $counting_status = 0;  } 
                            
                        }
                    

                    ?>
                        
                    
                        
                    
                        
        
                    </div>
                </div>
        
                </div>
            </div>
            </section>
        
        </main>

</body>
</html>