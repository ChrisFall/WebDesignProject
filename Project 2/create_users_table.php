<?
require_once('site_db.php');
//if ($_GET['key'] != 'abc123') die ('Access Denied');

session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');

$sql = "CREATE TABLE IF NOT EXISTS  `cg19fall_users` (
	`userid` varchar(32) NOT NULL,
	`password` varchar(128) NOT NULL,
	`type` int(11) DEFAULT 0,
	PRIMARY KEY (`userid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: '.$sql;
?>