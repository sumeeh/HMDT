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
    <title>Add Barcode | HMDT </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="../login_page/style.css">
    
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

<body>
<?php
$patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;
$patient_code = isset($_GET['patient_code']) && is_numeric($_GET['patient_code']) ? intval($_GET['patient_code']) : 0; 
?>

    <main>
        <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">

            <!-- back arrow icon -->
            <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                    <a class="dropdown-item d-flex align-items-center" href="receptionist.php" style="width: 50px;height: 50px">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </h5>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                
            </div>
            <!-- logout btn  -->
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-1 col-md-1 col-sm-1">
                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                    <a class="dropdown-item d-flex align-items-center" href="../login_page/logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </h5>
            </div>
            
        </div>     
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="#" class="align-items-center w-auto" style="text-decoration: none">
                    <img style="width: 300px;height: 200px" src="../img/logo.png" alt="">    
                    <p class="text-center small" style="color: #329287;font-weight: bold;font-size: 16px">Hospital Medications Delivery Tracker</p>    
                    </a>
                </div><!-- End Logo -->


                    <?php 
                    include('../db/db.inc.php');
                    $stmte = $pdo->prepare("SELECT * FROM receptioniest WHERE user_id='$id'");
                    $stmte->execute();
                    $rowsZz = $stmte->fetch();
                    $counts = $stmte->rowCount();

                    $receptioniest_id = $rowsZz['receptioniest_id'];

                    if(isset($_POST['add'])){

                        include('../db/db.inc.php');

                        
                        $stmt4 = $pdo->prepare("SELECT * FROM patients WHERE patient_id = '$patient_id'");
                        $stmt4->execute();
                        $rows4 = $stmt4->fetch();
                        $count4 = $stmt4->rowCount();
                        $patient_id = $rows4['patient_id'];

                        //connect the barcode to the db
                        $barcodeText = trim($_POST['user_code']);
                        $barcodeType=$_POST['barcodeType'];
                        $barcodeDisplay=$_POST['barcodeDisplay'];
                        $barcodeSize=$_POST['barcodeSize'];
                        $printText=$_POST['printText'];


                            $sql = "INSERT INTO checkin (receptioniest_id , barcode_text , barcode_type , barcode_display , barcode_size , print_text , patient_id) VALUES ('$receptioniest_id' , '$barcodeText' , '$barcodeType' , '$barcodeDisplay' , '$barcodeSize' , '$printText' , '$patient_id')";

                            $pdo->exec($sql);

                            echo '<div class="container" style="font-family:cairo">
                            <div class="alert alert-info role="alert" style="color:#black;text-align:center;margin-bottom:10px;font-family:cairo">
                                Patient QR Code Created Successfully </div>
                            </div>';
                
                        }
                    

                    
                    ?>

            <section>

        <div class="card mb-3" style="background-color: #DCF0EE;border: none">
            <div class="card-body">


                <?php 
                            include('../db/db.inc.php');

                            $stmt3 = $pdo->prepare("SELECT * FROM patients WHERE patient_code = '$patient_code'");
                            $stmt3->execute();
                            $rows3 = $stmt3->fetchAll();
                            $count3 = $stmt3->rowCount();

                            foreach ($rows3 as $info){
                                ?>

                    
                                <div class="row">
                                    <div class="col-lg-12 col-sm-1"></div>
                                    <h4 style ="font-weight: bold;color: #329287;text-align:center">Confirm Adding Barcode To The Patient</h4>
                                    <div style="border-radius: 5px;padding: 5px;line-height: 2.2; display:flex; align-item:center; justify-content:center" class="col-lg-13 col-sm-10">
                                        <ul>
                                            <span style="font-weight: bold;color: #329287">Patient name:</span> <?php echo $info['patient_name']; ?> <br/>
                                            <span style="font-weight: bold;color: #329287">Patient code:</span> <?php echo $info['patient_code']; ?> <br/>
                                        </ul>
                                    </div>
                                </div>  

                    <?php 
                            }
                            ?>

                <form method="post" class="row g-3 needs-validation" novalidate> 
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <input type="hidden" name="barcodeType" id="barcodeType" value="code39">
                            <input type="hidden" name="barcodeDisplay" id="barcodeDisplay" value="horizontal">  
                            <input type="hidden" name="barcodeSize" id="barcodeSize" value="20">
                            <input type="hidden" name="printText" id="printText" value="true"> 
                            <input type="hidden" name="user_code" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required value="<?php echo $patient_code; ?>">
                            


                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-3"></div>
                                <button class="btn btn-primary" name="add" style="background-color: #75D5CA;border: 1px solid #75D5CA;border-radius: 20px;width: 180px" type="submit">Create Barcode</button>
                        </div>    
                        <div class="col-lg-5"></div> 
                        </div>   
                    </div>
                </form>

                    </div>
                </div>

                </div>
            </div>
        </div>

        </section>

        </div>
    </main>
    

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>