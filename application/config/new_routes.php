<?php

$route = array(
	'home' => array('/', 'home/index'),
	
	// Search
	'search'     => array('search', 'search'),
	'autocomplete' => array('autocomplete/:any', 'autocomplete/$1', 'autocomplete'),
		
	// Profiles
	'profile' => array('profile/:username', 'users/show/username/$1', 'profile'),
	'edit_profile' => array('profile/edit', 'users/edit'),
	'update_profile' => array('profile/update', 'users/update'),
	
	
	
	// Articles
	'articles' => array('articles/:section/:category/page/:page', 'articles/index/section/$1/category/$2/page/$3'),
	'articles_in_section' => array('articles/:section/page/:page', 'articles/index/section/$1/page/$2'),
	'article' => array('articles/:section/:category/:id/:title/page/:page', 'articles/show/section/$1/category/$2/id/$3/title/$4/page/$5'),
	'articles_feed' => array('articles/feed/:section', 'articles/feed/section/$1'),
	
	
	// Comments
	'create_comment' => array('comments/create', 'comments/create'),
	'edit_comment' => array('comments/:comment_id/edit', 'comments/edit/comment_id/$1'),
	'update_comment' => array('comments/:comment_id/update', 'comments/update/comment_id/$1'),
	
	
	// Auth
	'auth' => array('auth', 'auth/index'),
	'auth_login' => array('auth/sign_in', 'auth/sign_in'),
	'auth_signup' => array('auth/sign_up', 'auth/sign_up'),
	'auth_logout' => array('logout', 'auth/logout'),
	'auth_forgotten' => array('forgotten', 'auth/forgot_password'),
	'register' => array('register', 'auth/sign_up'),
	'login' => array('login', 'auth/sign_in'),
	'activate' => array('auth/activation', 'auth/activation'),
	'activation' => array('auth/activate/:user_id/:code', 'auth/activate/$1/$2'),
	'auth_any' => array('auth/:any', 'auth/$1'),
	'dynamic' => array('dynamic/:resource/:id', 'dynamic/go/resource/$1/id/$2'),

	// Admin
	'admin' => array('admin', 'admin/home/index'),
	'admin_any' => array('admin/:any', 'admin/$1'),
	'admin_login' => array('admin/login', 'admin/auth/sign_in'),
	
	// Pages
	'page' => array(':page', 'pages/show/title/$1'),
	'sub_page' => array(':page/:sub_page', 'pages/show/title/$2'),
	
	// Forums
	'forums' => array('forums', 'forums/index'),
	'forum_threads' => array('forums/:name/page/:page', 'forums/show_threads/name/$1/page/$2'),
	'new_forum_thread' => array('forums/:name/new', 'forums/new_thread/name/$1'),
	'create_forum_thread' => array('forums/:name/create', 'forums/create_thread/name/$1'),
	'forum_thread' => array('forums/:name/:id/:title/page/:page', 'forums/show_thread/name/$1/title/$3/id/$2/page/$4'),
	'edit_forum_thread' => array('forums/:name/:id/:title/edit', 'forums/edit_thread/name/$1/title/$3/id/$2'),
	'update_forum_thread' => array('forums/:name/:id/:title/update', 'forums/update_thread/name/$1/title/$3/id/$2'),
	'new_forum_post' => array('forums/:name/:id/:title/new', 'forums/new_post/name/$1/title/$3/id/$2'),
	'create_forum_post' => array('forums/:name/:id/:title/create', 'forums/create_post/name/$1/title/$3/id/$2'),
	'edit_forum_post' => array('forums/:name/:id/:title/:post_id/edit', 'forums/edit_post/name/$1/title/$2/id/$3/post_id/$4'),
	'update_forum_post' => array('forums/:name/:id/:title/:post_id/update', 'forums/update_post/name/$1/title/$2/id/$3/post_id/$4'),
		
);


