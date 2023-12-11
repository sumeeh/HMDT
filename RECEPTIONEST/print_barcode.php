<?php

session_start();
if(!(isset($_SESSION['password']))){
	header('Location:login.php');
}

$id = $_SESSION['user_id'];

?>
<html>
<head>
    <style>
        body {
            text-align: center;
        }

        #div {
            color: #000;
            background-color: #FFF;
            align-content: center;
            text-align: center;
        }
    </style>
    <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">    
    </head>
    <body onload="print_barcode()">
    <div id="div">
        <?php
        
        $text = isset($_GET['text']) ? $_GET['text'] : 0; 
        $codetype = isset($_GET['codetype']) ? $_GET['codetype'] : 0; 
        $orientation = isset($_GET['orientation']) ? $_GET['orientation'] : 0; 
        $size = isset($_GET['size']) ? $_GET['size'] : 0; 
        $print = isset($_GET['print']) ? $_GET['print'] : 0; 
        
        ?>
        <h4>Patient Barcode</h4>
        <img src="barcode.php?text=<?php echo $text; ?>&codetype=<?php echo $codetype; ?>&orientation=<?php echo $orientation; ?>&size=<?php echo $size; ?>&print=<?php  echo $print; ?>" alt="" style="width: 80px;height: 80px">
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
    <script>
        function print_barcode(){   
        var createpdf = document.getElementById("div");
        var opt = {
            margin: 1,
            filename: 'patient_barcode.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().set(opt).from(createpdf).save();       
        }
    </script>
</body>
</html> 