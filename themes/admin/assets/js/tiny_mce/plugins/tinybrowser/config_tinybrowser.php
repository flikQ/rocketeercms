<?php
/*
TinyBrowser 1.42 - A TinyMCE file browser (C) 2010  Bryn Jones
(author website - http://www.lunarvis.com)

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

    You should have received a copy of the software licence
    along with this program.  If not, please email enquiries@lunarvis.com.
*/

// set script time out higher, to help with thumbnail generation
set_time_limit(240);

// Session control and security check
if(isset($_GET['sessidpass'])) session_id($_GET['sessidpass']); // workaround for Flash session bug

session_start(); // do not change this line

$_SESSION['tinymce_hack'] = 'true';

$_SESSION['tinybrowser']['sessionsecured'] = true; // enables session-based security (default is true)
$_SESSION['tinybrowser']['sessioncheck']   = 'tinymce_hack'; // name of session variable to check

// Set developer debugging true / false  - if true, no sessioncheck is performed 
// and it lets us make more focus on functionality than security 
$_SESSION['tinybrowser']['debug_mode'] = false;

// Set default language (ISO 639-1 code)
$_SESSION['tinybrowser']['language'] = 'en';

// Set encoding type
$_SESSION['tinybrowser']['encoding'] = 'UTF-8';

// Set the integration type (TinyMCE is default)
$_SESSION['tinybrowser']['integration'] = 'tinymce'; // Possible values: 'tinymce', 'fckeditor'

// Default is rtrim($_SERVER['DOCUMENT_ROOT'],'/') (suitable when using absolute paths, but can be set to '' if using relative paths)
$_SESSION['tinybrowser']['docroot'] = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

// Folder permissions for Unix servers only
$_SESSION['tinybrowser']['unixpermissions'] = 0777;

// File upload paths (set to absolute by default)
$_SESSION['tinybrowser']['path']['root'] = '/uploads/tinymce/'; // upload root directory
$_SESSION['tinybrowser']['path']['image'] = '/uploads/tinymce/images/'; // Image files location - also creates a '_thumbs' subdirectory within this path to hold the image thumbnails
$_SESSION['tinybrowser']['path']['media'] = '/uploads/tinymce/media/'; // Media files location
$_SESSION['tinybrowser']['path']['file']  = '/uploads/tinymce/files/'; // Other files location

// File link paths - these are the paths that get passed back to TinyMCE or your application (set to equal the upload path by default)
$_SESSION['tinybrowser']['link']['image'] = $_SESSION['tinybrowser']['path']['image']; // Image links
$_SESSION['tinybrowser']['link']['media'] = $_SESSION['tinybrowser']['path']['media']; // Media links
$_SESSION['tinybrowser']['link']['file']  = $_SESSION['tinybrowser']['path']['file']; // Other file links

// File upload size limit (0 is unlimited) - NOTE: these settings do not override the values configured in PHP, so if you have difficulties uploading larger files, check your PHP configuration
// size format: b, kb, mb
$_SESSION['tinybrowser']['maxsize']['image'] =  '500kb';// Image file maximum size 
$_SESSION['tinybrowser']['maxsize']['media'] = '2mb' ; // Media file maximum size 
$_SESSION['tinybrowser']['maxsize']['file']  = '2mb' ; // Other file maximum size 

// Image automatic resize on upload (0 is no resize)
$_SESSION['tinybrowser']['imageresize']['width']  = 0;
$_SESSION['tinybrowser']['imageresize']['height'] = 0;

// Image thumbnail source (set to 'path' by default - shouldn't need changing)
$_SESSION['tinybrowser']['thumbsrc'] = 'path'; // Possible values: path, link

// Image thumbnail size in pixels
$_SESSION['tinybrowser']['thumbsize'] = 80;

// Image and thumbnail quality, higher is better (1 to 99)
$_SESSION['tinybrowser']['imagequality'] = 80; // only used when resizing or rotating
$_SESSION['tinybrowser']['thumbquality'] = 80;

// Date format, as per php date function
$_SESSION['tinybrowser']['dateformat'] = 'd/m/Y H:i';

// Permitted file extensions
$_SESSION['tinybrowser']['filetype']['image'] = '*.jpg, *.jpeg, *.gif, *.png'; // Image file types
$_SESSION['tinybrowser']['filetype']['media'] = '*.swf, *.dcr, *.mov, *.qt, *.mpg, *.mp3, *.mp4, *.mpeg, *.avi, *.wmv, *.wm, *.asf, *.asx, *.wmx, *.wvx, *.rm, *.ra, *.ram'; // Media file types
$_SESSION['tinybrowser']['filetype']['file']  = '*.txt, *.rtf, *.doc, *.docx, *.ppt, *.pptx, *.xls, *.xlsx, *.pdf, *.xps'; // Other file types

// Prohibited file extensions
$_SESSION['tinybrowser']['prohibited'] = array('php','php3','php4','php5','phtml','asp','aspx','ascx','asmx','hta','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi', 'sh', 'py','asa','asax','config','com','inc','js','htm','html');

// Default file sort
$_SESSION['tinybrowser']['order']['by']   = 'name'; // Possible values: name, size, type, modified
$_SESSION['tinybrowser']['order']['type'] = 'asc'; // Possible values: asc, desc

// Default image view method
$_SESSION['tinybrowser']['view']['image'] = 'thumb'; // Possible values: thumb, detail

// File Pagination - split results into pages (0 is none)
$_SESSION['tinybrowser']['pagination'] = 0;

// TinyMCE dialog.css file location, relative to tinybrowser.php (can be set to absolute link)
$_SESSION['tinybrowser']['tinymcecss'] = '../../themes/advanced/skins/default/dialog.css';

// TinyBrowser pop-up window size
$_SESSION['tinybrowser']['window']['width']  = 770;
$_SESSION['tinybrowser']['window']['height'] = 480;

// Assign Permissions for Upload, Edit, Delete & Folders
// if($_SESSION['tinybrowser']['debug_mode'])
// {
//     error_reporting(E_ALL);
    $_SESSION['tinybrowser']['allowupload']  = true;
    $_SESSION['tinybrowser']['allowedit']    = true;
    $_SESSION['tinybrowser']['allowdelete']  = true;
    $_SESSION['tinybrowser']['allowfolders'] = true;
// }
// else
// {
    // $_SESSION['tinybrowser']['allowupload']  = false;
    // $_SESSION['tinybrowser']['allowedit']    = false;
    // $_SESSION['tinybrowser']['allowdelete']  = false;
    // $_SESSION['tinybrowser']['allowfolders'] = false;
// }

// Clean filenames on upload
$_SESSION['tinybrowser']['cleanfilename'] = true;

// Set default action for edit page
$_SESSION['tinybrowser']['defaultaction'] = 'delete'; // Possible values: delete, rename, move

// Set delay for file process script, only required if server response is slow
$_SESSION['tinybrowser']['delayprocess'] = 0; // Value in seconds

// Valid request variables (shouldn't need changing)
$_SESSION['tinybrowser']['valid']['type'] = array('image','media','file');
$_SESSION['tinybrowser']['valid']['sort'] = array('name','size','type','modified','dimensions');
$_SESSION['tinybrowser']['valid']['action'] = array('delete','rename','move','create','resize','rotate');

// Error logging - use when troubleshooting issues
$_SESSION['tinybrowser']['tb_log_error'] = true; // set to true to enable error logging to file
// if true, create new log file and keep log file whose size exceeds max size
// if false, existing contents are remvoed and logging is started from the beginning of the file
$_SESSION['tinybrowser']['error_log_rotation']  = false; 
$_SESSION['tinybrowser']['error_log_file'] = 'error_'.substr(md5(php_uname()),0,10).'.log';; // set to different location / file name to hide from sensitive information diggers
$_SESSION['tinybrowser']['error_log_file_max'] = '1mb'; // maximum file size (in bytes), logging is restarted, overwriting existing content

// Folder Quota check 
// Users' uploaded folder size management 
$_SESSION['tinybrowser']['quota_check']  = false; // check user uploaded folder size
$_SESSION['tinybrowser']['max_quota']    = false; // should be adjusted to your needs
$_SESSION['tinybrowser']['max_quota_notified']  = true; // will alert the following email
$_SESSION['tinybrowser']['webmaster_email'] = isset($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : '';  // should be set to your email


?>