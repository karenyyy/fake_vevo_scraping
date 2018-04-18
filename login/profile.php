<?php
	//include information required to access database
	require 'authentication.php'; 

	//start a session 
	session_start();

	//still logged in?
	if (!isset($_SESSION['db_is_logged_in'])
		|| $_SESSION['db_is_logged_in'] != true) {
		//not logged in, move to login page
		header('Location: login.php');
		exit;
	} else {

		//logged in 
		// Connect database server
		$connection = sqlsrv_connect( $server, $connectionInfo )
			or die("ERROR: selecting database server failed");

		// Prepare query
		$table = "userprofile";
		$uid = $_SESSION['userID'];
		$query = "SELECT userid, firstname, lastname, email FROM $table where userid = '$uid'";

		// Execute query
		$query_result = sqlsrv_query($connection, $query)
			or die( "ERROR: Query is wrong");

		// Output query results: HTML table
		echo "<table border=1>";
		echo "<tr>";
			
		// fetch attribute names
		foreach( sqlsrv_field_metadata($query_result) as $fieldMetadata)
			echo "<th>".$fieldMetadata['Name']."</th>";
		echo "</tr>";
			
		// fetch table records
		while ($line = sqlsrv_fetch_array($query_result, SQLSRV_FETCH_ASSOC)) {
			echo "<tr>\n";
			foreach ($line as $cell) {
				echo "<td> $cell </td>";
			}
			echo "</tr>\n";
		}
		echo "</table>";
		
		// close the connection
		sqlsrv_close($connection);
	}
?>

<p><a href="logout.php">Logout</a> </p>

