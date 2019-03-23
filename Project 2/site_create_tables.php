<?
	
require_once('site_db.php');

$sql = "CREATE TABLE IF NOT EXISTS `cg19fall_pages` (
  `pageid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `parent` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`pageid`)
)";

$asides = "CREATE TABLE IF NOT EXISTS `cg19fall_asides` (
  `asideid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `color` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`asideid`)
)";

$has_asides = "CREATE TABLE IF NOT EXISTS `cg19fall_has_aside` (
  `pageid` varchar(32) NOT NULL,
  `asideid` varchar(32) NOT NULL,
  `ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageid`,`asideid`)
)";


run_query($sql);
run_query($asides);
run_query($has_asides);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';
echo 'SUCCESS: The following query executed: <pre>'.$asides.'</pre>';
echo 'SUCCESS: The following query executed: <pre>'.$has_asides.'</pre>';
	
?>