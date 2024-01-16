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
    <title>Meds Follow-up | HMDT </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="doctor.css">
    
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
    <!-- logo, logout btn, back btn -->
    <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <!-- back btn  -->
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                        <a class="dropdown-item d-flex align-items-center" href="patients_home.php" style="width: 50px;height: 50px">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </h5>
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
                    <div class="col-lg-6">
                        <?php
                
                            include('../db/db.inc.php');  
                            $stmt = $pdo->prepare("SELECT * FROM patients");
                            $stmt->execute();
                            $rowsZ = $stmt->fetchAll();
                            $count = $stmt->rowCount();

                            ?>   
                    <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">Current Registered Patients <?php if($count != 0){echo $count;}else{echo "0";} ?></h5>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <div class="search-bar">
                        <form class="search-form d-flex align-items-center" method="POST">
                            <input type="text" name="search" placeholder="Search" title="Enter search keyword">
                            <button type="submit" name="send" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                        </div><!-- End Search Bar --> 
                    </div>
                </div> 


                <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2">Patient's ID</div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2">Patient's Name</div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-2">Meds</div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-1">Time</div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-1">Date</div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2">Status</div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-2">Details</div>
                        <div style="font-weight: bold; " class="col-lg-1 col-sm-2">Nurse Notes</div>
                        </div>
                        </div>
                <?php
                
            if (!isset($_POST['send'])) {
                include('../db/db.inc.php');
                $sql = $pdo->prepare("SELECT follow_up_record.*, patients.patient_name, patients.patient_code FROM follow_up_record INNER JOIN patients ON patients.patient_id = follow_up_record.patient_id ORDER BY follow_up_record.follow_up_record_id DESC");
                $sql->execute();
                date_default_timezone_set('Asia/Riyadh');
                $rows = $sql->fetchAll();
            
                    foreach ($rows as $info) {
                        $status = $info['status'];
                        $today = date('Y-m-d');
                        $db_date = $info['Date'];
                        $time_now = date("H:i");
                        $meding_time = date("H:i", strtotime($info['meds_time']));
                        $timeNow_Plus10 = date("H:i", strtotime(' + 10 minutes', strtotime($meding_time)));
                    
                        // Check if current time is later than the set time and update the status to "Late"
                        if (strtotime($time_now) > strtotime($timeNow_Plus10) && $today == $db_date && $status == 0) {
                            $timeNow_Plus1h = date("H:i", strtotime('+1 hour', strtotime($meding_time)));
                            if (strtotime($time_now) > strtotime($timeNow_Plus1h)) {
                                $status = 2; // Update the status to "Late"
                                include('../db/db.inc.php');
                                $stmt = $pdo->prepare("UPDATE follow_up_record SET status = ? WHERE follow_up_record_id = ?");
                                $stmt->execute(array($status, $info['follow_up_record_id']));
                            }
                        }
                        
                    
                    ?>


            <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-2"><?php echo $info['patient_name']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2"><?php echo $info['meds']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-2"><?php echo $info['meds_time']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2"><?php echo $info['Date']; ?></div>
                        
                        <?php if($info['status'] == 1){ ?>
                            <div style="font-weight: bold;padding: 5px;border-radius: 5px;background-color: #CAEAE5;color: #329287;text-align: center" class="col-lg-2 col-sm-2">
                            Complete
                            </div>
                        <?php }elseif($info['status'] == 2){ ?>
                            <div style="font-weight: bold;padding: 5px;border-radius: 5px;background-color: #F5BCB9;color: red;text-align: center" class="col-lg-2 col-sm-2">
                            Late
                            </div>
                        <?php }elseif($info['status'] == 0){ ?>
                            <div style="font-weight: bold;padding: 5px;border-radius: 5px;background-color: #B9DCF6;color: blue;text-align: center" class="col-lg-2 col-sm-2">
                            In Progress
                            </div>
                        <?php } ?>
                        <div style="font-weight: bold;font-size: 25px;color: #329287; text-align:center" class="col-lg-1 col-sm-1"><a title="view Meds Info" style="color: #329287;font-size: 28px;font-weight: bold" href="patient_file.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-list"></i></a></div>
                        <div style="font-weight: bold;color: #329287; text-align:center" class="col-lg-1 col-sm-2"><a style="color: #329287;font-weight: bold;font-size:25px" href="nurse_notes.php?patient_id=<?php echo $info['patient_id']; ?>&nurse_id=<?php echo $info['nurse_id']; ?>"><i class="bi bi-file-text"></i></a></div>
                    </div>
                </div>             
                <?php } ?> 

                <?php }else{
                    include('../db/db.inc.php');

                    $search = $_POST['search'];
                    
                    // Prepare the SQL statement with placeholders
                    $sql = $pdo->prepare("SELECT follow_up_record.*, patients.patient_name, patients.patient_code FROM follow_up_record INNER JOIN patients ON patients.patient_id = follow_up_record.patient_id WHERE (patients.patient_name LIKE ? OR patients.patient_code LIKE ?)");
                    
                    // Sanitize the search input by binding it as parameters
                    $searchParam = "%$search%";
                    $sql->bindParam(1, $searchParam);
                    $sql->bindParam(2, $searchParam);
                    
                    // Execute the prepared statement
                    $sql->execute();
                    
                    // Fetch the results
                    date_default_timezone_set('Asia/Riyadh');
                    $rows = $sql->fetchAll();
                
                        foreach ($rows as $info) {
                            $status = $info['status'];
                            $today = date('Y-m-d');
                            $db_date = $info['Date'];
                            $time_now = date("H:i");
                            $meding_time = date("H:i", strtotime($info['meds_time']));
                            $timeNow_Plus10 = date("H:i", strtotime(' + 10 minutes', strtotime($meding_time)));
                        
                            // Check if current time is later than the set time and update the status to "Late"
                            if (strtotime($time_now) > strtotime($timeNow_Plus10) && $today == $db_date && $status == 0) {
                                $timeNow_Plus1h = date("H:i", strtotime('+1 hour', strtotime($meding_time)));
                                if (strtotime($time_now) > strtotime($timeNow_Plus1h)) {
                                    $status = 2; // Update the status to "Late"
                                    include('../db/db.inc.php');
                                    $stmt = $pdo->prepare("UPDATE follow_up_record SET status = ? WHERE follow_up_record_id = ?");
                                    $stmt->execute(array($status, $info['follow_up_record_id']));
                                }
                            }
    
                        ?> 
                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                    <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2"><?php echo $info['patient_code']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-2"><?php echo $info['patient_name']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2"><?php echo $info['meds']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-1 col-sm-2"><?php echo $info['meds_time']; ?></div>
                        <div style="font-weight: bold; text-align:center" class="col-lg-2 col-sm-2"><?php echo $info['Date']; ?></div>

                        
                        <?php if($info['status'] == 1){ ?>
                            <div style="font-weight: bold;padding: 5px;border-radius: 5px;background-color: #CAEAE5;color: #329287;text-align: center" class="col-lg-2 col-sm-2">
                            Complete
                            </div>
                        <?php }elseif($info['status'] == 2){ ?>
                            <div style="font-weight: bold;padding: 5px;border-radius: 5px;background-color: #F5BCB9;color: red;text-align: center" class="col-lg-2 col-sm-2">
                            Late
                            </div>
                        <?php }elseif($info['status'] == 0){ ?>
                            <div style="font-weight: bold;padding: 5px;border-radius: 5px;background-color: #B9DCF6;color: blue;text-align: center" class="col-lg-2 col-sm-2">
                            In Progress
                            </div>
                        <?php } ?>
                        <div style="font-weight: bold;font-size: 25px;color: #329287; text-align:center" class="col-lg-1 col-sm-1"><a title="view Meds Info" style="color: #329287;font-size: 28px;font-weight: bold" href="patient_file.php?patient_id=<?php echo $info['patient_id']; ?>"><i class="bi bi-list"></i></a></div>
                        <div style="font-weight: bold;color: #329287; text-align:center" class="col-lg-1 col-sm-2"><a style="color: #329287;font-weight: bold;font-size:25px" href="nurse_notes.php?patient_id=<?php echo $info['patient_id']; ?>&nurse_id=<?php echo $info['nurse_id']; ?>"><i class="bi bi-file-text"></i></a></div>
                    </div>
                </div>  
                    
                <?php  }} ?>                 

                </div>
            </div>

            </div>
        </div>
        </section>

    </main>
    