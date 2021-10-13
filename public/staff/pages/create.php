<?php
	require_once('../../../private/initialize.php');

 if(is_post_request())
  {
    $page = [];
    $page['menu_name'] = htmlspecialchars($_POST['menu_name']) ?? '';
    $page['position'] = htmlspecialchars($_POST['position']) ?? '';
    $page['visible'] = htmlspecialchars($_POST['visible']) ?? '';
    $page['content'] = htmlspecialchars($_POST['content']) ?? '';
    $page['subject_id'] = htmlspecialchars($_POST['subject_id']) ?? '';

    $result = insert_record("pages",$page);
    $newRecordID = $db->insert_id;
    redirect_to(url_for("/staff/pages/show.php?id={$newRecordID}"));
  }
  else{
    redirect_to(url_for("/staff/pages/new.php"));
   	
  }

?>