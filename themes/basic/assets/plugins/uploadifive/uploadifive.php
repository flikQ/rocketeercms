<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/


$userupload = '/uploads/user_avatars/';

// Set the uplaod directory
$uploadDir = $userupload;

// Set the allowed file extensions
$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions

if (!empty($_FILES)) {
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
	$targetFile = $uploadDir . $_FILES['Filedata']['name'];

	// Validate the filetype
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		// Save the file
		move_uploaded_file($tempFile,$targetFile);
		echo 1;

	} else {

		// The file type wasn't allowed
		echo 'Invalid file type.';

	}
}
?>