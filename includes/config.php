<?php

	ob_start();
	session_start();

	$timezone = date_default_timezone_set("America/New_York");

	$servername = "localhost";

    //$servername = "mydb.clefwjdyqe9i.us-east-2.rds.amazonaws.com";
	$username = "root";
	$password = "sutur1,.95";


    $database = "karenyyy";
    //$database = "fake_spotify";

	$con = mysqli_connect($servername, $username, $password, $database);

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}

?>
