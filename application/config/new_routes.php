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
		
);


