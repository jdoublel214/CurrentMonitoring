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


#DELETE ITEM DATA

if(isset($_POST['data_delete_btn'])){
	
	$DB_DEVICE_ID = $_POST['data'];
	
	
	print_r($DB_DEVICE_ID);
	
	foreach($DB_DEVICE_ID as $DEL_DEVICE_ID){
	
		$DELETE_DATA_QUERY = mysqli_query($conn,"DELETE FROM `monitoring` WHERE `monitoring`.`Device_ID` = '$DEL_DEVICE_ID'");
	
		if($DELETE_DATA_QUERY === true ){
			$_SESSION['DEL_QUERY_MSG'] = $DEL_DEVICE_ID . " Successfully deleted";
			
			header('Location: Dashboard.php');
			
		}else{
			$_SESSION['DEL_QUERY_MSG'] = $DEL_DEVICE_ID . " Can not be deleted. ERROR: " .  mysqli_error($conn);
		}
	}

}	                        
     

?>