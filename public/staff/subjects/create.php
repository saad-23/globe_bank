<?php
	require_once('../../../private/initialize.php');

	if(is_post_request())
	{
		$menu_name = $_POST['menu_name'];
		$position = $_POST['position'];
		$visible = $_POST['visible'];
		$result = insert_record("subjects",$menu_name,$position,$visible);
		
			$newRecordID = $db->insert_id;
			redirect_to(url_for("/staff/subjects/show.php?id={$newRecordID}"));
		
	}
	else{
		redirect_to(url_for("/staff/subjects/new.php"));
	}

?>