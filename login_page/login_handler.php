<?php
//to handle any errors
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HMDT</title>
    <link rel="stylesheet" href="style.css">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../img/favicon_io/favicon.ico" rel="imges/x-icon">
    <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


</head>

<body>

<main>
        <div class="container">
    
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
    
                <div class="logo">
                    <img style="width:300px; height:200px" src="../img/logo.png" alt=""> 
                    <a href="#" class="align-items-center w-auto" style="text-decoration: none">   
                    <p class="text-center small" style="color: #329287;font-weight: bold;font-size: 16px;">Hospital Medications Delivery Tracker</p>    
                    </a>
                </div>
                <!-- End Logo -->
                
                <div class="card mb-3" style="background-color: #DCF0EE; border: none">

                <div class="card-body">

                <?php
                    //link to other file that has a session started inside it bc its safer than starting the session in the same file
                    include('../includes/config_session.inc.php');
                    //connect to the database
                    include('../db/db.inc.php');

                    $email = $_POST['username'];
                    $password = $_POST['password'];

                    $sql1 = $pdo->prepare("SELECT * FROM users WHERE user_code=? AND password=?");
                    $sql1->execute(array($email,$password));
                    $row1 = $sql1->fetch();
                    $count1 = $sql1->rowCount();

                    //check the user type
                    if($email != "" && $password != ""){

                    if($count1>0){
                        $sql = $pdo->prepare("SELECT * FROM users");
                        $sql->execute();
                        $rows = $sql->fetchAll();

                        foreach($rows as $info){

                            if($email == $info["user_code"] && $password == $info["password"] &&  $info["group_id"] == 2){

                                $_SESSION['user_code'] = $info['user_code'];
                                $_SESSION['user_id'] = $info['user_id'];
                                $_SESSION['password'] = $info['password'];
                                $_SESSION['email'] = $info['email'];
                                $_SESSION['username'] = $info['username'];
                                $_SESSION['phone_number'] = $info['phone_number'];
                                $_SESSION['firstname'] = $info['firstname'];
                                $_SESSION['lastname'] = $info['lastname'];
                                $_SESSION['type'] = "doctor";

                                header('Location: ../doctor/patients_home.php');

                            }elseif($email == $info["user_code"] && $password == $info["password"] &&  $info["group_id"] == 3){

                                $_SESSION['user_code'] = $info['user_code'];
                                $_SESSION['user_id'] = $info['user_id'];
                                $_SESSION['password'] = $info['password'];
                                $_SESSION['email'] = $info['email'];
                                $_SESSION['username'] = $info['username'];
                                $_SESSION['phone_number'] = $info['phone_number'];
                                $_SESSION['firstname'] = $info['firstname'];
                                $_SESSION['lastname'] = $info['lastname'];
                                $_SESSION['type'] = "nurse";

                                header('Location: ../nurse/patients_home.php');


                            }elseif($email == $info["user_code"] && $password == $info["password"] &&  $info["group_id"] == 1){

                                $_SESSION['user_code'] = $info['user_code'];
                                $_SESSION['user_id'] = $info['user_id'];
                                $_SESSION['password'] = $info['password'];
                                $_SESSION['email'] = $info['email'];
                                $_SESSION['username'] = $info['username'];
                                $_SESSION['phone_number'] = $info['phone_number'];
                                $_SESSION['firstname'] = $info['firstname'];
                                $_SESSION['lastname'] = $info['lastname'];
                                $_SESSION['type'] = "receptionist";

                                header('Location:../receptionest/receptionist.php');

                                //echo $_SESSION['name'];
                            }
                        }

                    }else{
                        echo '<div class="container" dir="ltr" style="margin-top:80px;color:#000">
                                <div class="alert alert-success role="alert" style="color:#000">
                                    Email Or Password May Be Incorrect Please Try Again
                                </div>
                            </div>
                                <form action="login_handler.php" method="post" class="row g-3 needs-validation">
                                    <div class="col-12">
                                    <label for="yourUsername" style="color: #329287" class="form-label">Enter ID</label>
                                    <div class="input-group has-validation">
                                        <input type="number" name="username" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
                                        <div class="invalid-feedback">Please enter your ID.</div>
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourPassword" style="color: #329287" class="form-label">Enter Password</label>
                                    <input type="password" name="password" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourPassword" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-primary" name="login" style="background-color: #75D5CA;border: 1px solid #75D5CA;border-radius: 20px;width: 140px" type="submit">Login</button>
                                    </div>    
                                    <div class="col-lg-5"></div> 
                                    </div>   
                                    </div>
                            </form>';

                        }
                    }
            ?>
            
        </section>

    </div>
</main>


    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>






<?php
ob_end_flush();
?>