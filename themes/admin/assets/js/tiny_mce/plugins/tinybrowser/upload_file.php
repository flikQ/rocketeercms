<?php
require_once('config_tinybrowser.php');
require_once('fns_tinybrowser.php');

// Set language
set_language();

// Check session exists
check_session_exists();
	
// Initialise error array
$errors = array();
	
if(!$_SESSION['tinybrowser']['allowupload']) {
	$errors[] = TB_UPDENIED;
}
	
// Check request token
if(!$_SESSION['tinybrowser']['debug_mode']) {
   $find_token = array_search($_GET['obfuscate'],$_SESSION['get_tokens']);
   if($find_token===false) { $errors[] = TB_DENIED;}
}

// Check  and assign get variables
if(isset($_GET['type']) && in_array($_GET['type'],$_SESSION['tinybrowser']['valid']['type'])) { $typenow = $_GET['type']; } else { $errors[] = TB_INVALID_FILETYPE; }
if(isset($_GET['folder'])) {$dest_folder = urldecode($_GET['folder']); } else { $errors[] = TB_NOT_IN_ALLOWED_DIR; }

// Check file extension isn't prohibited
$nameparts = explode('.',$_FILES['Filedata']['name']);
$ext = end($nameparts);
if(!validateExtension($ext, $_SESSION['tinybrowser']['prohibited'])) { $errors[] = TB_FORBIDDEN_FILEXT; }
if(strpos($_SESSION['tinybrowser']['filetype'][$typenow],$ext) === false) {  $errors[] = TB_FORBIDDEN_FILEXT; }

// Check file size
if(isset($_FILES['Filedata']['size']) && $_FILES['Filedata']['size'] > get_byte($_SESSION['tinybrowser']['maxsize'][$typenow]) ) {  $errors[] = TB_MSGMAXSIZE; }

if($_SESSION['tinybrowser']['debug_mode'] && !empty($_SESSION['tinybrowser']['webmaster_email'])) {
	$msg = "ERRORS: ".print_r($errors,true)."\n\nPOST: ".print_r($_POST,true)."\n\nGET: ".print_r($_GET,true)."\n\nSESSION: ".print_r($_SESSION,true);
	mail($_SESSION['tinybrowser']['webmaster_email'],'TinyBrowser File Upload Attempt',$msg);
	if(!empty($errors)) exit;
}

// Check file data
if ($_FILES['Filedata']['tmp_name'] && $_FILES['Filedata']['name']) {

	$source_file = $_FILES['Filedata']['tmp_name'];
	$file_name = stripslashes($_FILES['Filedata']['name']);
	if($_SESSION['tinybrowser']['cleanfilename']) $file_name = clean_filename($file_name);
   verify_dir($_SESSION['tinybrowser']['docroot'].$dest_folder);
	if(is_dir($_SESSION['tinybrowser']['docroot'].$dest_folder)) {
		$success = copy($source_file,$_SESSION['tinybrowser']['docroot'].$dest_folder.'/'.$file_name.'_');
	}
	if($success) {
		header('HTTP/1.1 200 OK'); //  if this doesn't work for you, try header('HTTP/1.1 201 Created');
		?><html><head><title>File Upload Success</title></head><body>File Upload Success</body></html><?php
	}
}
?>
