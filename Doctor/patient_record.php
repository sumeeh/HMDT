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
    <title>Ptient's Records | HMDT </title>
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

<?php $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0; ?>

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
                    <!-- title ? -->
                <div class="card" style="background-color: #DCF0EE; border: none;">
                    <div class="card-body" style="background-color: #DCF0EE">
                    <div class="row">
                        <div class="col-lg-3">
                            <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">PATIENT RECORD</h5>
                        </div>
                        </div>
                    </div> 

                    <?php
                    include('../db/db.inc.php');
                    $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

                    $stmt1 = $pdo->prepare("SELECT * FROM patients WHERE patient_id='$patient_id'");
                    $stmt1->execute();
                    $rows1 = $stmt1->fetch();
                    $count1 = $stmt1->rowCount();

                    ?>

            <!-- patient info  -->
            <div class="col-lg-12" style="border-radius: 10px;background-color: #fff;border: 1px solid #ccc;padding: 10px;margin-bottom: 5px">
                <div class="row">
                    <div class="col-lg-1 col-sm-1"></div>
                    <div style="font-weight: bold" class="col-lg-1 col-sm-2"><img src="../img/admin.png"></div>
                    <div style="font-weight: bold;background-color: #EAF6F4;line-height: 2.2;border-radius: 5px" class="col-lg-9 col-sm-8">
                        <span style="font-weight: bold;color: #329287">Name:</span> <?php echo $rows1['patient_name']; ?> <br/>
                        <span style="font-weight: bold;color: #329287">ID:</span> <?php echo $rows1['patient_code']; ?>
                    </div>
                </div>
            </div>

            <!-- symptops  -->
            <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div style="font-weight: bold;line-height: 2.2" class="col-lg-9">
                            <span style="color: #329287;font-weight: bold">Symptoms</span>
                            <ul>
                    

            <?php 
            include('../db/db.inc.php');

            $stmte = $pdo->prepare("SELECT * FROM patient_files WHERE patient_id='$patient_id'");
            $stmte->execute();
            $rows2 = $stmte->fetchAll();

            foreach ($rows2 as $info){
                ?>

            <li style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;list-style: none"><?php if(!empty($info['symptoms'])){echo $info['symptoms'];}else{echo "Not Found";} ?></li>
                            
                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>  
            

                <!-- Diagnosis  -->
                <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div style="font-weight: bold;line-height: 2.2" class="col-lg-9">
                            <span style="color: #329287;font-weight: bold">Diagnosis</span>
                            <ul>

                            <?php 
                                include('../db/db.inc.php');

                                $stmts = $pdo->prepare("SELECT * FROM patient_files WHERE patient_id='$patient_id'");
                                $stmts->execute();
                                $rows3 = $stmts->fetchAll();

                                foreach ($rows3 as $info){
                            ?>
                                <li style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;list-style: none"><?php if(!empty($info['diagnosis'])){echo $info['diagnosis'];}else{echo "Not Found";} ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>  
                

                

                <!-- cronic diseases  -->
                <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div style="font-weight: bold;line-height: 2.2" class="col-lg-9">
                            <span style="color: #329287;font-weight: bold">Chronic Diseases And Allergies</span>
                            <ul>
                            <?php 
                                include('../db/db.inc.php');

                                $stmt4 = $pdo->prepare("SELECT * FROM patient_files WHERE patient_id='$patient_id'");
                                $stmt4->execute();
                                $rows4 = $stmt4->fetchAll();

                                foreach ($rows4 as $info){
                                ?>

                                <li style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;list-style: none"> Chronic Diseases : <?php if(!empty($info['chronic_diseases'])){echo $info['chronic_diseases'];}else{echo "Not Found";} ?></li>
                                <li style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;list-style: none">Allergies : <?php if(!empty($info['allergies'])){ echo $info['allergies']; }else{echo "Not Found";} ?></li>

                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>



                <!-- add meds -->
                <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-2 col-sm-4"><span style="color: #329287;font-weight: bold">Add Medication</span></div>
                            <div class="col-lg-9 col-sm-7"></div>
                            <div class="col-lg-1 col-sm-1">
                                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                                    <a class="dropdown-item d-flex align-items-center" href="add_medicine.php?patient_id=<?php echo $patient_id; ?>" style="border: 1px solid #329287;padding: 10px;border-radius: 50%;width: 50px;height: 50px">
                                        <i class="bi bi-plus"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-sm-1"></div>
                            <div style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2" class="col-lg-9 col-sm-10">
                                <ul>

                        <?php
                        include('../db/db.inc.php');

                        $stmt9 = $pdo->prepare("SELECT * FROM medicine WHERE patient_id='$patient_id' ORDER BY Date DESC LIMIT 1");                        
                        $stmt9->execute();
                        $rows9 = $stmt9->fetchAll(); 

                        foreach ($rows9 as $info){

                            $stmt10 = $pdo->prepare("SELECT * FROM patient_files WHERE patient_id='$patient_id'");
                            $stmt10->execute();
                            $rows10 = $stmt10->fetch();

                        ?>
                                    <span style="font-weight: bold;color: #329287">Medcicne Name:</span> <?php echo $info['medicine_name']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Diagnosis:</span> <?php echo $info['diagnosis']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Dose:</span> <?php echo $info['dose']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Frequency:</span> <?php echo $info['frequency']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Description:</span> <?php echo $info['description']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Time:</span> <?php echo $info['time']; ?> <br/>
                                    <span style="font-weight: bold;color: #329287">Date:</span> <?php echo $info['Date']; ?> <br/>

                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                        <div class="col-lg-2" style="position: relative; left:970px">
                            <button name="more" class="btn btn-primary" style="background-color: #75D5CA;border: 1px solid #75D5CA;border-radius: 20px;width: 180px;margin-top:10px" type="submit"><a href="all_meds.php?patient_id=<?php echo $patient_id ?>" style="text-decoration: none; color:white">View More</a></button>
                        </div>    
                        <div class="col-lg-4"></div> 
                </div>  


                        <?php 
                        if (isset($_POST['add_note'])) {
                            include('../db/db.inc.php');
                        
                            $note = $_POST['note'];
                            $patient_id = $_POST['patient_id'];
                        
                            $stmt = $pdo->prepare("SELECT * FROM doctors WHERE user_id='$id'");
                            $stmt->execute();
                            $rows = $stmt->fetch();
                            $count = $stmt->rowCount();
                        
                            $doctor_id = $rows['doctor_id'];
                            $date = date('Y-m-d');
                            $time = date("H:i");
                        
                            $sql = $pdo->prepare("UPDATE patient_files SET notes = ?, doctor_id = ?, notes_date = ?, notes_time = ? WHERE patient_id = ?");
                            $sql->execute(array($note, $doctor_id, $date, $time, $patient_id));
                        
                            echo '<div class="container" dir="ltr" style="margin-top:30px;color:#FFF;margin-bottom:30px;font-family:cairo">
                                    <div class="alert alert-info role="alert" style="color:black;text-align:center;margin-bottom:40px;font-family:cairo">
                                        Doctor Notes Added Successfully
                                    </div>
                                </div>';  

                        }
                        ?>
                        
                        <!-- add note  -->
                            <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-3"><span style="color: #329287;font-weight: bold">Add Note</span></div>
                                        <div class="col-lg-9 col-sm-8"></div>
                                        <div class="col-lg-1 col-sm-1">
                                            <form method="post">
                                            <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                                                <button type="submit" name="add_note" class="dropdown-item d-flex align-items-center" style="border: 1px solid #329287;padding: 10px;border-radius: 50%;width: 50px;height: 50px">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-1"></div>
                                        <div style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2" class="col-lg-9 col-sm-10">
                                                <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>">
                                                <textarea name="note" style="background-color: #EAF6F4" class="form-control" cols="4" rows="4" placeholder="Write Your Notes" required></textarea>
                                            </form>
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

</main>


    

    
</body>
</html>