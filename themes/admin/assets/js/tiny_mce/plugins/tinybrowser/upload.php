<?php
require_once('config_tinybrowser.php');
require_once('fns_tinybrowser.php');

// Set language
set_language();

// Set default encoding type
if (!headers_sent())
    header("Content-Type: text/html; charset={$_SESSION['tinybrowser']['encoding']}");

// Check and generate request tokens
secure_tokens();
// Check session exists
check_session_exists();



if(!$_SESSION['tinybrowser']['allowupload'])
{
	deny(TB_UPDENIED);
}

// Assign get variables
$typenow = ((isset($_GET['type']) && in_array($_GET['type'],$_SESSION['tinybrowser']['valid']['type'])) ? $_GET['type'] : 'image');
$foldernow = str_replace(array('../','..\\','..','./','.\\'),'',($_SESSION['tinybrowser']['allowfolders'] && isset($_REQUEST['folder']) ? urldecode($_REQUEST['folder']) : ''));
$passfolder = '&folder='.urlencode($foldernow);
$passfeid = (!empty($_GET['feid']) && preg_match("/^[a-zA-Z0-9_\-]+$/", $_GET['feid']) == true ? '&feid='.$_GET['feid'] : '');
$passupfeid = (!empty($_GET['feid']) && preg_match("/^[a-zA-Z0-9_\-]+$/", $_GET['feid']) == true ? $_GET['feid'] : '');
$tokenget = !empty($_SESSION['get_tokens'])  ? '&tokenget='.end($_SESSION['get_tokens']) : '';


// Assign upload path
if( strpos($foldernow,$_SESSION['tinybrowser']['path'][$typenow]) == 1)
    $uploadpath = urlencode($_SESSION['tinybrowser']['path'][$typenow].$foldernow);
else
    $uploadpath = urlencode($_SESSION['tinybrowser']['path'][$typenow]);

verify_dir($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow].$foldernow,$typenow);
// Assign directory structure to array
$uploaddirs=array();
dirtree($uploaddirs,$_SESSION['tinybrowser']['filetype'][$typenow],$_SESSION['tinybrowser']['docroot'],$_SESSION['tinybrowser']['path'][$typenow]);

// determine file dialog file types
switch ($typenow)
	{
	case 'image':
		$filestr = TB_TYPEIMG;
		break;
	case 'media':
		$filestr = TB_TYPEMEDIA;
		break;
	case 'file':
		$filestr = TB_TYPEFILE;
		break;
	}
$fileexts = str_replace(",",";",$_SESSION['tinybrowser']['filetype'][$typenow]);
$filelist = $filestr.' ('.$_SESSION['tinybrowser']['filetype'][$typenow].')';

// Initalise alert array
$notify = array(
	'type' => array(),
	'message' => array()
);
$goodqty = (!empty($_GET['goodfiles']) && is_numeric($_GET['goodfiles'])  && $_GET['goodfiles']>0 ? (int) $_GET['goodfiles'] : 0);
$badqty = (!empty($_GET['badfiles']) && is_numeric($_GET['badfiles']) && $_GET['badfiles']>0 ? (int) $_GET['badfiles'] : 0);
$dupqty = (!empty($_GET['dupfiles']) && is_numeric($_GET['dupfiles']) && $_GET['dupfiles']>0 ? (int) $_GET['dupfiles'] : 0);

if($goodqty>0)
	{
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGUPGOOD, $goodqty);
	}
if($badqty>0)
	{
	$notify['type'][]='failure';
	$notify['message'][]=sprintf(TB_MSGUPBAD, $badqty);
	}
if($dupqty>0)
	{
	$notify['type'][]='failure';
	$notify['message'][]=sprintf(TB_MSGUPDUP, $dupqty);
	}
if(isset($_GET['permerror']))
	{
	$notify['type'][]='failure';
	$notify['message'][]=sprintf(TB_MSGUPFAIL, $_SESSION['tinybrowser']['path'][$typenow]);
	}
	
// Check files/folder quota size limitt
if($_SESSION['tinybrowser']['quota_check'])
	{
	$foldersize = dirsize($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow]);
	// is folder size within quota size limit?
	if($foldersize > get_byte($_SESSION['tinybrowser']['max_quota']) )
	{
		$notify['type'][]='failure';
		$notify['message'][]=TB_MSGMAXQUOTA;
		$disableupload = true;
        if($_SESSION['tinybrowser']['max_quota_notified'])
        {
            $notified_subj = $_SERVER['SERVER_NAME'].' Folder Size Exceeded';
            $notified_message = <<<EOL
Dear WebMaster

The size of upload location: {$_SESSION['tinybrowser']['path']} has exceeded the quota limit: {$_SESSION['tinybrowser']['max_quota']}.
Solution #1 Please increase the quota size.
Solution #2 Please check, and remove unnecessary junk data.

To disable this notification, set \$_SESSION['tinybrowser']['max_quota_notified'] to false in config_tinybrowser.php.

Regards
TinyBrowser Notifier
EOL;

            @mail($_SESSION['tinybrowser']['webmaster_email'],$notified_subj,$notified_message,null);        
        }
    }
	else
	   $disableupload = false;
	}
else
   $disableupload = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>TinyBrowser :: <?php echo TB_UPLOAD; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Pragma" content="no-cache" />
<?php
if($passfeid == '' && $_SESSION['tinybrowser']['integration']=='tinymce')
	{
	?><link rel="stylesheet" type="text/css" media="all" href="<?php echo $_SESSION['tinybrowser']['tinymcecss']; ?>" /><?php
	}
else
	{
	?><link rel="stylesheet" type="text/css" media="all" href="css/stylefull_tinybrowser.css" /><?php 
	}
?>
<link rel="stylesheet" type="text/css" media="all" href="css/style_tinybrowser.css.php" />
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
function uploadComplete(url) {
document.location = url;
}
</script>
</head>
<?php

if($disableupload==false)
	{ ?>
<body onload='
      var so = new SWFObject("flexupload.swf", "mymovie", "100%", "340", "9", "#ffffff");
      so.addVariable("folder", "<?php echo $uploadpath; ?>");
      so.addVariable("uptype", "<?php echo $typenow; ?>");
      so.addVariable("destid", "<?php echo $passupfeid; ?>");
      so.addVariable("maxsize", "<?php echo get_byte($_SESSION['tinybrowser']['maxsize'][$typenow]); ?>");
      so.addVariable("sessid", "<?php echo session_id(); ?>");
      so.addVariable("obfus", "<?php echo end($_SESSION['get_tokens']); ?>");
      so.addVariable("filenames", "<?php echo $filelist; ?>");
      so.addVariable("extensions", "<?php echo $fileexts; ?>");
      so.addVariable("filenamelbl", "<?php echo TB_FILENAME; ?>");
      so.addVariable("sizelbl", "<?php echo TB_SIZE; ?>");
      so.addVariable("typelbl", "<?php echo TB_TYPE; ?>");
      so.addVariable("progresslbl", "<?php echo TB_PROGRESS; ?>");
      so.addVariable("browselbl", "<?php echo TB_BROWSE; ?>");
      so.addVariable("removelbl", "<?php echo TB_REMOVE; ?>");
      so.addVariable("uploadlbl", "<?php echo TB_UPLOAD; ?>");
      so.addVariable("uplimitmsg", "<?php echo TB_MSGMAXSIZE; ?>");
      so.addVariable("uplimitlbl", "<?php echo TB_TTLMAXSIZE; ?>");
      so.addVariable("uplimitbyte", "<?php echo TB_BYTES; ?>");
      so.addParam("allowScriptAccess", "always");
      so.addParam("type", "application/x-shockwave-flash");
      so.write("flashcontent");'>
	<?php }
else
	{ ?>
	<body>
	<?php }
if(isset($_GET['errmsg']))
{
	$notify['type'][] = 'failure';
	$notify['message'][]  = sprintf(htmlspecialchars($_GET['errmsg'],ENT_QUOTES,$_SESSION['tinybrowser']['encoding']), $errorqty);   
}
if(count($notify['type'])>0) alert($notify);
form_open('foldertab',false,'upload.php','?type='.$typenow.$tokenget.$passfeid);
?>
<div class="tabs">
<ul>
<li id="browse_tab"><span><a href="tinybrowser.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid ; ?>"><?php echo TB_BROWSE; ?></a></span></li>
<li id="upload_tab" class="current"><span><a href="upload.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid ; ?>"><?php echo TB_UPLOAD; ?></a></span></li>
<?php
if($_SESSION['tinybrowser']['allowedit'] || $_SESSION['tinybrowser']['allowdelete'])
	{
	?><li id="edit_tab"><span><a href="edit.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid ; ?>"><?php echo TB_EDIT; ?></a></span></li>
	<?php 
	}
if($_SESSION['tinybrowser']['allowfolders'])
	{
	?><li id="folders_tab"><span><a href="folders.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid; ?>"><?php echo TB_FOLDERS; ?></a></span></li><?php
	// Display folder select, if multiple exist
	if(count($uploaddirs)>1)
		{
		?><li id="folder_tab" class="right"><span><?php
		form_select($uploaddirs,'folder',TB_FOLDERCURR,urlencode($foldernow),true);
		if(!empty($_SESSION['post_tokens'])) form_hidden_input('tokenpost',end($_SESSION['post_tokens']));
		?></span></li><?php
		}
	}
?>
</ul>
</div>
</form>
<div class="panel_wrapper">
<div id="general_panel" class="panel currentmod">
<fieldset>
<legend><?php echo TB_UPLOADFILES; ?></legend>
    <div id="flashcontent"></div>
</fieldset></div></div>
</body>
</html>