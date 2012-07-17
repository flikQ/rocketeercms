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
	
if(!$_SESSION['tinybrowser']['allowfolders'])
{
	deny(TB_FODENIED);
}




// Assign request / get / post variables
$typenow = ((isset($_GET['type']) && in_array($_GET['type'],$_SESSION['tinybrowser']['valid']['type'])) ? $_GET['type'] : 'image');
$foldernow = str_replace(array('../','..\\','..','./','.\\'),'',($_SESSION['tinybrowser']['allowfolders'] && isset($_REQUEST['folder']) ? urldecode($_REQUEST['folder']) : ''));
$dirpath = $_SESSION['tinybrowser']['path'][$typenow];
$passfolder = '&folder='.urlencode($foldernow);
$passfeid = (!empty($_GET['feid']) && preg_match("/^[a-zA-Z0-9_\-]+$/", $_GET['feid']) == true ? '&feid='.$_GET['feid'] : '');
$tokenget = !empty($_SESSION['get_tokens'])  ? '&tokenget='.end($_SESSION['get_tokens']) : '';


// security check 
verify_dir($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow].$foldernow,$typenow);


// Assign browsing options
$actionnow = ((isset($_POST['action']) && in_array($_POST['action'],$_SESSION['tinybrowser']['valid']['action'])) ? $_POST['action'] : 'create' );

// Initalise alert array
$notify = array(
	'type' => array(),
	'message' => array()
);
$createqty = 0;
$deleteqty = 0;
$renameqty = 0;
$errorqty = 0;
	
// Create any child folders with entered name
if(isset($_POST['createfolder']))
{
	foreach($_POST['createfolder'] as $parent => $newfolder)
	{
		if($newfolder != '')
		{
		      
			$safefolder = str_replace(array('../','..\\','./','.\\','..'),'',urldecode($_POST['actionfolder'][$parent]));
         $newfolder = substr( $newfolder, 0,32); // 32 in length
         $newfolder = clean_dirname($newfolder); 
         if (has_bad_utf8($newfolder) || strlen($newfolder) == 0)
         {                
             deny(TB_INVALID_FOLDERNAME);
         }                  
			$createthisfolder = $_SESSION['tinybrowser']['docroot'].$dirpath.$safefolder.clean_filename($newfolder);
			verify_dir($createthisfolder,$typenow);
			if (!file_exists($createthisfolder) && createfolder($createthisfolder,$_SESSION['tinybrowser']['unixpermissions'])) $createqty++; else $errorqty++;
			if($typenow=='image')
            {
				createfolder($createthisfolder.'/_thumbs/',$_SESSION['tinybrowser']['unixpermissions']);
			}
		}
	}
}

// Delete any checked folders
if(isset($_POST['deletefolder']))
	{
	foreach($_POST['deletefolder'] as $delthis => $val)
		{
		$safefolder = str_replace(array('../','..\\','./','.\\'),'',urldecode($_POST['actionfolder'][$delthis]));
		if($typenow   == 'image')
		{
			$delthisthumbdir = $_SESSION['tinybrowser']['docroot'].$dirpath.$safefolder.'_thumbs/';
         verify_dir($delthisthumbdir,$typenow);
			if (is_dir($delthisthumbdir)) @rmdir($delthisthumbdir);
		}
		$delthisdir = $_SESSION['tinybrowser']['docroot'].$dirpath.$safefolder;
      verify_dir($delthisdir);
		if (file_exists($delthisdir) && is_dir_empty($delthisdir) && is_dir($delthisdir) && @rmdir($delthisdir)) $deleteqty++; else $errorqty++;
		if($foldernow==urldecode($_POST['actionfolder'][$delthis]))
         {
             $foldernow = '';
             $passfolder = '';
         }
		}

	}

// Rename any folders with changed name
if(isset($_POST['renamefolder']))
	{
	foreach($_POST['renamefolder'] as $namethis => $newname)
		{
      $urlparts = explode('/',rtrim(urldecode($_POST['actionfolder'][$namethis]),'/'));
      $safefolder = str_replace(array('../','..\\','./','.\\'),'',urldecode($_POST['actionfolder'][$namethis]));

		if(array_pop($urlparts) != $newname)
			{
			$namethisfolderfrom = $_SESSION['tinybrowser']['docroot'].$dirpath.$safefolder;
         $renameurl = implode('/',$urlparts).'/'.clean_filename($newname).'/';
			$namethisfolderto = $_SESSION['tinybrowser']['docroot'].$dirpath.$renameurl;
         verify_dir(array($namethisfolderfrom,$namethisfolderto),$typenow);
			if (is_dir($namethisfolderfrom) && rename($namethisfolderfrom,$namethisfolderto)) $renameqty++; else $errorqty++;
			if($foldernow==urldecode($_POST['actionfolder'][$namethis]))
            {
                $foldernow = ltrim($renameurl,'/');
                $passfolder = '&folder='.urlencode(ltrim($renameurl,'/'));
            }
			}
		}
	}

// Assign directory structure to array
$dirs=array();
dirtree($dirs,$_SESSION['tinybrowser']['filetype'][$typenow],$_SESSION['tinybrowser']['docroot'],$_SESSION['tinybrowser']['path'][$typenow]);

// generate alert if folders deleted
if($createqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGCREATE, $createqty);
	}
// generate alert if folders deleted
elseif($deleteqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGDELETE, $deleteqty);
	}
// generate alert if folders renamed
elseif($renameqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGRENAME, $renameqty);
	}
	
// generate alert if file errors encountered
if($errorqty>0)
   {
	$notify['type'][]='failure';
	$notify['message'][]=sprintf(TB_MSGEDITERR, $errorqty);
	}
	
// count folders
$num_of_folders = (isset($dirs) ? count($dirs) : 0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>TinyBrowser :: <?php echo TB_FOLDERS; ?></title>
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
<script language="javascript" type="text/javascript" src="js/tinybrowser.js.php"></script>
</head>
<body onload="rowHighlight();">
<?php
if(isset($_GET['errmsg']))
{
	$notify['type'][] = 'failure';
	$notify['message'][]  = sprintf(htmlspecialchars($_GET['errmsg'],ENT_QUOTES,$_SESSION['tinybrowser']['encoding']), $errorqty);   
}
if(count($notify['type'])>0) alert($notify);
?>
<div class="tabs">
<ul>
<li id="browse_tab"><span><a href="tinybrowser.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid ; ?>"><?php echo TB_BROWSE; ?></a></span></li>
<?php
if($_SESSION['tinybrowser']['allowupload'])
	{
	?><li id="upload_tab"><span><a href="upload.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid ; ?>"><?php echo TB_UPLOAD; ?></a></span></li>
	<?php 
	}
if($_SESSION['tinybrowser']['allowedit'])
	{
   ?><li id="edit_tab"><span><a href="edit.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid ; ?>"><?php echo TB_EDIT; ?></a></span></li>
   <?php
   }
?><li id="folders_tab" class="current"><span><a href="folders.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid; ?>"><?php echo TB_FOLDERS; ?></a></span></li>
</ul>
</div>
<div class="panel_wrapper">
<div id="general_panel" class="panel currentmod">
<fieldset>
<legend><?php echo TB_FOLDERS; ?></legend>
<?php
form_open('edit','custom','folders.php','?type='.$typenow.$tokenget.$passfolder.$passfeid);
?>
<div class="pushleft">
<?php

// Assign edit actions based on file type and permissions
$select = array();
if($_SESSION['tinybrowser']['allowfolders']) $select[] = array('create',TB_CREATE);
if($_SESSION['tinybrowser']['allowdelete']) $select[] = array('delete',TB_DELETE);
if($_SESSION['tinybrowser']['allowedit']) $select[] = array('rename',TB_RENAME);

form_select($select,'action',TB_ACTION,$actionnow,true);
if(!empty($_SESSION['post_tokens'])) form_hidden_input('tokenpost',end($_SESSION['post_tokens']));
?></form></div><?php

form_open('actionform','custom','folders.php','?type='.$typenow.$tokenget.$passfolder.$passfeid);

if($actionnow=='move')
   { ?><div class="pushleft"><?php
   form_select($editdirs,'destination',TB_FOLDERDEST,urlencode($foldernow),false);
   ?></div><?php
   } 

switch($actionnow) 
	{
	case 'delete':
		$actionhead = TB_DELETE;
		break;
	case 'rename':
		$actionhead = TB_RENAME;
		break;
	case 'create':
		$actionhead = TB_CREATE;
		break;
	default:
		// do nothing
	}
?><div class="tabularwrapper"><table class="browse"><tr>
<th class="nohvr"><?php echo TB_FOLDERNAME; ?></th>
<th class="nohvr"><?php echo TB_FILES; ?></th>
<th class="nohvr"><?php echo TB_DATE; ?></th>
<th class="nohvr"><?php echo $actionhead; ?></th></tr>
<?php

for($i=0;$i<$num_of_folders;$i++)
	{
	$disable = ($i == 0 ? true : false);
	$alt = (IsOdd($i) ? 'r1' : 'r0');
	echo '<tr class="'.$alt.'">';
	echo '<td>'.$dirs[$i][2].'</td>';
	echo '<td>'.$dirs[$i][4].'</td><td>'.date($_SESSION['tinybrowser']['dateformat'],$dirs[$i][5]).'</td>'
	.'<td>';
	form_hidden_input('actionfolder['.$i.']',$dirs[$i][0]);
	switch($actionnow) 
		{
		case 'create':
         echo '&rarr; ';
			form_text_input('createfolder['.$i.']',false,'',30,120);
			break;
		case 'delete':
         $disabledel = ($dirs[$i][4] > 0 ? ' DISABLED' : '');
			if(!$disable) echo '<input class="del" type="checkbox" name="deletefolder['.$i.']" value="1"'.$disabledel.' />';
			break;
		case 'rename':
			if(!$disable) form_text_input('renamefolder['.$i.']',false,$dirs[$i][3],30,120);
			break;
		default:
			// do nothing
		}
	echo "</td></tr>\n";
	}

echo "</table></div>\n".'<div class="pushright">';
if($_SESSION['tinybrowser']['allowdelete'] && $_SESSION['tinybrowser']['allowedit'])
	{
	form_hidden_input('action',$actionnow);
	if(!empty($_SESSION['post_tokens'])) form_hidden_input('tokenpost',end($_SESSION['post_tokens']));
	form_submit_button('commit',$actionhead.' '.TB_FOLDERS,'edit');
	}
?>
</div></fieldset></div></div>
</body>
</html>