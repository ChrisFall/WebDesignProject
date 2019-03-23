<?
session_start();
	
require_once('site_core.php');
require_once('site_db.php');

echo_head("User Login");
echo '<div class="container">';


if ($_SESSION['authenticated']) {
  echo '
    <div class="alert alert-info">Already logged in</div>
    <a href="admin_logout.php" class="btn btn-primary">Logout</a>';
}
else {
    $userid = $_POST['userid'];
    if($userid == null)
        echo'
            <form action = "login.php" method="post">
            <label>User ID: <input type = "text", class="form-control", name = "userid"></label>
            <label>Password: <input type = "password", class = "form-control", name = "password"></label><br>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="?" class="btn btn-warning">Clear</a>
            </form>

        ';
    
    else {
        $user_submitted_password = $_POST['password'];
        $sql = "SELECT password, type FROM cg19fall_users WHERE userid = '$userid'";
        $result = run_query($sql);
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $type = $row['type'];
        
        if (password_verify($user_submitted_password, $hashed_password)) {
            $_SESSION['authenticated'] = true;
            if($type > 0){
                $_SESSION['admin'] = true;
            }
            echo 'Password is valid!
            <a href="control_panel.php">Control Panel</a><br>
            <a href="http://cg19fall.sienacs.com/Project%202">Back to Home</a>';
        }
        else {
            echo 'Invalid password.';
        }
    }
}


echo '</div>';
echo_foot();	
?>