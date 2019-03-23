<?
session_start();
if (!$_SESSION['admin']) die ('Access Denied');

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Delete Has Aside";
$table = "cg19fall_has_aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$pageid = $_GET['pageid'];
$asideid = $_GET['asideid'];
$action = $_GET['action'];

if ($pageid == '' || $asideid == '') {
    echo '
		<form action="?action=delete" method="get">'.
            return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('asideid','Aside ID',$values['asideid'],true).'			
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';    
        
}
else if ($action=='delete') {
	$sql = "DELETE FROM cg19fall_has_aside WHERE pageid='$pageid' && asideid='$asideid'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo 'Has Aside Deleted';
}
else {		
	echo '
		<p>Are you sure you want to delete this from <b>'.$table.'</b>?</p>
		<p>
			<a href="delete_has_aside.php?action=delete&pageid='.$pageid.'&asideid='.$asideid.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>