<?php
require_once('config_tinybrowser.php');
require_once('fns_tinybrowser.php');

// Set language
set_language();

// Set default encoding type
if (!headers_sent())
    header("Content-Type: text/html; charset={$_SESSION['tinybrowser']['encoding']}");

// Generate request tokens
secure_tokens(false,true);

// Check session exists
check_session_exists();

// Check upload dirs for existence and wriability 
check_upload_dirs();

// Assign file operation variables
$typenow = ((isset($_GET['type']) && in_array($_GET['type'],$_SESSION['tinybrowser']['valid']['type'])) ? $_GET['type'] : 'image');
$standalone = (!empty($_GET['feid']) ? true : false);
$foldernow = str_replace(array('../','..\\','..','./','.\\'),'',($_SESSION['tinybrowser']['allowfolders'] && isset($_REQUEST['folder']) ? urldecode($_REQUEST['folder']) : ''));

// security check
verify_dir($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow].$foldernow,$typenow);

// Disabled execution permission in user upload path
if(file_exists(dirname($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow].'.htaccess')) && !file_exists($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow].'.htaccess'))
	{
    	$htaccess = "<IfModule mod_php4.c>\nphp_flag engine 0\n</IfModule>\n\n<IfModule mod_php5.c>\nphp_flag engine 0\n</IfModule>";
    	$fp = fopen($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$typenow].'.htaccess', 'w');
    	fwrite($fp, $htaccess);
    	fclose($fp);
	}

// TinyBrowser standalone mode?
if($standalone)
	{
	$passfeid = (!empty($_GET['feid']) && preg_match("/^[a-zA-Z0-9_\-]+$/", $_GET['feid']) == true ? '&feid='.$_GET['feid'] : '');
	$rowhlightinit =  ' onload="rowHighlight();"';
	}
else
	{
	$passfeid = '';
	$rowhlightinit =  '';	
	}

// Assign browsing options
$sortbynow = ((isset($_REQUEST['sortby']) && in_array($_REQUEST['sortby'],$_SESSION['tinybrowser']['valid']['sort'])) ? $_REQUEST['sortby'] : $_SESSION['tinybrowser']['order']['by']);
$sorttypenow = ((isset($_REQUEST['sorttype']) && in_array($_REQUEST['sorttype'],array('asc','desc'))) ? $_REQUEST['sorttype'] : $_SESSION['tinybrowser']['order']['type']);
$sorttypeflip = ($sorttypenow == 'asc' ? 'desc' : 'asc');  
$viewtypenow = ((isset($_REQUEST['viewtype']) && in_array($_REQUEST['viewtype'],array('thumb','detail'))) ? $_REQUEST['viewtype'] : $_SESSION['tinybrowser']['view']['image']);
$findnow = (!empty($_REQUEST['find']) ? strip_tags($_REQUEST['find']) : false);
$showpagenow = ((!empty($_REQUEST['showpage']) && is_numeric($_REQUEST['showpage']) && $_REQUEST['showpage']>0) ? (int) $_REQUEST['showpage'] : 0);;

// Assign url pass variables
$passfolder = '&folder='.urlencode($foldernow);
$passfeid = (!empty($_GET['feid']) && preg_match("/^[a-zA-Z0-9_\-]+$/", $_GET['feid']) == true ? '&feid='.$_GET['feid'] : '');
$passviewtype = '&viewtype='.$viewtypenow;
$passsortby = '&sortby='.$sortbynow.'&sorttype='.$sorttypenow;

// Assign view, thumbnail and link paths
$browsepath = $_SESSION['tinybrowser']['path'][$typenow].$foldernow;
$linkpath = $_SESSION['tinybrowser']['link'][$typenow].$foldernow;
$thumbpath = $_SESSION['tinybrowser'][$_SESSION['tinybrowser']['thumbsrc']][$typenow].$foldernow;
$tokenget = !empty($_SESSION['get_tokens'])  ? '&tokenget='.end($_SESSION['get_tokens']) : '';

// Assign sort parameters for column header links
$sortbyget = array();
$sortbyget['name'] = '&viewtype='.$viewtypenow.'&sortby=name';
$sortbyget['size'] = '&viewtype='.$viewtypenow.'&sortby=size'; 
$sortbyget['type'] = '&viewtype='.$viewtypenow.'&sortby=type'; 
$sortbyget['modified'] = '&viewtype='.$viewtypenow.'&sortby=modified';
$sortbyget['dimensions'] = '&viewtype='.$viewtypenow.'&sortby=dimensions'; 
$sortbyget[$sortbynow] .= '&sorttype='.$sorttypeflip;

// Assign css style for current sort type column
$thclass = array();
$thclass['name'] = '';
$thclass['size'] = ''; 
$thclass['type'] = ''; 
$thclass['modified'] = '';
$thclass['dimensions'] = ''; 
$thclass[$sortbynow] = ' class="'.$sorttypenow.'"';

// Initalise alert array
$notify = array(
	'type' => array(),
	'message' => array()
);
$newthumbqty = 0;

// read folder contents if folder exists
if(file_exists($_SESSION['tinybrowser']['docroot'].$browsepath))
	{
	// Read directory contents and populate $file array
	$dh = opendir($_SESSION['tinybrowser']['docroot'].$browsepath);
	$file = array();
	while (($filename = readdir($dh)) !== false)
		{
		// get file extension
		$nameparts = explode('.',$filename);
		$ext = end($nameparts);

		// filter directories and prohibited file types
		if($filename != '.' && $filename != '..' && !is_dir($_SESSION['tinybrowser']['docroot'].$browsepath.$filename) && !in_array($ext, $_SESSION['tinybrowser']['prohibited']) && ($typenow == 'file' || strpos(strtolower($_SESSION['tinybrowser']['filetype'][$typenow]),strtolower($ext))))
			{
			// search file name if search term entered
			if($findnow) $exists = strpos(strtolower($filename),strtolower($findnow));
	
			// assign file details to array, for all files or those that match search
			if(!$findnow || ($findnow && $exists !== false))
				{
				$file['name'][] = $filename;
				$file['sortname'][] = strtolower($filename);
				$file['modified'][] = filemtime($_SESSION['tinybrowser']['docroot'].$browsepath.$filename);
				$file['size'][] = filesize($_SESSION['tinybrowser']['docroot'].$browsepath.$filename);
	
				// image specific info or general
				if($typenow=='image' && $imginfo = getimagesize($_SESSION['tinybrowser']['docroot'].$browsepath.$filename))
					{
					$file['width'][] = $imginfo[0];
					$file['height'][] = $imginfo[1];
					$file['dimensions'][] = $imginfo[0] + $imginfo[1];
					$file['type'][] = $imginfo['mime'];
					
					// Check a thumbnail exists
					if(!file_exists($_SESSION['tinybrowser']['docroot'].$browsepath.'_thumbs/')) createfolder($_SESSION['tinybrowser']['docroot'].$browsepath.'_thumbs/',$_SESSION['tinybrowser']['unixpermissions']);
			  		$thumbimg = $_SESSION['tinybrowser']['docroot'].$browsepath.'_thumbs/_'.$filename;
					if (!file_exists($thumbimg))
						{
						$nothumbimg = $_SESSION['tinybrowser']['docroot'].$browsepath.$filename;
						$mime = getimagesize($nothumbimg);
						$im = convert_image($nothumbimg,$mime['mime']);
						resizeimage($im,$_SESSION['tinybrowser']['thumbsize'],$_SESSION['tinybrowser']['thumbsize'],$thumbimg,$_SESSION['tinybrowser']['thumbquality'],$mime['mime']);
						imagedestroy($im);
						$newthumbqty++;
						}
					}
				else 
					{
					$file['width'][] = 'N/A';
					$file['height'][] = 'N/A';
					$file['dimensions'][] = 'N/A';
					$file['type'][] = returnMIMEType($filename);
					}
				}			
			}
		}
	closedir($dh);
	}
// create file upload folder if session security enabled and session check variable set
elseif($_SESSION['tinybrowser']['sessionsecured']==true && isset($_SESSION[$_SESSION['tinybrowser']['sessioncheck']]))
	{
	// Check request tokens
	// secure_tokens(true,false);
	
	$success = createfolder($_SESSION['tinybrowser']['docroot'].$browsepath,$_SESSION['tinybrowser']['unixpermissions']);
	if($success)
		{
		if($typenow=='image') createfolder($_SESSION['tinybrowser']['docroot'].$browsepath.'_thumbs/',$_SESSION['tinybrowser']['unixpermissions']);
		$notify['type'][]='success';
		$notify['message'][]=sprintf(TB_MSGMKDIR, $browsepath);
		}
	else
		{
		$notify['type'][]='error';
		$notify['message'][]=sprintf(TB_MSGMKDIRFAIL, $browsepath);
		}
	}
	
// Assign directory structure to array
$browsedirs=array();
dirtree($browsedirs,$_SESSION['tinybrowser']['filetype'][$typenow],$_SESSION['tinybrowser']['docroot'],$_SESSION['tinybrowser']['path'][$typenow]);
	
// generate alert if new thumbnails created
if($newthumbqty>0)
   {
	$notify['type'][]='info';
	$notify['message'][]=sprintf(TB_MSGNEWTHUMBS, $newthumbqty);
	}
	

// determine sort order
$sortorder = ($sorttypenow == 'asc' ? SORT_ASC : SORT_DESC);
$num_of_files = (isset($file['name']) ? count($file['name']) : 0);

if($num_of_files>0)
	{
	// sort files by selected order
	sortfileorder($sortbynow,$sortorder,$file);
	}

// determine pagination
if($_SESSION['tinybrowser']['pagination']>0)
	{
	$showpage_start = ($showpagenow ? ($showpagenow*$_SESSION['tinybrowser']['pagination'])-$_SESSION['tinybrowser']['pagination'] : 0);
	$showpage_end = $showpage_start+$_SESSION['tinybrowser']['pagination'];
	if($showpage_end>$num_of_files) $showpage_end = $num_of_files;
	}
else
	{
	$showpage_start = 0;
	$showpage_end = $num_of_files;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>TinyBrowser :: <?php echo TB_BROWSE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Pragma" content="no-cache" />
<?php
if(!$standalone && $_SESSION['tinybrowser']['integration']=='tinymce')
	{
	?><script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $_SESSION['tinybrowser']['tinymcecss']; ?>" /><?php
	}
else
	{
	?><link rel="stylesheet" type="text/css" media="all" href="css/stylefull_tinybrowser.css" /><?php 
	}
?>
<link rel="stylesheet" type="text/css" media="all" href="css/style_tinybrowser.css.php" />
<script language="javascript" type="text/javascript" src="js/tinybrowser.js.php?<?php echo substr($passfeid,1); ?>"></script>
</head>
<body<?php echo $rowhlightinit; ?>>
<?php
if(isset($_GET['errmsg']))
{
	$notify['type'][] = 'failure';
	$notify['message'][]  = sprintf(htmlspecialchars($_GET['errmsg'],ENT_QUOTES,$_SESSION['tinybrowser']['encoding']), $errorqty);   
}
if(count($notify['type'])>0) alert($notify);
form_open('foldertab',false,'tinybrowser.php','?type='.$typenow.$tokenget.$passviewtype.$passsortby.$passfeid);
?>
<div class="tabs">
<ul>
<li id="browse_tab" class="current"><span><a href="tinybrowser.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid; ?>"><?php echo TB_BROWSE; ?></a></span></li><?php
if($_SESSION['tinybrowser']['allowupload'])
	{
	?><li id="upload_tab"><span><a href="upload.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid; ?>"><?php echo TB_UPLOAD; ?></a></span></li><?php
	}
if($_SESSION['tinybrowser']['allowedit'] || $_SESSION['tinybrowser']['allowdelete'])
	{
	?><li id="edit_tab"><span><a href="edit.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid; ?>"><?php echo TB_EDIT; ?></a></span></li><?php
	}
if($_SESSION['tinybrowser']['allowfolders'])
	{
	?><li id="folders_tab"><span><a href="folders.php?type=<?php echo $typenow.$tokenget.$passfolder.$passfeid; ?>"><?php echo TB_FOLDERS; ?></a></span></li><?php
	// Display folder select, if multiple exist
	if(count($browsedirs)>1)
		{
		?><li id="folder_tab" class="right"><span><?php
		form_select($browsedirs,'folder',TB_FOLDERCURR,urlencode($foldernow),true);
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
<legend><?php echo TB_BROWSEFILES; ?></legend>
<?php
form_open('browse','custom','tinybrowser.php','?type='.$typenow.$passfolder.$passfeid);
?>
<div class="pushleft">
<?php

// Offer view type if file type is image
if($typenow=='image')
	{
	$select = array(
		array('thumb',TB_THUMBS),
		array('detail',TB_DETAILS)
	);
	form_select($select,'viewtype',TB_VIEW,$viewtypenow,true);
	}
	
// Show page select if pagination is set
if($_SESSION['tinybrowser']['pagination']>0)
	{
	$pagelimit = ceil($num_of_files/$_SESSION['tinybrowser']['pagination'])+1;
	$page = array();
	for($i=1;$i<$pagelimit;$i++)
		{
		$page[] = array($i,TB_PAGE.' '.$i);
		}
	if($i>2) form_select($page,'showpage',TB_SHOW,$showpagenow,true);
	}
?></div><div class="pushright"><?php

form_hidden_input('sortby',$sortbynow);
form_hidden_input('sorttype',$sorttypenow);
if(!empty($_SESSION['post_tokens'])) form_hidden_input('tokenpost',end($_SESSION['post_tokens']));
form_text_input('find',false,$findnow,25,50);
form_submit_button('search',TB_SEARCH,'');

?></div>
<?php

// if image show dimensions header
if($typenow=='image')
	{
	$imagehead = '<th><a href="?type='.$typenow.$tokenget.$passfolder.$passfeid.$sortbyget['dimensions'].'"'.$thclass['dimensions'].'>'.TB_DIMENSIONS.'</a></th>';
	}
else $imagehead = '';

echo '<div class="tabularwrapper"><table class="browse">'
		.'<tr><th><a href="?type='.$typenow.$tokenget.$passfolder.$passfeid.$sortbyget['name'].'"'.$thclass['name'].'>'.TB_FILENAME.'</a></th>'
		.'<th><a href="?type='.$typenow.$tokenget.$passfolder.$passfeid.$sortbyget['size'].'"'.$thclass['size'].'>'.TB_SIZE.'</a></th>'
		.$imagehead
		.'<th><a href="?type='.$typenow.$tokenget.$passfolder.$passfeid.$sortbyget['type'].'"'.$thclass['type'].'>'.TB_TYPE.'</th>'
		.'<th><a href="?type='.$typenow.$tokenget.$passfolder.$passfeid.$sortbyget['modified'].'"'.$thclass['modified'].'>'.TB_DATE.'</th></tr>';

// show image thumbnails, unless detail view is selected
if($typenow=='image' && $viewtypenow != 'detail')
	{
	echo '</table></div>';

	for($i=$showpage_start;$i<$showpage_end;$i++)
		{
		echo '<div class="img-browser"><a href="#" onclick="selectURL(\''.$linkpath.$file['name'][$i].'\');" title="'.TB_FILENAME.': '.$file['name'][$i]
				.'&#13;&#10;'.TB_DIMENSIONS.': '.$file['width'][$i].' x '.$file['height'][$i]
				.'&#13;&#10;'.TB_DATE.': '.date($_SESSION['tinybrowser']['dateformat'],$file['modified'][$i])
				.'&#13;&#10;'.TB_TYPE.': '.$file['type'][$i]
				.'&#13;&#10;'.TB_SIZE.': '.bytestostring($file['size'][$i],1)
				.'"><img src="'.$thumbpath.'_thumbs/_'.$file['name'][$i]
				.'"  /><div class="filename">'.$file['name'][$i].'</div></a></div>';
		}
	}
else
	{
	for($i=$showpage_start;$i<$showpage_end;$i++)
		{
		$alt = (IsOdd($i) ? 'r1' : 'r0');
		echo '<tr class="'.$alt.'">';
		if($typenow=='image') echo '<td><a class="imghover" href="#" onclick="selectURL(\''.$linkpath.$file['name'][$i].'\');" title="'.$file['name'][$i].'"><img src="'.$thumbpath.'_thumbs/_'.$file['name'][$i].'" alt="" />'.truncate_text($file['name'][$i],30).'</a></td>';
		else echo '<td><a href="#" onclick="selectURL(\''.$linkpath.$file['name'][$i].'\');" title="'.$file['name'][$i].'">'.truncate_text($file['name'][$i],30).'</a></td>';
		echo '<td>'.bytestostring($file['size'][$i],1).'</td>';
		if($typenow=='image') echo '<td>'.$file['width'][$i].' x '.$file['height'][$i].'</td>';	
		echo '<td>'.$file['type'][$i].'</td>'
			.'<td>'.date($_SESSION['tinybrowser']['dateformat'],$file['modified'][$i]).'</td></tr>'."\n";
		}
	echo '</table></div>';
	}
?>
</fieldset></div></div>
<form name="passform" accept-charset="<? echo $_SESSION['tinybrowser']['encoding'];?>"><input name = "fileurl" type="hidden" value= "" /></form>
</body>
</html>