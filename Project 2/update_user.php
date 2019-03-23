<?
session_start();
if (!$_SESSION['admin']) die ('Access Denied');

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update User";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$userid = $_GET['userid'];
$action = $_GET['action'];

// If the id is null/blank
if ($userid == '') {
	
	// Get the pageid and title of all pages
	$result = run_query("SELECT userid FROM cg19fall_users");
	
	// Transform it into an associative array
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}
	
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="update_user.php">'.
			return_option_select('userid',$users,'Select a User').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$type = $_POST['type'];
	
	// Form the query
	$sql = "UPDATE cg19fall_users SET userid = '$userid', password = '$password', type = '$type' WHERE userid='$userid'";

	// Run the query
	run_query($sql);

}

// If the id is given but action is not update
else {
	
	// Get all the pages to generate the parent drop down
	$result = run_query("SELECT userid FROM cg19fall_users");
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}	
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM cg19fall_users WHERE userid='$userid'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_user.php?action=update&userid='.$userid.'" method="post">
			<label>User ID: </label> <b>'.$userid.'</b><br>'.
			return_input_text('userid','User ID',$values['userid'],true).
			return_input_text('password','Password',$values['password']). 	
			return_input_text('type','Type',$values['type'],true).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>