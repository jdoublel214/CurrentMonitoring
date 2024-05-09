<?php


// Turn off all error reporting
error_reporting(0);



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('sampe.php');

session_start();

if(!empty($_SESSION['First Name'])) {
	print_r(""); //do nothing
}else {
	$_SESSION['LOGIN_MSG'] = "Session expired! Please re-login";
	header("Location: index.php");
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Device</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                 <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="background-image: url(&quot;assets/img/dashboard_logo.jpg&quot;); background-color: #e8dfe0;background-position: center;background-size: auto 70px;background-repeat: no-repeat;width: 100%;">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                   <div class="sidebar-brand-text mx-3"><span></span></div>
                </a>
                <hr class="sidebar-divider my-2">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Dashboard"><i class="fa fa-chart-area"></i><span>Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Device List"><i class="fa fa-list"></i><span>Device List</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="Add Device"><span><i class="fa fa-plus"></i>Add Device</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Alert Notification"><span><i class="fa fa-laptop"></i>Alert Notification</span></a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="Settings"><i class="fa fa-gear"></i><span>Settings</span></a></li> 						 
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button><span id="RFID-Access-System" style="color: rgb(208,15,42); font-size:1.5vw;"><strong>Current Fluctuation Monitoring System</strong></span>
                        <form
                            class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <div class="input-group-append"></div>
                            </div>
                            </form>
                            <ul class="nav navbar-nav flex-nowrap ml-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                        <form class="form-inline mr-auto navbar-search w-100">
                                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow" role="presentation">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $_SESSION['First Name']; ?></span><img class="border rounded-circle img-profile" src="admin_image/<?php echo $_SESSION['PICTURE'];?>"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" role="presentation" href="Signout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                       </div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid">
                <h3 class="text-dark mb-3">Add Device</h3>
				<form action="Save Add Device" method="POST" enctype="multipart/form-data">         
                <div class="row mb-3">            
                    <div class="col-lg-4">
                        <div class="card mb-3">
                                    <script>
                                    function preview() {
                                    profile.src=URL.createObjectURL(event.target.files[0]);
                                      }
                                    </script>                        
 <!-- Device Photo -->                       
                            <div class="card-body text-center shadow">
                            <img class="mb-3 mt-4" id="profile" src="assets/img/addimage.jpg" style="width: 100%; height: auto;">
                                <div class="mb-3"><p class="text-primary font-weight-bold m-0">Select photo</p><br>
                                <input class="btn btn-sm" type="file" onchange="preview()" name="Picture">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row mb-3 d-none">
                            <div class="col">
                                <div class="card text-white bg-primary shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-success shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Device Data</p>
                                    </div>
                                    <div class="card-body">
                                    		<div class="form-row">
                                    		<div class="col"> 
                                                     <p class="text-center m-0" style="color: red; font-size: 30px;"><strong><?php echo $_SESSION['message'];?></strong></p>
                                          </div> 		
                                    		</div>
                                  
                                       
                                           <div class="form-row">
  																
                                                <div class="col">
<!-- Device Name-->
                                                    <div class="form-group"><label for="username"><strong>Name</strong><br></label>
                                                    <input class="form-control" type="text" name="Device_Name" placeholder="Enter Device Name" required="required">
                                                    </div>
                                                </div>
												
                                                <div class="col">
<!-- Device ID -->
                                                    <div class="form-group"><label for="username"><strong>ID</strong><br></label>
                                                    <input class="form-control" type="text" name="Device_ID" placeholder="Enter Device Id Number" required="required">
                                                    </div>
                                                </div>												
												
                                            </div>
                                            <div class="form-row">

                                                <div class="col">
<!-- Device_Description -->
                                                    <div class="form-group"><label for="username"><strong>Description</strong><br></label>
                                                    <input class="form-control" type="text" name="Device_Description" placeholder="Enter Device Description" required="required">
                                                    </div>
                                                 </div>
<!-- Device_Location -->
                                                <div class="col">
                                                    <div class="form-group"><label for="username"><strong>Location</strong><br></label>
                                                    <input class="form-control" type="text" name="Device_Location" placeholder="Enter Device Location" required="required">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row">

                                                <div class="col">
<!-- Device_Url -->
                                                    <div class="form-group"><label for="username"><strong>Access Link</strong><br></label>
                                                    <input class="form-control" type="text" name="Device_Access_Link" placeholder="Enter Device Access Link" required="required">
                                                    </div>
                                                 </div>

                                                <div class="col">
                                                </div>
                                            </div>


                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="flavor_btn" >Save&nbsp;</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
<?php
unset($_SESSION['message']);
unset($_SESSION['DEL_QUERY_MSG']);

?>





<?php
unset($_SESSION['message']);
?>
