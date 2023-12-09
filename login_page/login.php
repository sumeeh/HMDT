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
                <form action="login_handler.php" method="post" class="row g-3 needs-validation" needs-novalidate>

                    <div class="col-12">
                        <label for="yourUsername" style="color: #329287" class="form-label">Enter ID</label>
                        <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" style="background-color: #75D5CA;border-radius: 10px" id="yourUsername" required>
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
                            <button class="btn btn-primary" style="background-color: #75D5CA;border: 1px solid #75D5CA;border-radius: 20px;width: 140px" type="submit">Login</button>
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