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
    <title>Add Meds | HMDT </title>
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
                        <a class="dropdown-item d-flex align-items-center" href="patient_record.php?patient_id=<?php echo $patient_id; ?>" style="width: 50px;height: 50px">
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

    <main>
        <div class="container">

    
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">

                
                <?php
                
                if(isset($_POST['add'])){

                    $patient_id = $_POST['patient_id'];
                    $diagnosis = $_POST['diagnosis'];
                    $desc = $_POST['desc'];
                    $meds = $_POST['meds'];
                    $dose = $_POST['dose'];
                    $time = $_POST['time'];
                    $frequency = $_POST['frequency'];
                    $start_date = $_POST['start'];
                    $end_date = $_POST['end'];

                    include('../db/db.inc.php');

                    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE user_id='$id'");
                    $stmt->execute();
                    $rows = $stmt->fetch();
                    $count = $stmt->rowCount();

                    $doctor_id = $rows['doctor_id'];

                    // to create a file for the patient

                    $sql = "UPDATE patient_files SET diagnosis = CONCAT( diagnosis , ', $diagnosis') WHERE patient_id = '$patient_id'";
                    $pdo->exec($sql);

                    $sql2 = "UPDATE patient_files SET meds = CONCAT( meds , ', $meds') WHERE patient_id = '$patient_id'";
                    $pdo->exec($sql2);



                    // $sql = "INSERT INTO patient_files (diagnosis, doctor_id, patient_id) VALUES ('$diagnosis', 'test', 'test', 'test', 'test', '$doctor_id', '$patient_id')";


                    $stmt2 = $pdo->prepare("SELECT * FROM patient_files WHERE patient_id='$patient_id'");
                    $stmt2->execute();
                    $rows2 = $stmt2->fetch();
                    $count2 = $stmt2->rowCount();

                    $file_id = $rows2['file_id'];


                    $startDate = new DateTime($start_date);
                    $endDate = new DateTime($end_date);

                    $currentDate = clone $startDate;
                    while ($currentDate <= $endDate) {
                        $formattedDate = $currentDate->format('Y-m-d');

                        $sql = "INSERT INTO medicine (medicine_name , dose, frequency , time , description , doctor_id , patient_id , file_id, Date, diagnosis) VALUES ('$meds' , '$dose', '$frequency' , '$time' , '$desc' , '$doctor_id' , '$patient_id' , '$file_id', '$formattedDate', '$diagnosis')";

                        $pdo->exec($sql);

                        $stmt3 = $pdo->prepare("SELECT * FROM checkin WHERE patient_id='$patient_id'");
                        $stmt3->execute();
                        $rows3 = $stmt3->fetch();
                        $count3 = $stmt3->rowCount();

                        $barcode_id = $rows3['checkin_id'];

                        $sqll = "INSERT INTO follow_up_record (barcode_id, patient_id, status, meds_time, meds, Date) VALUES ('$barcode_id', '$patient_id', '0', '$time', '$meds', '$formattedDate')";

                        $pdo->exec($sqll);

                        // Increment the current date by 1 day
                        $currentDate->modify('+1 day');
                    }


                    echo '<div class="container" style="margin-top:80px;color:#000">
                            <div class="alert alert-success role="alert" style="color:#000">
                            Diagnosis And Medicine For This Patient Added Successfully
                            </div>
                        </div>';  
                }

                ?>


                <div class="card mb-3" style="background-color: #DCF0EE;border: none">

                    <div class="card-body">
                    <form class="row g-3 needs-validation" method="post">

                        <div class="col-lg-6 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Diagnosis</label>
                        <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">    
                        <div class="input-group has-validation">
                            <textarea type="text" name="diagnosis" class="form-control" cols="4" style="background-color: #75D5CA;border-radius: 10px;height: 300px" id="yourUsername" required></textarea>
                            <div class="invalid-feedback">Please enter Patient Diagnosis.</div>
                        </div>
                        </div>
                        
                        <div class="col-lg-6 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine Description</label>
                        <div class="input-group has-validation">
                            <textarea type="text" name="desc" class="form-control" cols="4" style="background-color: #75D5CA;border-radius: 10px;height: 300px" id="yourUsername"></textarea>
                            <div class="invalid-feedback">Please enter Patient Medicine Description.</div>
                        </div>
                        </div> 
                    
                        <div class="col-lg-12 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine Name</label>
                        <div class="input-group has-validation">
                            <input type="text" name="meds" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter Patient Medicine Name.</div>
                        </div>
                        </div> 
                        
                        <div class="col-lg-12 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine Dose</label>
                        <div class="input-group has-validation">
                            <input type="text" name="dose" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter Patient Medicine Dose.</div>
                        </div>
                        </div> 
                        
                        <div class="col-lg-12 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine Time</label>
                        <div class="input-group has-validation">
                            <input type="time" name="time" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter Patient Medicine Time.</div>
                        </div>
                        </div>   

                        <div class="col-lg-12 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine Frequency</label>
                        <div class="input-group has-validation">
                            <input type="text" name="frequency" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter Patient Medicine Frequency.</div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine startdate</label>
                        <div class="input-group has-validation">
                            <input type="date" name="start" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter Patient Medicine startdate.</div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter Patient Medicine enddate</label>
                        <div class="input-group has-validation">
                            <input type="date" name="end" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter Patient Medicine enddate.</div>
                        </div>

                        </div>     
                        <div class="col-lg-12 col-sm-12">
                        <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-2">
                            <button name="add" class="btn btn-primary" style="background-color: #75D5CA;border: 1px solid #75D5CA;border-radius: 20px;width: 180px;margin-top:10px" type="submit">Add Medicine</button>
                        </div>    
                        <div class="col-lg-4"></div> 
                        </div>   
                        </div>
                    </form>
        
                        </div>
        
                    </div>
                    </div>
                </div>
        
                </section>
        
            </div>
            </main>

    
</body>
</html>