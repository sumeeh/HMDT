<?php
//link to other file that has a session started inside it bc its safer than starting the session in the same file
require_once '../includes/config_session.inc.php';

//this code prevents anyone from entering the page without logging in
if (!(isset($_SESSION['password']))) {
    header('Location: ../login_page/login.php');
}

$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Barcode | HMDT </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="nurse.css">

    <!-- Favicons -->
    <link href="../img/favicon_io/favicon.ico" rel="icon">
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


    <div id="main">
        <div class="section">
            <div class="card-body">
                <div id="scanner-container" style="position: absolute;left:312px"></div>
                <div id="results"></div>
            </div>
        </div>
    </div>



    <?php
    include('../db/db.inc.php');
    $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/quagga"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function startScanner() {
            var scannerContainer = document.getElementById("scanner-container");
            var resultsContainer = document.getElementById("results");

            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: scannerContainer,
                    constraints: {
                        facingMode: "environment" // Use the rear camera (if available)
                    },
                },
                decoder: {
                    readers: ["ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader"]
                }
            }, function (err) {
                if (err) {
                    console.error(err);
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected(function (result) {
                var code = result.codeResult.code;
                resultsContainer.innerHTML = "Scanned Barcode: " + code;

                // Redirect to the barcode page with the scanned barcode as a query parameter
                var url = "nursePatient_file.php?barcode=" + encodeURIComponent(code) + "&patient_id=<?php echo $patient_id; ?>";
                window.location.href = url;
            });
        }

        // Check if the browser supports camera access
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    // The camera is accessible
                    startScanner();
                })
                .catch(function (error) {
                    console.error("Camera access error:", error);
                    // The camera is not accessible, handle the error
                });
        } else {
            console.error("getUserMedia() is not supported by this browser.");
            // Browser does not support getUserMedia, handle the error
        }
    </script>


<input type="hidden" name="patient_id" value="<?php echo $patient_id ?>">


</body>

</html>