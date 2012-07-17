<?php

// Removed deprecated functions
// sql_regcase

/* Create Folder */
function createfolder($dir,$perm) {
    // prevent hidden folder creation
    $dir = ltrim($dir,'.');

    if(in_dir($dir,$_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['root']))
    {
        is_dir(dirname($dir)) || createfolder(dirname($dir), $perm);
        return is_dir($dir) || @mkdir($dir, $perm,true);
    }
}

/* Validate File Extensions */
function validateExtension($extension, $types) {
if(in_array($extension,$types)) return false; else return true;
}

/* Display Alert Notifications */
function alert(&$notify){
$alert_num = count($notify['type']);
for($i=0;$i<$alert_num;$i++)
	{
	   $notify['message'][$i] = str_ireplace($_SERVER['DOCUMENT_ROOT'],'',$notify['message'][$i]);
	?><div class="alert<?php echo filter_str($notify['type'][$i]); ?>"><?php echo filter_str($notify['message'][$i]); ?></div><br /><?php
	}
}

/* Sort File Array By Selected Order */
function sortfileorder(&$sortbynow,&$sortorder,&$file) {

switch($sortbynow)
	{
	case 'name':
		array_multisort($file['sortname'], $sortorder, $file['name'], $sortorder, $file['type'], $sortorder, $file['modified'], $sortorder, $file['size'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder);
		break;
	case 'size':
		array_multisort($file['size'], $sortorder, $file['sortname'], SORT_ASC, $file['name'], SORT_ASC, $file['type'], $sortorder, $file['modified'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder);
		break;
	case 'type':
		array_multisort($file['type'], $sortorder, $file['sortname'], SORT_ASC, $file['name'], SORT_ASC, $file['size'], $sortorder, $file['modified'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder);
		break;
	case 'modified':
		array_multisort($file['modified'], $sortorder, $file['name'], $sortorder, $file['name'], $sortorder, $file['type'], $sortorder, $file['size'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder);
		break;
	case 'dimensions':
		array_multisort($file['dimensions'], $sortorder, $file['width'], $sortorder, $file['sortname'], SORT_ASC, $file['name'], SORT_ASC, $file['modified'], $sortorder, $file['type'], $sortorder, $file['size'], $sortorder, $file['height'], $sortorder);
		break;
	default:
		// do nothing
	}
}

/* Resize Image To Given Size */
function resizeimage($im,$maxwidth,$maxheight,$urlandname,$comp,$imagetype){
// security check
if(!file_in_dir($urlandname,$_SESSION['tinybrowser']['path']['root']))
{
      deny(TB_NOT_IN_ALLOWED_DIR);
}
$width = imagesx($im);
$height = imagesy($im);
if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight))
	{
	if($maxwidth && $width > $maxwidth)
		{
		$widthratio = $maxwidth/$width;
		$resizewidth=true;
		}
	else $resizewidth=false;

	if($maxheight && $height > $maxheight)
		{
		$heightratio = $maxheight/$height;
		$resizeheight=true;
		}
	else $resizeheight=false;

 	if($resizewidth && $resizeheight)
		{
		if($widthratio < $heightratio) $ratio = $widthratio;
		else $ratio = $heightratio;
		}
	elseif($resizewidth)
		{
		$ratio = $widthratio;
		}
	elseif($resizeheight)
		{
		$ratio = $heightratio;
		}
	$newwidth = $width * $ratio;
	$newheight = $height * $ratio;
		if(function_exists('imagecopyresampled') && $imagetype !='image/gif')
		{
		$newim = imagecreatetruecolor($newwidth, $newheight);
		}
	else
		{
		$newim = imagecreate($newwidth, $newheight);
		}

	// additional processing for png / gif transparencies (credit to Dirk Bohl)
	if($imagetype == 'image/x-png' || $imagetype == 'image/png')
		{
		imagealphablending($newim, false);
		imagesavealpha($newim, true);
		}
	elseif($imagetype == 'image/gif')
		{
		$originaltransparentcolor = imagecolortransparent( $im );
		if($originaltransparentcolor >= 0 && $originaltransparentcolor < imagecolorstotal( $im ))
			{
			$transparentcolor = imagecolorsforindex( $im, $originaltransparentcolor );
			$newtransparentcolor = imagecolorallocate($newim,$transparentcolor['red'],$transparentcolor['green'],$transparentcolor['blue']);
			imagefill( $newim, 0, 0, $newtransparentcolor );
			imagecolortransparent( $newim, $newtransparentcolor );
			}
		}

   imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

   if($imagetype == 'image/pjpeg' || $imagetype == 'image/jpeg')
   	{
   	imagejpeg ($newim,$urlandname,$comp);
   	}
   elseif($imagetype == 'image/x-png' || $imagetype == 'image/png')
   	{
   	imagepng ($newim,$urlandname,substr($comp,0,1));
   	}
   elseif($imagetype == 'image/gif')
   	{
   	imagegif ($newim,$urlandname);
   	}
	imagedestroy ($newim);
	}
else
	{
   if($imagetype == 'image/pjpeg' || $imagetype == 'image/jpeg')
   	{
   	imagejpeg ($im,$urlandname,$comp);
   	}
   elseif($imagetype == 'image/x-png' || $imagetype == 'image/png')
   	{
   	imagepng ($im,$urlandname,substr($comp,0,1));
   	}
   elseif($imagetype == 'image/gif')
   	{
   	imagegif ($im,$urlandname);
   	}
	}
}

/* Check Image Type And Convert To Temp Type */
function convert_image($imagetemp,$imagetype){

if($imagetype == 'image/pjpeg' || $imagetype == 'image/jpeg')
	{
	$cim1 = imagecreatefromjpeg($imagetemp);
	}
elseif($imagetype == 'image/x-png' || $imagetype == 'image/png')
	{
	$cim1 = imagecreatefrompng($imagetemp);
	imagealphablending($cim1, false);
	imagesavealpha($cim1, true);
	}
elseif($imagetype == 'image/gif')
	{
	$cim1 = imagecreatefromgif($imagetemp);
	}
return $cim1;
}

/* Generate Form Open */
function form_open($name,$class,$url,$parameters){
?><form name="<?php echo filter_str($name); ?>" class="<?php echo filter_str($class); ?>" method="post" action="<?php echo filter_str($url.$parameters); ?>" accept-charset="utf-8">
<?php
}

/* Generate Form Select Element */
function form_select($options,$name,$label,$current,$auto){
if ($label) {?><label for="<?php echo filter_str($name); ?>"><?php echo filter_str($label); ?></label><?php }
?><select name="<?php echo filter_str($name); ?>" <?php if ($auto) {?>onchange="this.form.submit();"<?php }?>>
<?php
$loopnum = count($options);
for($i=0;$i<$loopnum;$i++)
	{
	$selected = ($options[$i][0] == $current ? ' selected' : '');
	echo '<option value="'.filter_str($options[$i][0]).'"'.$selected.'>'.$options[$i][1].'</option>';
	}
?></select><?php
}

/* Generate Form Hidden Element */
function form_hidden_input($name,$value) {
?><input type="hidden" name="<?php echo filter_str($name); ?>" value="<?php echo filter_str($value); ?>" />
<?php
}

/* Generate Form Text Element */
function form_text_input($name,$label,$value,$size,$maxlength) {
if ($label) {?><label for="<?php echo filter_str($name); ?>"><?php echo filter_str($label); ?></label><?php } ?>
<input type="text" name="<?php echo filter_str($name); ?>" size="<?php echo filter_str($size); ?>" maxlength="<?php echo filter_str($maxlength); ?>" value="<?php echo filter_str($value); ?>" /><?php
}

/* Generate Form Submit Button */
function form_submit_button($name,$label,$class) {
?><button <?php if ($class) {?>class="<?php echo filter_str($class); ?>"<?php } ?>type="submit" name="<?php echo filter_str($name); ?>"><?php echo filter_str($label); ?></button>
</form>
<?php
}

/* Returns True if Number is Odd */
function IsOdd($num)
{
return (1 - ($num & 1));
}

/* Truncate Text to Given Length If Required */
function truncate_text($textstring,$length){
	if (strlen($textstring) > $length)
		{
		$textstring = substr($textstring,0,$length).'...';
		}
	return $textstring;
}

/* Present a size (in bytes) as a human-readable value */
function bytestostring($size, $precision = 0) {
    $sizes = array('YB', 'ZB', 'EB', 'PB', 'TB', 'GB', 'MB', 'KB', 'B');
    $total = count($sizes);

    while($total-- && $size > 1024) $size /= 1024;
    return round($size, $precision).' '.$sizes[$total];
}

//function to clean a filename string so it is a valid filename
function clean_filename($filename){
    $filename = stripslashesx($filename);
    $filename = preg_replace('/^\W+|\W+$/', '', $filename); // remove all non-alphanumeric chars at begin & end of string
    $filename = preg_replace('/\s+/', '_', $filename); // compress internal whitespace and replace with _
    return strtolower(preg_replace('/\W-/', '', $filename)); // remove all non-alphanumeric chars except _ and -

}
function clean_dirname($dir)
{
   $path = $dir;
   $outpath = preg_replace("/\.[\.]+/", "", $path);
   $outpath = preg_replace("/(%|~|\.\.|\.|\\\\|`|\/|\!|\@|\#|\^|&|\*|\(|\)|\;|\:|\"|\'|\|)/", "", $outpath);
   $outpath = preg_replace("/^[\/]+/", "", $outpath);
   $outpath = preg_replace("/^[A-Za-z][:\|][\/]?/", "", $outpath);
   return $outpath;
}
/* Return File MIME Type */
function returnMIMEType($filename)
    {
        preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);

        if(count($fileSuffix)<2) return 'unknown/-';

        switch(strtolower($fileSuffix[1]))
        {
            case 'js' :
                return 'application/x-javascript';

            case 'json' :
                return 'application/json';

            case 'jpg' :
            case 'jpeg' :
            case 'jpe' :
                return 'image/jpg';

            case 'png' :
            case 'gif' :
            case 'bmp' :
            case 'tiff' :
                return 'image/'.strtolower($fileSuffix[1]);

            case 'css' :
                return 'text/css';

            case 'xml' :
                return 'application/xml';

            case 'doc' :
            case 'docx' :
                return 'application/msword';

            case 'xls' :
            case 'xlt' :
            case 'xlm' :
            case 'xld' :
            case 'xla' :
            case 'xlc' :
            case 'xlw' :
            case 'xll' :
                return 'application/vnd.ms-excel';

            case 'ppt' :
            case 'pps' :
                return 'application/vnd.ms-powerpoint';

            case 'rtf' :
                return 'application/rtf';

            case 'pdf' :
                return 'application/pdf';

            case 'html' :
            case 'htm' :
            case 'php' :
                return 'text/html';

            case 'txt' :
                return 'text/plain';

            case 'mpeg' :
            case 'mpg' :
            case 'mpe' :
                return 'video/mpeg';

            case 'mp3' :
                return 'audio/mpeg3';

            case 'wav' :
                return 'audio/wav';

            case 'aiff' :
            case 'aif' :
                return 'audio/aiff';

            case 'avi' :
                return 'video/msvideo';

            case 'wmv' :
                return 'video/x-ms-wmv';

            case 'mov' :
                return 'video/quicktime';

            case 'zip' :
                return 'application/zip';

            case 'tar' :
                return 'application/x-tar';

            case 'swf' :
                return 'application/x-shockwave-flash';

            default :
            if(function_exists('mime_content_type'))
            {
                $fileSuffix = mime_content_type($filename);
            }

            return 'unknown/' . trim($fileSuffix[0], '.');
        }
    }
function sql_regcasex($str) {
    $ret = '';
    for ($i=0; $i < strlen($str); $i++) {
        if($str[$i] != '*' && $str[$i] != '.' && $str[$i] != ' ')
            $ret .= '['.strtoupper($str[$i]).strtolower($str[$i]).']';
        else
            $ret .= $str[$i];
    }
    return $ret;
}
/* Return Array of Directory Structure */
function dirtree(&$alldirs,$types='*.*',$root='',$tree='',$branch='',$level=0) {

// filter file types according to type
$filetypes = explode(',',preg_replace('{[ \t]+}', '',$types));

if($level==0 && is_dir($root.$tree.$branch))
	{
	$filenum=0;
	foreach($filetypes as $filetype)
	   {
   	$filenum = $filenum + count(glob($root.$tree.$branch.sql_regcasex($filetype),GLOB_NOSORT));
   	}
   $treeparts = explode('/',rtrim($tree,'/'));
	$topname = end($treeparts);
	$alldirs[] = array($branch,rtrim($topname,'/').' ('.$filenum.')',rtrim($topname,'/'),rtrim($topname,'/'),$filenum,filemtime($root.$tree.$branch));
	}
$level++;

$dh = opendir($root.$tree.$branch);
while (($dirname = readdir($dh)) !== false)
	{
	if($dirname != '.' && $dirname != '..' && is_dir($root.$tree.$branch.$dirname) && $dirname != '_thumbs')
		{
		$filenum=0;
		foreach($filetypes as $filetype)
		   {
			$filenum = $filenum + count(glob($root.$tree.$branch.$dirname.'/'.sql_regcasex($filetype),GLOB_NOSORT));
			}
		$indent = '';
		for($i=0;$i<$level;$i++) { $indent .= ' &nbsp; '; }
      if(strlen($indent)>0) $indent .= '&rarr; ';
		$alldirs[] = array(urlencode($branch.$dirname.'/'),$indent.$dirname.' ('.$filenum.')',$indent.$dirname,$dirname,$filenum,filemtime($root.$tree.$branch.$dirname));
		dirtree($alldirs,$types,$root,$tree,$branch.$dirname.'/',$level);
		}
	}
closedir($dh);
$level--;
}

/* Return folder size in bytes (recursive) */
function get_folder_size($d ="." )
	{
	$h= @opendir($d); if($h==0)return 0;
	while ($f=readdir($h)){
	if ( $f!= "..") { $sf+=filesize($nd=$d."/".$f);
	if($f!="."&&is_dir($nd)){$sf+=get_folder_size($nd);}} }
	closedir($h);
	return $sf ;
	}


/* Manage secure tokens to prevent CSFR */
function secure_tokens($check=true,$generate=true)
{
    if($_SESSION['tinybrowser']['debug_mode']) return;
    no_cache();
	if(session_id() != '')
	   {
	   if($check==true)
	      {
		   if(!empty($_GET))
		      {
		      if(empty($_GET['tokenget']) || preg_match('/[a-f0-9]{32}/',$_GET['tokenget'])!=true)
		         {
		         echo 'NO GET TOKEN '.TB_DENIED;
					exit;
		         }
				else
				   {
				   $find_token = array_search($_GET['tokenget'],$_SESSION['get_tokens']);
				   if($find_token===false)
				      {
	         		echo 'INVALID GET TOKEN '.TB_DENIED;
						exit;
				      }
					else
					   {
					   unset($_SESSION['get_tokens'][$find_token]);
					   }
				   }
		      }
			if(!empty($_POST))
		      {
		      if(empty($_POST['tokenpost']) || preg_match('/[a-f0-9]{32}/',$_POST['tokenpost'])!=true)
		         {
	          	echo 'NO POST TOKEN '.TB_DENIED;
					exit;
		         }
				else
				   {
				   $find_token = array_search($_POST['tokenpost'],$_SESSION['post_tokens']);
				   if($find_token===false)
				      {
	       			echo 'INVALID POST TOKEN '.TB_DENIED;
						exit;
				      }
					else
					   {
					   unset($_SESSION['post_tokens'][$find_token]);
					   }
				   }
		      }

		   }
		if($generate==true)
			{
			$_SESSION['get_tokens'][] = md5(uniqid(mt_rand(), true));
			$_SESSION['post_tokens'][] = md5(uniqid(mt_rand(), true));
			}
	   }
	}

/* User defined error handling function. */
function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
{
    // timestamp for the error entry.
    $dt = date('Y-m-d H:i:s (T)');

    // define an assoc array of error string
    // in reality the only entries we should
    // consider are E_WARNING, E_NOTICE, E_USER_ERROR,
    // E_USER_WARNING and E_USER_NOTICE.
    $errortype = array (
                E_ERROR => 'Error',
                E_WARNING => 'Warning',
                E_PARSE => 'Parsing Error',
                E_NOTICE => 'Notice',
                E_CORE_ERROR => 'Core Error',
                E_CORE_WARNING => 'Core Warning',
                E_COMPILE_ERROR => 'Compile Error',
                E_COMPILE_WARNING => 'Compile Warning',
                E_USER_ERROR => 'User Error',
                E_USER_WARNING => 'User Warning',
                E_USER_NOTICE => 'User Notice',
                E_STRICT => 'Runtime Notice'
                );
    // set of errors for which a var trace will be saved.
    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

	 if($errno != E_STRICT) // exclude Runtime Notices
     {
	 	$err  = $dt. "\t";
    	$err .= $errno.' '.$errortype[$errno]. "\t";
    	$err .= $errmsg. "\t";
    	$err .= 'File: '.basename($filename). "\t";
    	$err .= 'Line: '.$linenum. "\t";

    	if (in_array($errno, $user_errors))
	    {
        	$err .= 'Trace: '.wddx_serialize_value($vars, 'Variables'). "\t";
    	}
    	$err .= "\n";

       // create error log if not exist
       if(!file_exists($_SESSION['tinybrowser']['error_log_file'])){@fopen($_SESSION['tinybrowser']['error_log_file'],'w');}
	   // rotate log files
	   if(filesize($_SESSION['tinybrowser']['error_log_file'])> get_byte($_SESSION['tinybrowser']['error_log_file_max']))
       {
          if($_SESSION['tinybrowser']['error_log_rotation'])
          {
    	      $oldlog = str_replace('.log','',$_SESSION['tinybrowser']['error_log_file']);
    	      $oldlog = $oldlog.'_'.date("YmdHi").'.log';
              rename($_SESSION['tinybrowser']['error_log_file'],$oldlog);
          }
          else
          {
              unlink($_SESSION['tinybrowser']['error_log_file']);
          }
	   }

        error_log($err, 3, $_SESSION['tinybrowser']['error_log_file']);
    }



	 if(!in_array($errno,array(E_NOTICE,E_STRICT)))
     {
	     die($err);
	 }
}

function set_language()
{
	// Set language
	if(isset($_SESSION['tinybrowser']['language']) && file_exists('langs/'.$_SESSION['tinybrowser']['language'].'.php'))
	{
		require_once('langs/'.$_SESSION['tinybrowser']['language'].'.php');
	}
	else
	{
		require_once('langs/en.php'); // Falls back to English
	}
}

function check_session_exists()
{
    if($_SESSION['tinybrowser']['debug_mode']) return;
	// Check session exists
	if(session_id() == '' || ($_SESSION['tinybrowser']['sessionsecured']==false && basename($_SERVER['SCRIPT_NAME']) != 'tinybrowser.php'))
	{
		echo TB_SESSDENIED;
		exit;
	}

	// Check session variable exists
	if($_SESSION['tinybrowser']['sessionsecured']==true && !isset($_SESSION[$_SESSION['tinybrowser']['sessioncheck']]))
	{
		echo 'SESSION VARIABLE NOT SET '.TB_DENIED;
		exit;
	}
}

function deny($msg)
{
    $msg = str_ireplace($_SERVER['DOCUMENT_ROOT'],'',$msg);
    header("Location: ?errmsg=".$msg);
    exit;
}
function no_cache()
{
    if(!headers_sent())
    {
        session_cache_limiter('nocache');
        header("Cache-Control: no-store,no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Mon, 26 Jul 1998 05:00:00 GMT"); // Date in the past
    }
}
/*
 Check the existence of upload dirs
  if not exist, they will be created
*/
function check_upload_dirs()
{
    // We first clear the stat cache
    @clearstatcache();


    if(!file_exists($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['image']))
    {
        //sprintf(TB_UPLOADIRNOTCREATED,$_SESSION['tinybrowser']['path']['image']);
        createfolder($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['image'],$_SESSION['tinybrowser']['unixpermissions']);
    }
    if(!file_exists($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['image'].'_thumbs'))
    {
        //sprintf(TB_UPLOADIRNOTCREATED,$_SESSION['tinybrowser']['path']['image'].'_thumbs');
        createfolder($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['image'].'_thumbs',$_SESSION['tinybrowser']['unixpermissions']);
    }

    if(!file_exists($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['media']))
    {
        //sprintf(TB_UPLOADIRNOTCREATED,$_SESSION['tinybrowser']['path']['media']);
        createfolder($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['media'],$_SESSION['tinybrowser']['unixpermissions']);
    }
    if(!file_exists($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['file']))
    {
        //sprintf(TB_UPLOADIRNOTCREATED,$_SESSION['tinybrowser']['path']['file']);
        createfolder($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['file'],$_SESSION['tinybrowser']['unixpermissions']);
    }

    // Maybe we need to do additional checks for some reasons
    if(!is_writeable($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['image']))
    {
        sprintf(TB_UPLOADIRNOTWRITABLE,$_SESSION['tinybrowser']['path']['image']);

    }
    if(!is_writeable($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['media']))
    {
        sprintf(TB_UPLOADIRNOTWRITABLE,$_SESSION['tinybrowser']['path']['media']);

    }
    if(!is_writeable($_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path']['file']))
    {
        sprintf(TB_UPLOADIRNOTWRITABLE,$_SESSION['tinybrowser']['path']['file']);

    }

}
// Filter output strings using htmlentities with specified encoding in config file
function filter_str($str)
{
    return htmlspecialchars($str,ENT_QUOTES,$_SESSION['tinybrowser']['encoding']);
}
/*
 C$heck if file is in allowed dir
 @return true|false
*/
function in_dir($input_dir, $allowed_dir)
{
        $r = clean_dirslashes($input_dir);
        $d = clean_dirslashes($allowed_dir);

        $root = explode ( DIRECTORY_SEPARATOR, realpath ( $d ) );

        if(file_exists(urldecode($r)))
        {
            $request = explode ( DIRECTORY_SEPARATOR, realpath ( $r ) );
        }
        else
        {
            if(is_file($r))
            {
                $request = explode ( DIRECTORY_SEPARATOR, dirname( $r ) );
            }
            else
            {
                $request = explode ( DIRECTORY_SEPARATOR, $r  );
            }

        }

        empty ( $request [0] ) ? array_shift ( $request ) : $request;
        empty ( $root [0] ) ? array_shift ( $root ) : $root;

        if (count ( array_diff_assoc ( $root, $request ) ) > 0) {
              return false;
        }
        return true;
}
function file_in_dir($input_file, $allowed_dir){
    $dir = clean_dirslashes(dirname(stripslashesx($input_file)));
    $dir_top = clean_dirslashes($allowed_dir);

    if($dir == $dir_top)
        return true;

    $dir = realpath($dir);
    $dir_top = realpath($dir_top);

    $dir = count(explode(DIRECTORY_SEPARATOR, $dir));
    $dir_top = count(explode(DIRECTORY_SEPARATOR, $dir_top));

    if($dir <= $dir_top)
        return false;

        return true;
}
function clean_dirslashes($s)
{
        if(!preg_match("/(\/|\\\)$/",$s))
                $s =  $s .DIRECTORY_SEPARATOR;
        $s = str_replace(array('/','\\'),DIRECTORY_SEPARATOR,$s);

        return $s;
}
function stripslashesx($s)
{
        return (get_magic_quotes_gpc())?stripslashes($s):$s;
}
function parse_size($s)
{
    preg_match("/(\d{1,}+)(\w+)/",$s,$p);
    if(count($p)==3)
    {
        return array($p[1],$p[2]);
    }
    else
    {
        preg_match("/(\d{1,}+)\s(\w+)/",$s,$p);
        if(count($p)==3)
        {
            return array($p[1],$p[2]);
        }
    }
}
function get_byte($raw)
{
    // $raw : '500kb', '1mb'
    require_once('lib/byte_converter.class.php');
    $file_raw_size = parse_size($raw);
    $size_in_byte = 0;
    try{
        $byte = new byte_converter;
        $byte->set_limit("tb"); //show types up to tera byte
        $file_size = $byte->auto($file_raw_size[0],$file_raw_size[1]);
        $size_in_byte = $file_size['b'];
    }catch (Exception $e) {echo $e;}
    return $size_in_byte;
}
function dirsize($directory) {
    $size = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
        $size+=$file->getSize();
    }
    return $size;
}
function verify_dir($dir,$type='root')
{
    if(is_array($dir))
    {
        foreach($dir as $d)
        {
            if(strlen($d)!=0 || $d != '')
            {
                if(!in_dir($d,$_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$type])) deny(TB_NOT_IN_ALLOWED_DIR.' : '.$_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$type]);
            }
        }
    }
    else
    {

        if(strlen($dir)==0 || $dir == '')
           return;
        if(!in_dir($dir,$_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$type])) deny(TB_NOT_IN_ALLOWED_DIR.' : '.$_SESSION['tinybrowser']['docroot'].$_SESSION['tinybrowser']['path'][$type]);

    }
}
// make sure requested file is in allowed dir
function verify_file($file,$type='root',$check_exists=false)
{
    if(is_array($file))
    {
        foreach($file as $f)
        {
            if(!file_in_dir($f,$_SESSION['tinybrowser']['path'][$type])) deny(TB_NOT_IN_ALLOWED_DIR);
            if($check_exists) { if(!file_exists($f)) deny(TB_NOT_EXISTS); }
        }
    }
    else
    {
        if(!file_in_dir($file,$_SESSION['tinybrowser']['path'][$type])) deny(TB_NOT_IN_ALLOWED_DIR);
        if($check_exists){if(!file_exists($file)) deny(TB_NOT_EXISTS); }
    }
}
function sanitize_dir($dir)
{
        $dir = stripslashes( $dir) ;

        //  . \ / | : ? * " < >
        $dir = preg_replace( '/\\.|\\\\|\\||\\:|\\?|\\*|"|<|>|[[:cntrl:]]/', '', $dir ) ;
        $dir = str_replace("//","",$dir);

        return $dir ;
}
function has_bad_utf8( $string )
{
        $regex =
        '([\x00-\x7F]'.
        '|[\xC2-\xDF][\x80-\xBF]'.
        '|\xE0[\xA0-\xBF][\x80-\xBF]'.
        '|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}'.
        '|\xED[\x80-\x9F][\x80-\xBF]'.
        '|\xF0[\x90-\xBF][\x80-\xBF]{2}'.
        '|[\xF1-\xF3][\x80-\xBF]{3}'.
        '|\xF4[\x80-\x8F][\x80-\xBF]{2}'.
        '|(.{1}))';

        while (preg_match('/'.$regex.'/S', $string, $matches)) {
                if ( isset($matches[2])) {
                        return true;
                }
                $string = substr($string, strlen($matches[0]));
        }

        return false;
}

function is_dir_empty($dir)
{
	if(is_dir($dir))
		return (count(glob("$dir/*")) === 0) ? true: false;
}
if($_SESSION['tinybrowser']['tb_log_error'])$old_error_handler = set_error_handler('userErrorHandler');
if($_SESSION['tinybrowser']['debug_mode'] )
{
	$_SESSION['get_tokens'][] = md5(uniqid(mt_rand(), true));
	$_SESSION['post_tokens'][] = md5(uniqid(mt_rand(), true));
}

?>