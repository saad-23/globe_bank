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
	
	function validate_subject($items) {

	  $errors = [];
	  
	  // menu_name
	  if(is_blank($items['menu_name'])) {
	    $errors[] = "Menu Name cannot be blank.";
	  }elseif(!has_length($items['menu_name'], ['min' => 2, 'max' => 255])) {
	    $errors[] = "Menu Name must be between 2 and 255 characters.";
	  }

	  // position
	  // Make sure we are working with an integer
	  $postion_int = (int) $items['position'];
	  if($postion_int <= 0) {
	    $errors[] = "Position must be greater than zero.";
	  }
	  if($postion_int > 999) {
	    $errors[] = "Position must be less than 999.";
	  }

	  // visible
	  // Make sure we are working with a string
	  $visible_str = (string) $items['visible'];
	  if(!has_inclusion_of($visible_str, ["0","1"])) {
	    $errors[] = "Visible must be true or false.";
	  }

	  if (isset($items['subject_id'])) 
	  {
	  	 $subject_id = (int) $items['subject_id'];
	  	 if (is_blank($subject_id)) {
	  	 		$errors[] = "Subject field will not be empty";
	  	 }
	  }

	  if (isset($items['content'])) 
	  {
	  	 $content = $items['content'];
	  	 if (is_blank($content)) {
	  	 		$errors[] = "content field will not be empty";
	  	 }
	  }

	  return $errors;
}


	function insert_record($table_name,$params) {
		global $db;
		$errors = validate_subject($params);
		if (!empty($errors)) 
		{
			 return $errors;
		}

		extract($params);
				$sql = "INSERT INTO {$table_name} SET menu_name = '{$menu_name}',position = '{$position}',";
				if(isset($subject_id))
				{
					$sql .= "subject_id = '{$subject_id}', ";
				}
				if(isset($content))
				{
					$sql .= "content = '{$content}',";
				}
					$sql .= "visible = '{$visible}' ";

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

	function update_record($table_name,$params) {
		global $db;
		$errors = validate_subject($params);
		if (!empty($errors)) 
		{
			 return $errors;
		}

		extract($params);

				$sql = "UPDATE {$table_name} SET ";
				$sql .= "menu_name = '{$menu_name}',position='{$position}', ";
				if(isset($subject_id))
				{
					$sql .= "subject_id = '{$subject_id}', ";
				}
				if(isset($content))
				{
					$sql .= "content = '{$content}', ";
				}
				$sql .= "visible = '{$visible}' ";
				$sql .= "WHERE id = '{$id}' LIMIT 1";

				// echo $sql;exit();

		$query_result = $db->query($sql);
		if ($query_result) {
			return true;
		}
		else{
			echo $db->error;
			db_disconnect($db);
			exit();
		}

	}

	function delete_record($table_name,$id) {
			global $db;
			$sql = "DELETE FROM {$table_name} WHERE id = '{$id}' LIMIT 1";
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