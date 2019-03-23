<?
	
/* -----------------------------------------------------------------------------
Returns the HTML of a labeled input text element with Bootstrap class names

Input: 
  Name of element (string)
  Text label of element (string)
  Value of element (string)
  Is the element required (boolean)
  

Output: HTML text (string)	
----------------------------------------------------------------------------- */
	
function return_input_text($name, $label, $value='', $required=false) {
	if ($required) $req = 'required';
	else $req = '';
	return '
		<div class="form-group">
			<label for="'.$name.'">'.$label.'</label>
			<input type="text" class="form-control" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$req.'>
		</div>';
}
/* -----------------------------------------------------------------------------
Echos return_input_text
----------------------------------------------------------------------------- */
function echo_input_text($name, $label, $value) {
	echo return_input_text($name, $label, $value);
}

/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting rows into the pages table

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_page_form($values) {
	
    $result = run_query("SELECT pageid, title FROM cg19fall_pages");
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
	}
    
    $result = run_query("SELECT * FROM cg19fall_pages WHERE pageid='$id'");
	$values = $result->fetch_assoc();
    
    return '
		<form action="?action=insert" method="post">'.
			return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_option_select('parent',$pages,'Parent Page',$values['parent']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
/* -----------------------------------------------------------------------------
Echos return_page_form
----------------------------------------------------------------------------- */
function echo_page_form($values) {
    
	echo return_page_form($values);
}

/* -----------------------------------------------------------------------------
Inserts a new row into the pages table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */
function insert_page($values) {
	$pageid = $values['pageid'];
	$title = $values['title'];
	$content = $values['content'];
	$parent = $values['parent'];
	$sql = "INSERT INTO cg19fall_pages (pageid, title, content, parent) VALUES ('$pageid','$title','$content','$parent')";
	run_query($sql);
}

function return_textarea($name, $label, $value='', $required=false){
    if ($required) $req = 'required';
	else $req = '';
	return '
		<div class="form-group">
			<label for="'.$name.'">'.$label.'</label>
			<textarea class="form-control" name="'.$name.'" id="'.$name.'" rows="10" '.$req.'>'.$value.'</textarea>
		</div>';
}

function echo_textarea($name, $label, $value){
    echo return_textarea($name, $label, $value);
}
	

function return_aside_form($values) {
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('asideid','Aside ID',$values['asideid'],true).
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_input_text('color','Color',$values['color']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}

function echo_aside_form($values) {
    
	echo return_aside_form($values);
}

function insert_aside($values) {
	$asideid = $values['asideid'];
	$title = $values['title'];
	$content = $values['content'];
	$color = $values['color'];
	$sql = "INSERT INTO cg19fall_asides (asideid, title, content, color) VALUES ('$asideid','$title','$content','$color')";
	run_query($sql);
}

function return_has_aside_form($values) {
	return '
		<form action="?action=insert" method="post">'.
            return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('asideid','Aside ID',$values['asideid'],true).
			return_input_text('ord', 'Ord', $values['ord'], true).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}

function echo_has_aside_form($values) {
    
	echo return_has_aside_form($values);
}

function insert_has_aside($values) {
	$pageid = $values['pageid'];
    $asideid = $values['asideid'];
	$ord = $values['ord'];
	$sql = "INSERT INTO cg19fall_has_aside (pageid, asideid, ord) VALUES ('$pageid','$asideid','$ord')";
	run_query($sql);
}

function insert_user($values) {
	$userid = $values['userid'];
    $password = $values['password'];
    $hashed_passwd = password_hash($password, PASSWORD_DEFAULT);
    $type = $values['type'];
	$sql = "INSERT INTO cg19fall_users (userid, password, type) VALUES ('$userid', '$hashed_passwd', '$type')";
	run_query($sql);
}

function return_user_form($values) {
	
    
    return '
		<form action="?action=insert" method="post">'.
			return_input_text('userid','User ID',$values['userid'],true).
			return_input_text('password','Password',$values['password'],true).
			return_input_text('type','Type',$values['type'],true).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}

function echo_user_form($values) {
    
	echo return_user_form($values);
}

/* -----------------------------------------------------------------------------
Echo an option select menu

Input:
label - The label of the form element (string)
name - Uses as both the name and id of the element (string)
list - An assoicative array of unique ids and display titles

Output:  None, this function will echo HTML but return null	
----------------------------------------------------------------------------- */
		
function return_option_select($name, $list, $label='', $v='') {
	$ouput = '
	<div class="form-group">';
	
	if ($label != '')
	$ouput .= '
		<label for="'.$name.'">'.$label.'</label>';
		
	$ouput .= '		
		<select class="form-control" id="'.$name.'" name="'.$name.'">';

	foreach ($list as $id => $title) {
		$selected = '';
		if ($id == $v) $selected = 'selected';
		$ouput .= '
			<option value="'.$id.'" '.$selected.'>'.$title.'</option>';
	}
	$ouput .=  '
		</select>
	</div>';
	return $ouput;
}
/* -----------------------------------------------------------------------------
Echos eturn_option_select
----------------------------------------------------------------------------- */
function echo_option_select($name, $list, $label, $v) {
	echo return_option_select($name, $list, $label, $v);
}


?>