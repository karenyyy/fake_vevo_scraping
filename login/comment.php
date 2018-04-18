<?php
	
	require 'authentication.php';

	
	session_start();


	$connection = sqlsrv_connect( $server, $connectionInfo )
    or die("ERROR: selecting database server failed");

		
	$table = "COMMENT";

	$query = "SELECT UserId, Comment FROM $table";

	$query_result = sqlsrv_query($connection, $query)
    or die( "ERROR: Query is wrong");


	echo "<table border=1>";
	echo "<tr>";

		
	foreach( sqlsrv_field_metadata($query_result) as $fieldMetadata)
	    echo "<th>".$fieldMetadata['Name']."</th>";
	echo "</tr>";
		
	while ($line = sqlsrv_fetch_array($query_result, SQLSRV_FETCH_ASSOC)) {
	    echo "<tr>\n";
	    foreach ($line as $cell) {
	        echo "<td> $cell </td>";
	    }
			echo "</tr>\n";
	}
	echo "</table>";



    if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] != true) {
        header('Location: login.php');
        exit;
    } else {
        $uid = $_SESSION['userID'];
        if (isset($_POST['comment'])) {
            $comment = $_POST['comment'];
            $query = "INSERT INTO $table VALUES ('$uid', '$comment')";

            $query_result = sqlsrv_query($connection, $query)
            or die( "SQL Query ERROR. User can not be created.");

        }



sqlsrv_close($connection);

?>


<h2>Input your new comment</h2>

<form action="">
    <textarea name="comment" rows="10" cols="30"></textarea>
    <br>
    <input type="submit">
</form>


