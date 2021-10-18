<?php  

function url_for($script_path)
{
	// Add the leading  '/' if not present
	 if($script_path[0] != "/")
	 {
	 	 $script_path = "/" . $script_path;
	 }
	 return WWW_ROOT . $script_path;
}

function u($string="")
{
	return urlencode($string);
}

function raw_u($string="")
{
	return rawurlencode($string);
}

function error_404()
{
	header($_SERVER['SERVER_PROTOCOL'] . " 404 Error");
	exit();
}

function error_500()
{
	header($_SERVER['SERVER_PROTOCOL'] . " 500 Internal Server Error");
	exit();
}

function redirect_to($location)
{
	header("Location: ".$location);
	exit();
}

function is_post_request()
{
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors = array())
{
	$output = "";
	if (!empty($errors)) 
	{
		$output = "<div class='errors'>";
		$output .= "<ul>";
		$output .= "Please fill the following fields:";
		foreach ($errors as $error) {
			$output .= "<li>";
				$output .= "{$error}";
			$output .= "</li>";

		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}


// This function will return a string type value 
function get_field_value($field_name,$edit_array=[]) {
	return ($_POST[$field_name]) ?? $edit_array[$field_name] ?? '';
}
?>