<?php
	require_once('../../../private/initialize.php');

	if(is_post_request())
	{
		$subject = [];
		$subject['menu_name'] = htmlspecialchars($_POST['menu_name']) ?? '';
		$subject['position'] = htmlspecialchars($_POST['position']) ?? '';
		$subject['visible'] = htmlspecialchars($_POST['visible']) ?? '';
		$result = insert_record("subjects",$subject);
		
			$newRecordID = $db->insert_id;
			redirect_to(url_for("/staff/subjects/show.php?id={$newRecordID}"));
		
	}
	else{
		redirect_to(url_for("/staff/subjects/new.php"));
	}

?>