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



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct device names from the table
$sql_device_id = "SELECT DISTINCT Device_ID FROM monitoring ORDER BY Device_ID";
$result_device_id = $conn->query($sql_device_id);

// Array to hold data for each device
$device_data = array();

// If there are device names
if ($result_device_id->num_rows > 0) {
  while($row_device_id = $result_device_id->fetch_assoc()) {
    $device_id = $row_device_id["Device_ID"];

    // Fetch data for each device
    $sql_device_data = "SELECT Current_Flactuation_Reading, Time, Device_Name FROM monitoring WHERE Device_ID = '$device_id' ORDER BY Time";
    $result_device_data = $conn->query($sql_device_data);

    // Array to hold data points for the current device
    $dataPoints = array();

    // If there are results for the device
    if ($result_device_data->num_rows > 0) {
      // Output data of each row
      while($row_device_data = $result_device_data->fetch_assoc()) {
        $dataPoints[] = array("y" => $row_device_data["Current_Flactuation_Reading"], "label" => $row_device_data["Time"], "Name" => $row_device_data["Device_Name"]);
      }

      // Store data points for the current device
      $device_data[$device_id] = $dataPoints;
	  
	  //print_r($device_data[$device_id]);
	  
    }
  }
} else {
  echo "0 results";
}
$conn->close();



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
	

<script>
window.onload = function() {
  <?php
  // Loop through device data to render line graphs for each device
  foreach ($device_data as $device_id => $dataPoints) {
  ?>
    var chart_<?php echo $device_id; ?> = new CanvasJS.Chart("chartContainer_<?php echo $device_id; ?>", {
      animationEnabled: true,
      axisX: {
        title: "Date and Time"
      },
      axisY: {
        title: "<?php echo $device_id; ?>  Current (Ampere)"
      },
      data: [{
        type: "line",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart_<?php echo $device_id; ?>.render();
  <?php
  }
  ?>
}
</script>


<style>
.chart-container {
  height: auto;
  width: 100%;
  margin-bottom: 20px;
  border: 1px solid #ddd; /* Add a border for better visualization */
  border-radius: 5px; /* Add rounded corners */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
  overflow: hidden; /* Ensure content doesn't overflow */
}

/* Responsive styles */
@media only screen and (max-width: 768px) {
  .chart-container {
    height: 300px; /* Adjust height for smaller screens */
  }
}
</style>
	
</head>

<body id="page-top">

    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="background-image: url(&quot;assets/img/dashboard_logo.jpg&quot;); background-color: #fff;background-position: center;background-size: auto 70px;background-repeat: no-repeat;width: 100%;">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                   <div class="sidebar-brand-text mx-3"><span></span></div>
                </a>
                <hr class="sidebar-divider my-2">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="Dashboard"><i class="fa fa-chart-area"></i><span>Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Device List"><i class="fa fa-list"></i><span>Device List</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Add Device"><span><i class="fa fa-plus"></i>Add Device</span></a></li>
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
                <h3 class="text-dark mb-3">Dashboard</h3>
                <div class="card shadow mb-5">

                    <div class="card-body">
                   
                    <p class="text-center m-0" style="color: red; font-size: 30px;"><strong><?php echo $_SESSION['DEL_QUERY_MSG'];?></strong></p>
                     <form action="Delete" method="POST">  
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
				<th style="text-align: left; width: 1px;"><input  type="checkbox"  name="" onClick="toggle(this)"></th>	
				<th style="text-align: left;">Select All</th>
        

                                    </tr>
                                </thead>
                                <tbody>

								<?php
								// Loop through device data to render div containers for each chart
								
								foreach ($device_data as $device_id => $dataPoints) {
								?>
									<tr>
										<td style="text-align:left;">
											<input name="data[]" value="<?=$device_id?>" type="checkbox" />
										
											
										</td>
										<td>
											<div  class="chart-container" id="chartContainer_<?php echo $device_id; ?>" style="height: 400px; width: 100%; margin-top: 30px; margin-bottom: 30px;" ></div>
										</td>
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
	<script src="assets/js/canvasjs.min.js"></script>
</body>

</html>
<?php
unset($_SESSION['message']);
unset($_SESSION['DEL_QUERY_MSG']);

?>





<?php
unset($_SESSION['message']);
?>
