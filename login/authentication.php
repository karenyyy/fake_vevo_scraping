<?php

	// Server, database name, sqluserid, and sqlpassword
	// Change to your own server, database, id and password

	$server = "upsql";
	$sqlUsername = "sqljxy225";
	$sqlPassword = "H02wvyqJ";
	$databaseName = "jxy225";

			
	$connectionInfo = array('Database'=>$databaseName, 'UID'=>$sqlUsername, 'PWD'=>$sqlPassword, 
									'Encrypt'=>'0', 'ReturnDatesAsStrings'=>true );


	//function to authenticate user, and return TRUE or FALSE 
	function authenticateUser($connection, $username, $password)
	{
	  // User table which stores userid and password
	  // Change to your own table name 
	  $userTable = "userprofile"; 

	  // Test the username and password parameters
	  if (!isset($username) || !isset($password))
		return false;

	  $pa = md5($password);  
	  // Formulate the SQL statment to find the user
	  $query = "SELECT * 
				 FROM $userTable 
				 WHERE userid COLLATE Latin1_General_CS_AS = '{$username}' AND password COLLATE Latin1_General_CS_AS = '{$pa}'";
	  echo $query;
	  
	  // Execute the query
	 $query_result = sqlsrv_query($connection, $query, array(), array("Scrollable"=>SQLSRV_CURSOR_KEYSET))
		or die( "ERROR: Query is wrong");

	  // exactly one row? then we have found the user
	  if ( sqlsrv_num_rows($query_result)!= 1)
		return false;
	  else
		return true;
	}

?>
