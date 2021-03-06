<?
session_start();
if (!$_SESSION['admin']) die ('Access Denied');

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the aside
$title = "Delete Aside";
$table = "cg19fall_asides";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
		$result = run_query("SELECT asideid, title FROM cg19fall_asides");
        $asides = array();
        while ($row = $result->fetch_assoc()){
            $asides[ $row['asideid'] ]= $row['title'];
        }
    
        echo ' 
        <form method="get" action = "delete_asides.php">'.
            return_option_select('id', $asides, 'Select an aside').'
            <input type="submit">
        </form>';
        
}
else if ($action=='delete') {
	$sql = "DELETE FROM cg19fall_asides WHERE asideid='$id'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$id.'</b> was deleted from <b>'.$table.'</b></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$id.'</b> from <b>'.$table.'</b>?</p>
		<p>
			<a href="delete_asides.php?action=delete&id='.$id.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>