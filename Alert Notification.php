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
    <title>Alert Notifications</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Add Device"><span><i class="fa fa-plus"></i>Add Device</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="Alert Notification"><span><i class="fa fa-laptop"></i>Alert Notifications</span></a></li>
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
                <h3 class="text-dark mb-3">Alert Notifications</h3>
                <div class="card shadow mb-5">
                    <div class="card-body">

<?php

#DELETE ITEM DATA

if(isset($_POST['data_delete_btn'])){
	
	$DB_DEVICE_DATA = $_POST['data'];
	
	foreach($DB_DEVICE_DATA as $DEVICE_DATA){
	
		$DELETE_DATA_QUERY = mysqli_query($conn,"DELETE FROM `notification` WHERE `notification`.`Device_Name` = '$DEVICE_DATA'");
	
		if($DELETE_DATA_QUERY === true ){
			$_SESSION['DEL_QUERY_MSG'] = $DEVICE_DATA . " Successfully deleted";
		}else{
			$_SESSION['DEL_QUERY_MSG'] = $DEVICE_DATA . " Can not be deleted. ERROR: " .  mysqli_error($conn);
		}
	}

}
?>			                        
                        
                    <p class="text-center m-0" style="color: red; font-size: 30px;"><strong><?php echo $_SESSION['DEL_QUERY_MSG'];?></strong></p>
                     <form action="" method="POST">  
	                     <button class="btn btn-primary btn-sm mb-2" type="submit" name="data_delete_btn">Delete</button>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="height:500px;overflow:auto;">						          
                                <table class="table dataTable my-0" id="dataTable">
                                   <thead>
                                       <tr>
                       
		<script language="JavaScript">
			function toggle(source) {
			checkboxes = document.getElementsByName('data[]');
			for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
			}
		}
		</script>
													<th style="text-align: left; width: 111px;"><input  type="checkbox"  name="" onClick="toggle(this)"> Select all</th>	
													<th style="text-align: center;">Name</th>				
													<th style="text-align: center;">Message</th>			

                                    </tr>
                                </thead>
                                <tbody>


		<?php
		#DISPLAY ALL ITEMS CHARACTERISTICS 
		$ITEMS_QUERY = mysqli_query($conn,"SELECT * FROM `notification`");
		while($ITEMS = mysqli_fetch_assoc($ITEMS_QUERY)){

			$DB_DEVICE_NAME = $ITEMS['Device_Name'];
			$DB_DEVICE_MESSAGE = $ITEMS['Message'];

		?>
			<tr>
				<td style="text-align:center;">
					<input name="data[]" value="<?=$DB_DEVICE_NAME?>" type="checkbox" />
				</td>
				<td style="text-align: center;"><?php echo $DB_DEVICE_NAME;?></td>
				<td style="text-align: center;"><?php echo $DB_DEVICE_MESSAGE?></td>
			</tr>
		<?php
		}
		?>	

			
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
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
