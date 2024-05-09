<?php

session_start();

date_default_timezone_set('Asia/Manila');
$date_created = date("M d, o g:i:s A");
//$time_expired = date("g:i:s A");

include('sampe.php');

$conn = mysqli_connect($servername,$username,$password,$DB_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Step 5: Update data in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Update_btn_id'];
    $tcurrent_Min = $_POST['Threshold_Current_Min'];
    $tcurrent_Max = $_POST['Threshold_Current_Max'];


    $sql = "UPDATE `device` SET Device_Threshold_Current_Min='$tcurrent_Min', Device_Threshold_Current_Max='$tcurrent_Max' WHERE Device_ID='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
		$_SESSION['DEL_QUERY_MSG'] = "Record updated successfully";
		header('Location: Device List.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
