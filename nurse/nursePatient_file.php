<<?php
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
    <title>Patient File | HMDT </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="nurse.css">
    
    <!-- Favicons -->
    <link href="../img/favicon_io/favicon.ico" rel="imges/x-icon">
    <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-ipdos/bootstrap-ipdos.css" rel="stylesheet">
    <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="prepdonect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body style="background-color:#DCF0EE">

    
<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php
                    

                    $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;
                    
                ?>
                <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">
                    <a class="dropdown-item d-flex align-items-center" href="patients_home.php" style="width: 50px;height: 50px">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </h5>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3"><a href="#">
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
                            <h5 class="card-title" style="color: #329287;letter-spacing:normal;font-size: 30px">PATIENT FILE</h5>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                        
                    <?php
                        
                        if(isset($_POST['add_note'])){
                            $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

                        
                            include('../db/db.inc.php');
                            
                            $note = $_POST['notes']; 
                            $patient_id = $_POST['patient_id'];
                            
                            $notes_date = date('Y-m-d');
                            $notes_time = date('h:i:s');
                            
                            $stmte = $pdo->prepare("SELECT * FROM nurses WHERE user_id='$id'");
                            $stmte->execute();
                            $rowsZz = $stmte->fetch();
                            $counts = $stmte->rowCount();
                            
                            $nurse_id = $rowsZz['nurse_id'];

                            $stmt = $pdo->prepare("UPDATE follow_up_record SET notes = ? , date_note = ? , note_time = ? , nurse_id = ? WHERE patient_id = ?");
                            $stmt->execute(array($note , $notes_date , $notes_time , $nurse_id , $patient_id));

                            echo '<div class="pdotainer" dir="ltr" style="margin-top:30px;color:#FFF;margin-bottom:30px;font-family:cairo">
                            <div class="alert alert-info role="alert" style="color:black;text-align:center;margin-bottom:40px;font-family:cairo">
                                Notes Added Successfully
                            </div>
                        </div>';  
                            
                        
                        }
                        
                        
                    ?>    
                        
                    <?php
                    
                    include('../db/db.inc.php');
                    $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;
                        
                        
                    $stmte = $pdo->prepare("SELECT * FROM nurses WHERE user_id='$id'");
                    $stmte->execute();
                    $rowsZz = $stmte->fetch();
                    $counts = $stmte->rowCount();

                    $nurse_id = $rowsZz['nurse_id'];
                        
                    $date_nowing = date('Y-m-d');    

                    $stmt = $pdo->prepare("UPDATE follow_up_record SET nurse_id = ? , entring_date = ? WHERE patient_id = ?");
                    $stmt->execute(array($nurse_id , $date_nowing , $patient_id));      
                        
                        
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
                            <div class="col-lg-2"></div>
                            <div style="font-weight: bold;line-height: 2.2" class="col-lg-9">
                                <span style="color: #329287;font-weight: bold">Chronic Diseases Or Allergies</span>
                                <ul>
                                    <?php

                                        include('../db/db.inc.php');
                                        $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

                                        $sql = $pdo->prepare("SELECT * FROM patient_files WHERE patient_id='$patient_id'");      
                                        $sql->execute();
                                        $rows = $sql->fetchAll();

                                        foreach($rows as $pat)
                                        {

                                    ?> 
                                    <li style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px"><?php if(!empty($pat['chronic_diseases'])){ echo $pat['chronic_diseases']; }else{echo "Not Found ";} ?></li>
                                    <li style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px"><?php if(!empty($pat['allergies'])){ echo $pat['allergies']; }else{echo "Not Found";} ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                            <div style="font-weight: bold" class="col-lg-1"></div>
                        </div>
                    </div>  
                        
                    <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                        <div class="row" style="margin-left: 10px">
                            <div class="row" style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2">
                                <div style="font-weight: bold" class="col-lg-2 col-sm-1"></div>
                                <div style="font-weight: bold" class="col-lg-2 col-sm-3">Nurse Name</div>
                                <div style="font-weight: bold" class="col-lg-2 col-sm-2">Meds</div>
                                <div style="font-weight: bold" class="col-lg-1 col-sm-3">Time</div>
                                <div style="font-weight: bold" class="col-lg-2 col-sm-3">Date</div>
                                <div style="font-weight: bold" class="col-lg-3 col-sm-2">Status</div>
                                <div style="font-weight: bold" class="col-lg-2 col-sm-1"></div>
                            </div>
                        </div>
                        <?php
                            date_default_timezone_set('Asia/Riyadh');

                            include('../db/db.inc.php');
                            $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;
                            
                            $sql = $pdo->prepare("SELECT follow_up_record.*, nurses.user_id FROM follow_up_record INNER JOIN nurses ON nurses.nurse_id = follow_up_record.nurse_id WHERE follow_up_record.patient_id='$patient_id' AND nurses.user_id='$id'");
                            $sql->execute();
                            $rows = $sql->fetchAll();
                            foreach ($rows as $pat) {
                                $today = date('Y-m-d');
                                $db_date = $pat['Date'];
                                $time_now = date("H:i");
                                $meding_time = date("H:i", strtotime($pat['meds_time']));
                                $timeNow_Plus10 = date("H:i", strtotime('+10 minutes', strtotime($meding_time)));
                            
                                if ($today == $db_date) {
                                    if (strtotime($time_now) > strtotime($timeNow_Plus10)) {
                                        $status = 2; // Update the status to "Late"
                                        include('../db/db.inc.php');
                                        $stmt = $pdo->prepare("UPDATE follow_up_record SET status = ? WHERE follow_up_record_id = ?");
                                        $stmt->execute(array($status, $pat['follow_up_record_id']));
                                    }
                                }
                            
                            
                                $user_id = $pat['user_id'];
                            
                                $sqll = $pdo->prepare("SELECT * FROM users WHERE user_id='$user_id'");
                                $sqll->execute();
                                $rowss = $sqll->fetch();
                            
                        ?> 
                        <div class="row" style="margin-left: 10px">
                            <div class="row" style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 10px;line-height: 2.2">
                                <div style="font-weight: bold" class="col-lg-2 col-sm-1"></div>
                                <div style="font-weight: bold;padding-top: 8px" class="col-lg-2 col-sm-1"><?php echo $rowss['firstname'] . ' ' . $rowss['lastname']; ?></div>
                                <div style="font-weight: bold;padding-top: 8px" class="col-lg-2 col-sm-2"><?php echo $pat['meds']; ?></div>
                                <div style="font-weight: bold;padding-top: 8px" class="col-lg-1 col-sm-3"><?php echo $pat['meds_time']; ?></div>
                                <div style="font-weight: bold;padding-top: 8px" class="col-lg-2 col-sm-3"><?php echo $pat['Date']; ?></div>
                                <?php if($pat['status'] == 1){ ?>
                                <div style="font-weight: bold" class="col-lg-1 col-sm-2"><a style="border: 1px solid #329287;padding: 8px 7px;padding-top: 10px;padding-left: 10px;padding-right: 10px;border-radius: 50%;width: 50px;height: 50px"><i class="bi bi-check" style="font-size: 25px"></i></a></div>
                                <?php }elseif($pat['status'] == 2){ ?>
                                    <div style="font-weight: bold" class="col-lg-1 col-sm-2"><a style="border: 1px solid #329287;padding: 8px 7px;padding-top: 15px;padding-left: 10px;padding-right: 10px;border-radius: 50%;width: 50px;height: 50px"><i class="bi bi-x" style="font-size: 25px"></i></a></div>
                                <?php }elseif($pat['status'] == 0){ ?>
                                    <div style="font-weight: bold;padding-top: 10px;padding-bottom: 10px" class="col-lg-1 col-sm-2"><a style="border: 1px solid #329287;padding: 11px 23px;border-radius: 55%;width: 55px;height: 50px" onclick="return confirm('Confirm Delivering Medication To The Patient ?');" href="checked_meds.php?patient_id=<?php echo $patient_id; ?>&nurse_id=<?php echo $pat['nurse_id']; ?>&follow_up_id=<?php echo $pat['follow_up_record_id']; ?>"></a></div>
                                <?php } ?>
                                <div style="font-weight: bold" class="col-lg-2 col-sm-1"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>    
                    <div class="col-lg-12" style="border-radius: 10px;background-color: #FFF;border: 1px solid #CCC;padding: 10px;margin-bottom: 5px">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-2 col-sm-1"></div>
                                <div style="background-color: #EAF6F4;border-radius: 5px;margin-bottom: 6px;padding: 5px;line-height: 2.2" class="col-lg-9 col-sm-10">
                                    <h4>Doctor Notes</h4>
                                    <ul>
                                        <?php

                                            include('../db/db.inc.php');
                                            $patient_id = isset($_GET['patient_id']) && is_numeric($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

                                            $sql = $pdo->prepare("SELECT notes , notes_date , notes_time FROM patient_files WHERE patient_id='$patient_id'");      
                                            $sql->execute();
                                            $rows = $sql->fetchAll();

                                            foreach($rows as $pat)
                                            {

                                        ?> 
                                        <span style="font-weight: bold;color: #329287">Notes:</span> <?php echo $pat['notes'] ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Date:</span> <?php echo $pat['notes_date'] ?> <br/>
                                        <span style="font-weight: bold;color: #329287">Time:</span> <?php echo $pat['notes_time'] ?> <br/>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div style="font-weight: bold" class="col-lg-1 col-sm-1"></div>
                            </div>
                        </div>
                    </div>      
                        
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
                                                <textarea style="background-color: #EAF6F4" name="notes" required class="form-control" cols="4" rows="4" placeholder="Write Your Notes"></textarea>
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
            </div>
            </section>

        </main>
        
    </body>
    </html>