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
    <title>Nurse Notes | HMDT </title>
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
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                    <a class="dropdown-item d-flex align-items-center" href="meds_followup.php" style="width: 50px;height: 50px">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </h5>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3"><a href="../extrnal/index.php">
                <div style="width: 180px;height: 120px"><img style="width: 180px;height: 120px" src="../img/logo.png" alt=""></div></a>
            </div>
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

            <div class="card" style="background-color: #DCF0EE;border:none">
                <div class="card-body" style="background-color: #DCF0EE">
                <div class="row">
                    <div class="col-lg-3">
                        <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">Nurses Notes</h5>
                    </div>
                    <div class="col-lg-6"></div>
                </div>   
                    
                <?php
                
                include('../db/db.inc.php');
                $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;
                $stmt = $pdo->prepare("SELECT * FROM patients WHERE patient_id='$patient_id'");
                $stmt->execute();
                $rowsZ = $stmt->fetch();
                $count = $stmt->rowCount();

                ?>      
                    
                <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div class="col-lg-1 col-sm-1"></div>
                        <div style="font-weight: bold" class="col-lg-1 col-sm-2"><img src="../img/admin.png"></div>
                        <div style="font-weight: bold;background-color: #EAF6F4;line-height: 2.2;border-radius: 5px" class="col-lg-9 col-sm-8">
                            <span style="font-weight: bold;color: #329287">Name:</span> <?php echo $rowsZ['patient_name']; ?> <br/>
                            <span style="font-weight: bold;color: #329287">ID:</span> <?php echo $rowsZ['patient_code']; ?>
                        </div>
                        <div style="font-weight: bold" class="col-lg-1 col-sm-1"></div>
                    </div>
                </div>  
                    
                <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-2 col-sm-1"></div>
                            <div style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2" class="col-lg-9 col-sm-10">
                                <h4>Nurse Notes</h4>
                                <ul>
                                    <?php

                                    include('../db/db.inc.php');
                                    $sql = $pdo->prepare("SELECT follow_up_record.* , nurses.user_id FROM follow_up_record INNER JOIN nurses ON nurses.nurse_id = follow_up_record.nurse_id WHERE follow_up_record.patient_id='$patient_id'");      
                                    $sql->execute();
                                    $rows = $sql->fetchAll();

                                    foreach($rows as $pat)
                                        {

                                    ?> 
                                    <span style="font-weight: bold;color: #329287">Notes:</span> <?php echo $pat['notes']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Date:</span> <?php echo $pat['date_note']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Time:</span> <?php echo $pat['note_time']; ?> <br/>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div style="font-weight: bold" class="col-lg-1 col-sm-1"></div>
                        </div>
                    </div>
                </div>        

                </div>
            </div>

            </div>
        </div>
    </section>
    
</body>
</html>