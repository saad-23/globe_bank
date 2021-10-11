<?php
	
	function find_all($table_name) {
		global $db;

		$sql = "SELECT * FROM {$table_name} ORDER BY id ASC";
		$query_result = $db->query($sql);
		confirm_query_exe($query_result);
		$data = $query_result->fetch_all(MYSQLI_ASSOC);
		return [$query_result,$data];
	}

	function find_single($table_name,$id) {
		global $db;
		$sql = "SELECT * FROM {$table_name} WHERE id = '{$id}'";
		$query_result = $db->query($sql);
		confirm_query_exe($query_result);
		$data = $query_result->fetch_assoc();
		return [$query_result,$data];
	}

	function insert_record($table_name,$menu_name,$position,$visible) {
		global $db;

		$sql = "INSERT INTO {$table_name} SET menu_name = '{$menu_name}',position = '{$position}',visible = '{$visible}'";
		$result = $db->query($sql);
		if ($result) {
			return true;
		}
		else{
			echo $db->error;
			db_disconnect($db);
			exit();
		}
		
	}


?>