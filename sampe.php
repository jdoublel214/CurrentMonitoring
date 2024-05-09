<?php


$servername = "localhost";
$username = "controller";
$password = "Engr.Sam";
$DB_name = "currentfluctuationdb";


$conn = mysqli_connect($servername,$username,$password,$DB_name);

	if($conn == false)
		{
			echo "Could'nt connect to your Database";
		}
?>
