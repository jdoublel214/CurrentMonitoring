<?php
ini_set('display_errors', 1);
// //ini_set('display_startup_errors', 1);
// //error_reporting(e_all);

session_start();


date_default_timezone_set('Asia/Manila');
$DATE_LOGIN = date("M d, o g:i:s A");

include('sampe.php');

$conn = mysqli_connect($servername,$username,$password,$DB_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['login_btn'])) {
	//get username & password @ POST
	$User_name = $_POST['Username'];
	$Passsword = $_POST['Password'];
	//get the result and verify from the DB  SELECT `id`, `First Name`, `Middle Name`, `Last Name`, `Email Address`, `Password`, `Photo` FROM `user data` WHERE 1
	$LOGIN_QUERY = mysqli_query($conn,"SELECT * FROM `user` WHERE `Email Address`='$User_name' AND Password='$Passsword'");
	$VERIFY_RESULT = mysqli_num_rows($LOGIN_QUERY);
		if($VERIFY_RESULT >= 1) {
			while($CREDENTIAL = mysqli_fetch_assoc($LOGIN_QUERY)){
				$USERNAME = $CREDENTIAL['Email Address']; 
				$PICTURE = $CREDENTIAL['Photo'];
				$FIRST_NAME = $CREDENTIAL['First Name']; 
				
				$_SESSION['First Name'] = $FIRST_NAME;
				$_SESSION['PICTURE'] = $PICTURE;
								
				 header("Location: Dashboard");
				 //print_r($_SESSION['PICTURE']);

				 				
			}
		}else {
		$_SESSION['LOGIN_MSG'] = "Incorrect credential! Please verify";
		header("Location: index");	
		}
	
}else {
	$_SESSION['LOGIN_MSG'] = "Please fill up the needed credential to Login.";
	header("Location: index");
}
?>




















