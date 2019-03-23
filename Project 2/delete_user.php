<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');

$title = "Delete User";
$table = "cg19fall_users";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
		$result = run_query("SELECT userid FROM cg19fall_users");
        $users = array();
        while ($row = $result->fetch_assoc()){
            $users[ $row['userid'] ]= $row['userid'];
        }
    
        echo ' 
        <form method="get" action = "delete_user.php">'.
            return_option_select('id', $users, 'Select a user').'
            <input type="submit">
        </form>';
        
}
else if ($action=='delete') {
	$sql = "DELETE FROM cg19fall_users WHERE userid='$id'";
	run_query($sql);

	
	echo '<p><b>'.$id.'</b> was deleted from <b>'.$table.'</b></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$id.'</b> from <b>'.$table.'</b>?</p>
		<p>
			<a href="delete_user.php?action=delete&id='.$id.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>