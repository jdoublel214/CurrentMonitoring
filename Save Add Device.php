<?php


// Turn off all error reporting
//error_reporting(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('sampe.php');

session_start();

if(isset($_POST['flavor_btn'])){

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
    				$_SESSION['message'] = "Please select a valid file format.";
    				header("location:Add Device");
    				}
    				
    				// Verify file size - 5MB maximum
        		$maxsize = 5 * 1024 * 1024;
        		if($filesize > $maxsize) // die("Error: File size is larger than the allowed limit.");
    				{
    				$_SESSION['message'] = "Photo size must not larger than 5MB.";
    				header("location:Add Device");
    				}
    				
    				
				// Verify MYME type of the file
        		if(in_array($filetype, $allowed)){	 
        			            // Check whether file exists before uploading it
            		if(file_exists("/" . $filename)){
               	// echo $filename . " is already exists.";
               	$_SESSION['message'] = $filename . " is already exists.";
    		      	header("location:Add Device");
            		} else{
               	move_uploaded_file($_FILES["Picture"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"].'/CurrentMonitoring/device_image/' . $filename);
               	echo "Data was uploaded successfully.";
               	$_SESSION['message'] = "Data was uploaded successfully";
    		      //	header("location:Add Device");
    		      	
					#CHECK TRAIN DATA IF ALREADY ENROLLED

					//$PHOTO = $_POST['Picture'];
					$DEVICE_NAME = $_POST['Device_Name'];
					$DEVICE_ID = $_POST['Device_ID'];
                    			$DEVICE_DESCRIPTION = $_POST['Device_Description'];
					$DEVICE_LOCATION = $_POST['Device_Location'];
                                        $DEVICE_ACCESS_LINK = $_POST['Device_Access_Link'];

					$CHECK_DATA = mysqli_query($conn,"SELECT * FROM `device` WHERE `device`.`Device_ID`='$DEVICE_ID'");
					$DATA_COUNT = mysqli_num_rows($CHECK_DATA);

					if($DATA_COUNT == 0){
					#insert into database  
		                                $INSERT_DATA = mysqli_query($conn,"INSERT INTO `device` (`Device_ID`, `Device_Name`, `Device_Photo`, `Description`, `Location`, `Device_Url`)
						VALUES ('$DEVICE_ID','$DEVICE_NAME','$filename', '$DEVICE_DESCRIPTION', '$DEVICE_LOCATION', '$DEVICE_ACCESS_LINK')");
	
						if($INSERT_DATA === true){
							$_SESSION['message'] = $NAME . " Successfully enrolled";
                                                        header("location:Add Device");
						}else{
							$_SESSION['message'] = "Can not enroll" . $DEVICE_NAME . " ERROR: " . mysqli_error($conn);
                                              		header("location:Add Device");
						}
					}else{
							$_SESSION['message'] = $DEVICE_NAME . " Device Data already exist!";
                                                        header("location:Add Device");
						}
    		      }
        		
        		} else{
            //echo "Error: There was a problem uploading your file. Please try again."; 
            $_SESSION['message'] = "Error: There was a problem uploading your file. Please try again."; 
            header("location:Add Device.php");
            }   				
    				
    			
    		} else{
       	// echo "Error: " . $_FILES["Picture"]["error"];
       	$_SESSION['message'] = "No photo selected!";
       	header("location:Add Device.php");
         }
		
		}else {	
	    header("location:Add Device.php");
		}

}else{
	print_r(""); //do nothing
	header("location:Add Device.php");
}

?>
