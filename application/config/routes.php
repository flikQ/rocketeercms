<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['profile'] = 'users/show';
$route['profile/edit'] = 'users/edit';
$route['profile/update'] = 'users/update';

$route['profile/messages/show/:id'] = 'private_messages/show/id/$1';
$route['profile/messages'] = 'private_messages/index';
$route['profile/messages/new'] = 'private_messages/compose';
$route['profile/messages/new/:any'] = 'private_messages/compose/$1';
$route['profile/messages/create'] = 'private_messages/create';
$route['profile/messages/incoming'] = 'private_messages/incoming';
$route['profile/messages/outgoing'] = 'private_messages/outgoing';

$route['profile/friends'] = 'friends/index';
$route['profile/friends/:username'] = 'friends/index/username/$1';
$route['friends/:any'] = 'friends/$1';
$route['profile/notifications'] = 'friends/pending';

$route['profile/:username'] = 'users/show/username/$1';

$route['shop'] = 'shop/index';
$route['shop/page'] = 'shop/index/page/0';
$route['shop/page/:page'] = 'shop/index/page/$1';
$route['shop/:category/page/:page'] = 'shop/index/category/$1/page/$2';
$route['shop/:category/page'] = 'shop/index/category/$1/page/0';
$route['shop/:category/:name'] = 'shop/show/name/$2';
$route['shop/:category'] = 'shop/index/category/$1';

$route['galleries'] = 'galleries/index';
$route['galleries/page/:num'] = 'galleries/index/page/$1';
$route['galleries/page'] = 'galleries/index/page/0';
$route['galleries/:any/:num'] = 'photos/show/id/$2';
$route['galleries/:any'] = 'galleries/show/title/$1';

$route['videos'] = 'videos/index';
$route['videos/page/:page'] = 'videos/index/page/$1';
$route['videos/page'] = 'videos/index/page/0';
$route['videos/:category/page/:page'] = 'videos/index/category/$1/page/$2';
$route['videos/:category/page'] = 'videos/index/category/$1/page/0';
$route['videos/:category/:title'] = 'videos/show/title/$2';
$route['videos/:category'] = 'videos/index/category/$1';

$route['forums'] = 'forums/index';
$route['forums/:forum/:title/edit'] = 'forums/edit_thread/name/$1/title/$2';
$route['forums/:forum/:title/update'] = 'forums/update_thread/name/$1/title/$2';
$route['forums/:forum/:title/new'] = 'forums/new_post/name/$1/title/$2';
$route['forums/:forum/:title/create'] = 'forums/create_post/name/$1/title/$2';
$route['forums/:forum/new'] = 'forums/new_thread/name/$1';
$route['forums/:forum/create'] = 'forums/create_thread';
$route['forums/:forum/:title/page/:page'] = 'forums/show_thread/name/$1/title/$2/page/$3';
$route['forums/:forum/:title/page'] = 'forums/show_thread/name/$1/title/$2/page/0';
$route['forums/:forum/page/:page'] = 'forums/show_threads/name/$1/page/$2';
$route['forums/:forum/page'] = 'forums/show_threads/name/$1/page/0';
$route['forums/:forum/:title'] = 'forums/show_thread/name/$1/title/$2';
$route['forums/:forum'] = 'forums/show_threads/name/$1';

// @TODO

$route['articles/:section/:category/page/:page'] = 'articles/index/section/$1/category/$2/page/$3';
$route['articles/:section/:category/:title'] = 'articles/show/title/$3';
$route['articles/page/:page'] = 'articles/index/page/$1';
$route['articles/page'] = 'articles/index/page/0';
$route['articles/:section/:category'] = 'articles/index/section/$1/category/$2';
$route['articles/:section/page/:page'] = 'articles/index/section/$1/page/$2';
$route['articles/:section'] = 'articles/index/section/$1';
$route['articles'] = 'articles';


$route['guides/:section/:category/page/:page'] = 'guides/index/section/$1/category/$2/page/$3';
$route['guides/:section/:category/:title'] = 'guides/show/title/$3';
$route['guides/page/:page'] = 'guides/index/page/$1';
$route['guides/page'] = 'guides/index/page/0';
$route['guides/:section/:category'] = 'guides/index/section/$1/category/$2';
$route['guides/:section/page/:page'] = 'guides/index/section/$1/page/$2';
$route['guides/:section'] = 'guides/index/section/$1';
$route['guides'] = 'guides';

$route['comments/create'] = 'comments/create';

$route['files'] = 'files/index';
$route['files/download/:id'] = 'files/download/id/$1';
$route['files/page'] = 'files/index/page/0';
$route['files/page/:page'] = 'files/index/page/$1';
$route['files/:category/page'] = 'files/index/category/$1';
$route['files/:category/page/:page'] = 'files/index/category/$1/page/$2';
$route['files/:category/:id'] = 'files/show/id/$2';
$route['files/:category'] = 'files/index/category/$1';

$route['matches'] = 'matches/index';
$route['matches/page'] = 'matches/index/page/0';
$route['matches/page/:page'] = 'matches/index/page/$1';
$route['matches/:id'] = 'matches/show/id/$1';

$route['payments/:resource/:resource_id'] = 'orders/show/resource/$1/resource_id/$2';
$route['payments/ipn'] = 'orders/ipn';
$route['payments/success'] = 'orders/success';
$route['payments/cancel'] = 'orders/cancel';

$route['team'] = 'team/show';

$route['admin'] = 'admin/home/index';
$route['admin/:any'] = 'admin/$1';

$route['auth'] = 'auth';
$route['register'] = 'auth/sign_up';
$route['login'] = 'auth/sign_in';
$route['auth/:any'] = 'auth/$1';

// @TODO remove in production

$route['migrate/:any'] = 'migrate/$1';

$route[':page/:sub_page'] = 'pages/show/title/$2';
$route[':page'] = 'pages/show/title/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
