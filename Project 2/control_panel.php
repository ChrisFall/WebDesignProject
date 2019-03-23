<?
require_once('site_db.php');
require_once('site_core.php');
require_once('site_nav.php');

session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');

echo_head('Site Title');

echo'
<h2>Control Panel</h2>
<p>This page can be used to insert, edit, or delete pages and asides from the website.</p>
<h3>Would you like to:</h3>
<ol>
   <li>Insert New Webpage<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/insert_page.php">Click Here</a></li></ul></li>
   <li>Insert New Aside<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/insert_aside.php">Click Here</a></li></ul></li>
   <li>Insert New Has Aside<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/insert_has_aside.php">Click Here</a></li></ul></li> 
   <li>Insert New User<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/insert_user.php">Click Here</a></li></ul></li>
   <li>Delete a Webpage<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/basic_delete.php">Click Here</a></li></ul></li>
   <li>Delete an Aside<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/delete_asides.php">Click Here</a></li></ul></li>
   <li>Delete Has Aside<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/delete_has_aside.php">Click Here</a></li></ul></li>
   <li>Delete a User<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/delete_user.php">Click Here</a></li></ul></li>
   <li>Update a Webpage<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/basic_update.php">Click Here</a></li></ul></li>
   <li>Update an Aside<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/update_asides.php">Click Here</a></li></ul></li>
   <li>Update Has Aside<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/update_has_aside.php">Click Here</a></li></ul></li>
   <li>Update a User<ul><li><a href = "http://cg19fall.sienacs.com/Project%202/update_user.php">Click Here</a></li></ul></li>
   
</ol>';
echo_foot();

?>