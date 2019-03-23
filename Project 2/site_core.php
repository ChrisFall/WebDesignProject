<?

/* -----------------------------------------------------------------------------
Returns start of HTML document from <!doctype> to <body> with Bootstrap 4.0 link
and custom style.css link. Slices title into head	

Input: Webpage title (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_head($title) {
	return '
		<!doctype html>
		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		    <link rel="stylesheet" href="style.css">
		    <title>'.$title.'</title>
		  </head>
		  <body>';
}
/* -----------------------------------------------------------------------------
Echo return_head
----------------------------------------------------------------------------- */
function echo_head($title) {
	echo return_head($title);
}


/* -----------------------------------------------------------------------------
Returns end of HTML document from </body> to </html> with Bootstrap 4.0 scripts
jquery 3.2, popper 1.12 and boostrap 4.0

Input: None
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_foot() {
	return '
		    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script><br><br>
            <a href="login.php">LOGIN</a><br>
            <a href="admin_logout.php">LOGOUT</a><br>
            <a href="http://cg19fall.sienacs.com/Project%202">Back to Home</a><br>
            <a href="control_panel.php">Control Panel</a><br>
		  </body>
		</html>';
}
/* -----------------------------------------------------------------------------
Echo  return_foot
----------------------------------------------------------------------------- */
function echo_foot() {
	echo return_foot();
}	
	

/* -----------------------------------------------------------------------------
Returns HTML document content from content database

Input: The current page id (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_content($pageid) {   	
	$sql = "SELECT title, content, parent FROM cg19fall_pages WHERE pageid = '".$pageid."'";
	$content = run_query($sql)->fetch_assoc();
	  	
	return '
		<div class="container">
		  <h1>'.$content['title'].'</h1>
			<div class="row">
				<div class="col-lg">
					<main>'.$content['content'].'</main>
				</div>
				<div class="col-lg-4">
					'.return_side_content($pageid).'
				</div>
			</div>
			<footer>
				<a class="btn btn-primary float-left" href="?pageid='.$content['parent'].'">Back to parent</a>
				<p class="float-right copy-right">&copy; '.date("Y").'</p>
			</footer>		  
	  </div>';	
}
/* -----------------------------------------------------------------------------
Echo  return_content
----------------------------------------------------------------------------- */
function echo_content($pageid) {
	echo return_content($pageid);
}

function return_side_content($id) {
	$sql = "SELECT asideid FROM cg19fall_has_aside WHERE pageid = '$id' ORDER BY ord";
	$r = run_query($sql);
	//var_dump($r);
	$out = '';
	while ($row = $r->fetch_row()) {
		  $aid = $row[0];  
			$sql2 = "SELECT title, content, color FROM cg19fall_asides WHERE asideid = '$aid'";
	
			
			$r2 = run_query($sql2);
			$row1 = $r2->fetch_assoc();
			$out = $out . '<p style="color: '.$row1['color'].'">'. $row1['content'].'</p><hr>';
	}
	return $out;
}





?>