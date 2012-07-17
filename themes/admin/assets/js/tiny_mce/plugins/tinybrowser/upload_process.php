<?php
require_once('config_tinybrowser.php');
require_once('fns_tinybrowser.php');

// Set language
set_language();
// Generate request tokens
secure_tokens(false,true);
// Check session exists
check_session_exists();
	
if(!$_SESSION['tinybrowser']['allowupload'])
{
	echo TB_UPDENIED;
	exit;
}

// delay script if set
if($_SESSION['tinybrowser']['delayprocess']>0) sleep($_SESSION['tinybrowser']['delayprocess']);

// Initialise files array and error vars
$files = array();
$good = 0;
$bad = 0;
$dup = 0;
$total = ((!empty($_GET['filetotal']) && is_numeric($_GET['filetotal']) && $_GET['filetotal']>0) ? (int) $_GET['filetotal'] : 0);


// Assign get variables
$typenow = ((isset($_GET['type']) && in_array($_GET['type'],$_SESSION['tinybrowser']['valid']['type'])) ? $_GET['type'] : 'image');
$folder = $_SESSION['tinybrowser']['docroot'].urldecode($_GET['folder']);
$foldernow = urlencode(str_replace($_SESSION['tinybrowser']['path'][$typenow],'',urldecode($_GET['folder'])));
$passfeid = (!empty($_GET['feid']) && preg_match("/^[a-zA-Z0-9_\-]+$/", $_GET['feid']) == true ? '&feid='.$_GET['feid'] : '');
$tokenget = !empty($_SESSION['get_tokens'])  ? '&tokenget='.end($_SESSION['get_tokens']) : '';

// security check
verify_dir(array($folder,$foldernow),$typenow);

if ($handle = opendir($folder))
	{
	while (false !== ($file = readdir($handle)))
		{
		  
		if ($file != "." && $file != ".." && substr($file,-1)=='_')
			{
			//-- File Naming
			$tmp_filename = $folder.$file;
			$dest_filename	 = $folder.rtrim($file,'_');
        
			//-- Duplicate Files
			if(file_exists($dest_filename)) { unlink($tmp_filename); $dup++; continue; }

			//-- Bad extensions
			$nameparts = explode('.',$dest_filename);
			$ext = end($nameparts);
			
			if(!validateExtension($ext, $_SESSION['tinybrowser']['prohibited'])) { unlink($tmp_filename); continue; }
            
            // -- Allow only certain extension; otherwise remove tmp file
            if(strpos($_SESSION['tinybrowser']['filetype'][$typenow],$ext) < 0) {unlink($tmp_filename); continue; }
        
			//-- Rename temp file to dest file
			rename($tmp_filename, $dest_filename);
			$good++;
			
			//-- if image, perform additional processing
			if($typenow =='image')
				{
				//-- Good mime-types
				$imginfo = getimagesize($dest_filename);
	   		if($imginfo === false) { unlink($dest_filename); continue; }
				$mime = $imginfo['mime'];

				// resize image to maximum height and width, if set
				if($_SESSION['tinybrowser']['imageresize']['width'] > 0 || $_SESSION['tinybrowser']['imageresize']['height'] > 0)
					{
					// assign new width and height values, only if they are less than existing image size
					$widthnew  = ($_SESSION['tinybrowser']['imageresize']['width'] > 0 && $_SESSION['tinybrowser']['imageresize']['width'] < $imginfo[0] ? $_SESSION['tinybrowser']['imageresize']['width'] : $imginfo[0]);
					$heightnew = ($_SESSION['tinybrowser']['imageresize']['height'] > 0 && $_SESSION['tinybrowser']['imageresize']['height'] < $imginfo[1] ? $_SESSION['tinybrowser']['imageresize']['height'] :  $imginfo[1]);

					// only resize if width or height values are different
					if($widthnew != $imginfo[0] || $heightnew != $imginfo[1])
						{
						$im = convert_image($dest_filename,$mime);
						resizeimage($im,$widthnew,$heightnew,$dest_filename,$_SESSION['tinybrowser']['imagequality'],$mime);
						imagedestroy($im);
						}
					}

				// generate thumbnail
				$thumbimg = $folder.'_thumbs/_'.rtrim($file,'_');
				if (!file_exists($thumbimg))
					{
					$im = convert_image($dest_filename,$mime);                    
					resizeimage	($im,$_SESSION['tinybrowser']['thumbsize'],$_SESSION['tinybrowser']['thumbsize'],$thumbimg,$_SESSION['tinybrowser']['thumbquality'],$mime);
					imagedestroy ($im);
					}
				}

      	}
		}
	closedir($handle);
	}
$bad = $total-($good+$dup);

// Check for problem during upload
if($total>0 && $bad==$total) header('Location: ./upload.php?type='.$typenow.$tokenget.$passfeid.'&permerror=1&total='.$total);
else header('Location: ./upload.php?type='.$typenow.$tokenget.$passfeid.'&folder='.$foldernow.'&badfiles='.$bad.'&goodfiles='.$good.'&dupfiles='.$dup);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Pragma" content="no-cache" />
		<title>TinyBrowser :: Process Upload</title>
	</head>
	<body>
		<p>Sorry, there was an error processing file uploads.</p>
	</body>
</html>
