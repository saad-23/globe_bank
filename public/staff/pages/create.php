<?php
	require_once('../../../private/initialize.php');

 if(is_post_request())
  {
    $page = [];
    $page['menu_name'] = htmlspecialchars($_POST['menu_name']) ?? '';
    $page['position'] = htmlspecialchars($_POST['position']) ?? '';
    $page['visible'] = htmlspecialchars($_POST['visible']) ?? '';

    $result = insert_record("pages",$page);
    redirect_to(url_for("/staff/pages/index.php"));
  }
  else{
    redirect_to(url_for("/staff/pages/new.php"));
   	
  }

?>