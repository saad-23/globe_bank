<?php

	require_once("db_credentials.php");

	function db_connect() {
		$conn = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
		confirm__db_connecton($conn);
		return $conn;
	}

	function db_disconnect($connection) {
		if (isset($connection)) {
			 $connection->close();
		}
	}

	function confirm__db_connecton($conn) {
		if($conn->connect_errno)
		{
			$error = "Database connection failed ";
			$error .= $conn->connect_error; 
			die($error);
		}
	}

	function confirm_query_exe($result_obj) {
		if (!$result_obj) {
				die("Database Query Failed");
		}
	}


?>