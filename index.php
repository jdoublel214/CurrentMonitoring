<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html>
<!-- <img class="mb-3 mt-4" id="profile" src="login-bg.jpg" style="width: 100%; height: auto;"> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
	<link href="https://fonts.googleapis.com/css2?family=Garamond&display=swap" rel="stylesheet">
</head>
<body>


<body class="bg-gradient-primary", style="background-image: url('assets/img/bg_front.jpg'); background-size: 110% 120%;">

	<div class="container">
		<div class="py-3 text-center">
		<img class="d-block mx-auto mb-auto" src="assets/img/BSU.png" width="500" height="120" ; style="margin-top: 30px;">
		</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
						
							<style>
									.bg-login-image {
									position: relative;
									overflow: hidden;
								}

								.overlay {
									position: absolute;
									top: 0;
									left: 0;
									width: 100%;
									height: 100%;
									background-color: rgba(0, 0, 0, 0.0); /* Adjust the opacity as needed */
								}

								.content {
									position: absolute;
									top: 50%;
									left: 50%;
									transform: translate(-50%, -50%);
									text-align: center;
									color: #fff;
							
								}

								.title {
									font-size: 1.7rem;
									margin-bottom: 10px;
									font-family: 'Garamond', serif;
								}

								.subtitle {
									font-size: 1.2rem;
									margin-bottom: 20px;
									font-family: 'Garamond', serif;
								}

								.description {
									font-size: 0.75rem;
									margin-bottom: 30px;
									font-family: 'Arial', bold;
								}

								.btn-primary {
									padding: 10px 20px;
									font-size: 1.2rem;
									text-decoration: none;
									color: #fff;
									background-color: #d00f2a; /* Adjust to your preferred primary color */
									border-radius: 5px;
									transition: background-color 0.3s ease;
								}

								.btn-primary:hover {
									background-color: #9c0116; /* Adjust the hover color as needed */
								}						
							</style>
						
							<div class="col-lg-6 d-none d-lg-flex">
								<div class="flex-grow-1 bg-login-image" style="background-image: url('assets/img/boxscaled.jpg');">
									<div class="overlay"></div>
									<div class="content">
										<h2 class="title">BATANGAS STATE UNIVERSITY</h2>
										<h5 class="subtitle">The National Engineering University</h5>
										<p class="description">Real-Time IoT-based Monitorig System for Detecting Current Fluctuations.</p>
									</div>
								</div>
							</div>


                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Please Login!</h4>
                                    </div>
                                    <form class="user" action="login%20Script" method="POST">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" name="Username"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="Password"></div>
                                        <div class="form-group">
                                        </div><button class="btn btn-primary btn-block text-white btn-user" name="login_btn" type="submit">Login</button>
                                        
                                        <hr>
                                        <p class="text-center m-0" style="color: red; font-size: 30px;"><strong><?php echo $_SESSION['LOGIN_MSG'];?></strong></p>
                                        <hr>
                                    </form>
                                    <div class="text-center"></div>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</body>
</html>
<?php
unset($_SESSION['LOGIN_MSG']);
?>