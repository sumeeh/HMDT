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
    <title>Ptient's file | HMDT </title>
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
                        <a class="dropdown-item d-flex align-items-center" href="meds_followup.php" style="width: 50px;height: 50px">
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
                        <div class="col-lg-3">
                            <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">PATIENT FILE</h5>
                        </div>
                        </div>

                        <?php
                        include('../db/db.inc.php');
                        $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

                        $stmt = $pdo->prepare("SELECT * FROM patients WHERE patient_id='$patient_id'");
                        $stmt->execute();
                        $rows = $stmt->fetch();
                        $count = $stmt->rowCount();

                        ?>


                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                            <div class="row">
                                <div class="col-lg-1 col-sm-1"></div>
                                <div style="font-weight: bold" class="col-lg-1 col-sm-2"><img src="../img/admin.png"></div>
                                <div style="font-weight: bold;background-color: #EAF6F4;line-height: 2.2;border-radius: 5px" class="col-lg-9 col-sm-8">
                                    <span style="font-weight: bold;color: #329287">Name:</span> <?php echo $rows['patient_name']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">ID:</span> <?php echo $rows['patient_code']; ?>
                                </div>
                                <div style="font-weight: bold" class="col-lg-1"></div>
                            </div>
                        </div>  

                        <?php 
                        include('../db/db.inc.php');
                        $stmte = $pdo->prepare("SELECT * FROM medicine WHERE patient_id='$patient_id'");
                        $stmte->execute();
                        $rows1 = $stmte->fetchAll();

                        foreach($rows1 as $info){
                            $file_id = $info['file_id'];

                            $stmt2 = $pdo->prepare("SELECT * FROM patient_files WHERE file_id='$file_id'");
                            $stmt2->execute();
                            $rows2 = $stmt2->fetch();

                        ?>
                        
                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-1"></div>
                                    <div style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2" class="col-lg-9 col-sm-10">
                                        <ul>
                                        <span style="font-weight: bold;color: #329287">Medcicne Name:</span> <?php echo $info['medicine_name']; ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Diagnosis:</span> <?php echo $rows2['diagnosis']; ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Dose:</span> <?php echo $info['dose']; ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Frequency:</span> <?php echo $info['frequency']; ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Description:</span> <?php echo $info['description']; ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Time:</span> <?php echo $info['time']; ?> <br/>
                                        </ul>
                                    </div>
                                    <div style="font-weight: bold" class="col-lg-1"></div>
                                </div>
                            </div>
                        </div>  

                        <?php } ?>

                        <?php 
                        include('../db/db.inc.php');
                        
                        $stmt4 = $pdo->prepare("SELECT follow_up_record.* , nurses.user_id FROM follow_up_record INNER JOIN nurses ON nurses.nurse_id = follow_up_record.nurse_id WHERE follow_up_record.patient_id='$patient_id'"); 
                        $stmt4->execute();
                        $rows4 = $stmt4->fetchAll();

                        foreach($rows4 as $info){
                            $user_id = $info['user_id'];    

                            $stmt5 = $pdo->prepare("SELECT * FROM users WHERE user_id='$user_id'");
                            $stmt5->execute();
                            $rows5 = $stmt5->fetch();

                        ?>
                        

                        <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                            <div class="row" style="margin-left: 10px">
                                <div class="row" style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2">
                                    <div style="font-weight: bold" class="col-lg-1"></div>
                                    <div style="font-weight: bold" class="col-lg-3"><?php echo $rows5['firstname'] . " " . $rows5['lastname'] ; ?></div>
                                    <div style="font-weight: bold" class="col-lg-1"><?php echo $info['meds']; ?></div>
                                    <div style="font-weight: bold" class="col-lg-2"><?php echo $info['entring_date']; ?></div>
                                    <div style="font-weight: bold" class="col-lg-2"><?php echo $info['meds_time']; ?></div>
                                    <?php if($info['status'] == 1){ ?>
                                            <div style="font-weight: bold" class="col-lg-2" style="border: 1px solid #329287;padding: 10px;border-radius: 50%;width: 50px;height: 50px"><i class="bi bi-check" style="font-size: 25px"></i></div>
                                <?php }elseif($info['status'] == 2){ ?>
                                        <div style="font-weight: bold" class="col-lg-2" style="border: 1px solid #329287;padding: 10px;border-radius: 50%;width: 50px;height: 50px"><i class="bi bi-x" style="font-size: 25px"></i></div>
                                <?php }elseif($info['status'] == 0){ ?>
                                        <div style="font-weight: bold" class="col-lg-2" style="border: 1px solid #329287;padding: 10px;border-radius: 50%;width: 50px;height: 50px">___</div>
                                    <?php } ?>
                                </div>
                            </div>                        
        
                        </div>
                    </div>
        
                    </div>
                </div>
                <?php } ?>


            </section>
        </main>

    
</body>
</html>