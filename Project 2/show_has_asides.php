<?

require_once('site_core.php');
require_once('site_db.php');

// Set the title of the page
$title = "Show Table";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';


// Get the column info first
$table = $_GET['table'];
$result = run_query("SHOW COLUMNS FROM cg19fall_has_aside");

// Output the column titles
echo '<table class="table">';
echo '<tr><th>Action</th>';
while ($row = $result->fetch_row()) {
	echo '<th>'.$row[0]."</th>";
}
echo '</tr>';

$result->close();

// Get all the rows of data
$result = run_query("SELECT * FROM cg19fall_has_aside");

// Fetch each row one at a time
while ($row = $result->fetch_row()) {
	echo '<tr><td><a href="delete_has_aside.php?pid='.$row[0].'&aid='.$row[1].'">Delete</a></td>';
	
	// Loops for each column in a row
	foreach ($row as $value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';

$result->close();

echo '</div>';

echo_foot();

?>