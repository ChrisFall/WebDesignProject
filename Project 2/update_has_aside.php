<?
session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Update Has Aside";
$table = "cg19fall_has_aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$pageid = $_GET['pageid'];
$asideid = $_GET['asideid'];
$ord = $_GET['ord'];
$action = $_GET['action'];

if ($pageid == '' || $asideid == '') {
    echo '
		<form action="?action=update" method="get">'.
            return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('asideid','Aside ID',$values['asideid'],true).'			
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';    
        
}
else if ($action=='update') {
    
    $pageid = $_POST['pageid'];
    $asideid = $_POST['asideid'];
    $ord = $_POST['ord'];
    
    
	$sql = "Update cg19fall_has_aside SET pageid='$pageid', asideid='$asideid', ord='$ord'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo 'Has Aside Updated';
}
else {		
	echo '
		<form action="update_has_aside.php?action=update&pageid='.$pageid.'&asideid='.$asideid.'" method="post">'.
			return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('asideid','Aside ID',$values['asideid'],true).
            return_input_text('ord', 'Ord',$values['ord'],true).'            
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';
}

echo '</div>';

echo_foot();

?>