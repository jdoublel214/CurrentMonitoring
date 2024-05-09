<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

date_default_timezone_set('Asia/Manila');
$date_created = date("M d, o g:i:s A");
//$time_expired = date("g:i:s A");

include('sampe.php');

$conn = mysqli_connect($servername,$username,$password,$DB_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['Admin_submit_btn'])) {

		
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			// Check if file was uploaded without errors
    		if(isset($_FILES["Picture"]) && $_FILES["Picture"]["error"] == 0){
    			
				$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "JPG" => "image/JPG");
       		$filename = $_FILES["Picture"]["name"];
        		$filetype = $_FILES["Picture"]["type"];
        		$filesize = $_FILES["Picture"]["size"];    			
    			
    			 // Verify file extension
        		$ext = pathinfo($filename, PATHINFO_EXTENSION);
        		if(!array_key_exists($ext, $allowed)) //die("Error: Please select a valid file format.");
    				{
    				$_SESSION['Admin_msg'] = "Please select a valid file format.";
    				header("location:Settings.php");
    				}
    				
    				// Verify file size - 5MB maximum
        		$maxsize = 5 * 1024 * 1024;
        		if($filesize > $maxsize) // die("Error: File size is larger than the allowed limit.");
    				{
    				$_SESSION['Admin_msg'] = "Photo size must not larger than 5MB.";
    				header("location:Settings.php");
    				}
    				
    				
				// Verify MYME type of the file
        		if(in_array($filetype, $allowed)){	 
        			            // Check whether file exists before uploading it
            		if(file_exists("/" . $filename)){
               	// echo $filename . " is already exists.";
               	$_SESSION['Admin_msg'] = $filename . " is already exists.";
    		      	header("location:Settings.php");
            		} else{
               	move_uploaded_file($_FILES["Picture"]["tmp_name"], "admin_image/" . $filename);
               	echo "Your file was uploaded successfully.";
               	$_SESSION['RFID_User_msg'] = "Your file was uploaded successfully.";
    		      	header("location:Settings.php");
    		      	
    		      	
								//upload admin data
	 							$Email_address = $_POST['Email_Address'];
								$Email_address_sql = "SELECT * FROM `user` WHERE `Email Address` ='$Email_address'";
								//execute query
								$Email_address_sql_run = mysqli_query($conn,$Email_address_sql);
									//count all data
								$Email_address_sql_count = mysqli_num_rows($Email_address_sql_run);
								//query test    		 
								if($Email_address_sql_count >= 1) { 
   									$_SESSION['Admin_msg'] = $Email_address . " User already exist.";
   									//echo $_SESSION['RFID_User_msg'];
	   								header("location:Settings.php");
								}else {   
																
										//Fetch all data from POST 

										$Picture = $_FILES['Picture']['name'];
										$Email_address = $_POST['Email_Address'];
										$Password = $_POST['Password'];
										$First_Name = $_POST['First_Name'];
										$Middle_Name = $_POST['Middle_Name'];
										$Last_Name = $_POST['Last_Name'];
		
								//insert user data 
										$Save_admin_query = "INSERT INTO `user` (
										`First Name`, `Middle Name`, `Last Name`, `Email Address`, `Password`, `Photo`) 
										VALUES ('$First_Name','$Middle_Name','$Last_Name','$Email_address','$Password','$Picture')";
										
										if(mysqli_query($conn, $Save_admin_query)){
											$_SESSION['Admin_msg'] = "Successfully saved.";
					  						header("location:User Enrollment.php");
					  			 			echo $_SESSION['Admin_msg'];
										}else {
											$_SESSION['Admin_msg'] = "Unable save the data. ERROR:" . mysqli_error($conn);
					   						header("location:User Enrollment.php");
					   						echo $_SESSION['Admin_msg'];												
										}
								}
    		      	    		      	
    		      	}
        		
        		} else{
            //echo "Error: There was a problem uploading your file. Please try again."; 
            $_SESSION['Admin_msg'] = "Error: There was a problem uploading your file. Please try again."; 
            header("location:Settings.php");
            }   				
    				
    			
    		} else{
       	// echo "Error: " . $_FILES["Picture"]["error"];
       	$_SESSION['Admin_msg'] = "No photo selected!";
       header("location:Settings.php");
         }
		
		}else {	
	   header("location:Settings.php");	
		}


}else {
$_SESSION['Admin_msg'] = "Please Fill-up all required data. Thank You!";
header("location:Settings.php");
echo $_SESSION['Admin_msg'];
}




?>