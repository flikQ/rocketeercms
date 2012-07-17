<?php

class Home extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function analytics()
	{
		if(!$this->input->is_ajax_request())
		{
			redirect('admin');
		}
		
		
		$username = setting('google_analytics.username');
		$password = setting('google_analytics.password');
		$site_id  = setting('google_analytics.site_id');
		
		$this->load->driver('cache');
		
		// Check if a cache of the analytics exists
		if($analytics = $this->cache->file->get('analytics'))
		{
			$data['analytics_visits'] = $analytics['analytics_visits'];
			$data['analytics_views']  = $analytics['analytics_views'];
			
			//Set response
			$http_code = 200;
			$output    = json_encode($data);
		}
		else
		{
			try
			{
				//Load library
				$this->load->library('analytics', array( 'username' => $username,
														 'password' => $password
														));
														
				//Set account ID
				$this->analytics->setProfileById('ga:'.$site_id);

				$end_date   = date('Y-m-d');
				$start_date = date('Y-m-d', strtotime('-1 month')); //Get analytics data over previous month

				$this->analytics->setDateRange($start_date, $end_date);

				$visits = $this->analytics->getVisitors();
				$views  = $this->analytics->getPageviews();

				if (count($visits))
				{
					foreach ($visits as $date => $visit)
					{
						$year  = substr($date, 0, 4);
						$month = substr($date, 4, 2);
						$day   = substr($date, 6, 2);

						$utc = mktime(date('h'), NULL, NULL, $month, $day, $year) * 1000;

						$flot_datas_visits[] = '[' . $utc . ',' . $visit . ']';
						$flot_datas_views[]  = '[' . $utc . ',' . $views[$date] . ']';
					}

					$flot_data_visits = '[' . implode(',', $flot_datas_visits) . ']';
					$flot_data_views  = '[' . implode(',', $flot_datas_views) . ']';
				}

				$data['error']			  = false;
				$data['analytics_visits'] = $flot_data_visits;
				$data['analytics_views']  = $flot_data_views;

				//Check for cached copy
				$this->cache->file->save('analytics', array('analytics_visits' => $flot_data_visits, 'analytics_views' => $flot_data_views), 60*60);

				//Set response
				$http_code = 200;
				$output    = json_encode($data);
			}
			catch(Exception $e)
			{
				//Set response
				if(strstr($e->getMessage(), '(403)') !== false)
				{
					$http_code = '401';
					$output    = 'Unauthorized';
				}
				else
				{
					$http_code = 500;
					$output    = 'Internal server error';
				}
			}
		}
		
		// Respond
		header('HTTP/1.1: '.$http_code);
		header('Status: '.$http_code);
		
		if($http_code == 200) {
			header('Content-type: application/json;');
		}
		
		header('Content-Length: ' . strlen($output));
		exit($output);
		
		die('WOOP');
		
		
		if($this->input->server('HTTP_X_REQUESTED_WITH') !== 'XMLHttpRequest')
		{
			redirect('admin');
		}
		
		//Analytics
		if($this->setting->get('analytics.enabled') && 
		   strlen($this->setting->get('analytics.username')) > 0 && 
		   strlen($this->setting->get('analytics.password')) > 0)
		{
			$this->load->driver('cache');
			
			if($analytics = $this->cache->file->get('analytics'))
			{
				$data['analytics_visits'] = $analytics['analytics_visits'];
				$data['analytics_views']  = $analytics['analytics_views'];
				
				//Set response
				$http_code = 200;
				$output    = json_encode($data);
			}
			else
			{
				try
				{
					//Set account ID
					$this->analytics->setProfileById('ga:'.$this->setting->get('analytics.account_id')); //Eg: 46829784

					$end_date   = date('Y-m-d');
					$start_date = date('Y-m-d', strtotime('-1 month')); //Get analytics data over previous month

					$this->analytics->setDateRange($start_date, $end_date);

					$visits = $this->analytics->getVisitors();
					$views  = $this->analytics->getPageviews();

					if (count($visits))
					{
						foreach ($visits as $date => $visit)
						{
							$year = substr($date, 0, 4);
							$month = substr($date, 4, 2);
							$day = substr($date, 6, 2);

							$utc = mktime(date('h') - 9, NULL, NULL, $month, $day, $year) * 1000;

							$flot_datas_visits[] = '[' . $utc . ',' . $visit . ']';
							$flot_datas_views[] = '[' . $utc . ',' . $views[$date] . ']';
						}

						$flot_data_visits = '[' . implode(',', $flot_datas_visits) . ']';
						$flot_data_views = '[' . implode(',', $flot_datas_views) . ']';
					}
					
					$data['error']			  = false;
					$data['analytics_visits'] = $flot_data_visits;
					$data['analytics_views']  = $flot_data_views;

					//Check for cached copy
					$this->cache->file->save('analytics', array('analytics_visits' => $flot_data_visits, 'analytics_views' => $flot_data_views), 60*60);
					
					//Set response
					$http_code = 200;
					$output    = json_encode($data);
				}
				catch(Exception $e)
				{
					//Set response
					if(strstr($e->getMessage(), '(403)') !== false)
					{
						$http_code = '401';
						$output    = 'Unauthorized';
					}
					else
					{
						$http_code = 500;
						$output    = 'Internal server error';
					}
				}
			}
		}
		else
		{
			//Set response
			$http_code = 401;
			$output    = 'Unauthorized';
		}

		//Respond
		header('HTTP/1.1: '.$http_code);
		header('Status: '.$http_code);
		
		if($http_code == 200) {
			header('Content-type: application/json;');
		}
		
		header('Content-Length: ' . strlen($output));
		exit($output);
	}
	
	public function index() {
		$user = new User;
		$total_users = $total_users = $this->db->count_all('users');
		$new_users = $user->order_by('id', 'desc')->limit(5)->get();
		$recent_users = $user->order_by('last_login', 'desc')->limit(5)->get();		
		
		$article = new Article;
		$latest_articles = $article->where('status', 'published')->limit(5)->get();
		$pending_articles = $article->where('is_approved', '0')->limit(5)->get();

		$this->load->helper('date');
		$analytics = '[]';
		$ga_user = setting('google_analytics.username');
		$ga_password = setting('google_analytics.password');
		if($ga_user && $ga_password) {
			require APPPATH.'libraries/GA.php';
			try {
				$ga = new GA($ga_user, $ga_password);
				$ga->useCache();
				$ga->setProfileById('ga:'.setting('google_analytics.site_id'));
				$ga->setMonth(date('n'), date('Y'));
				$analytics = array();
				foreach($ga->getPageViews() as $date=>$value) {
					$analytics[] = array('date' => date('Y-m-').$date, 'value' => (int) $value);
				}
				$analytics = json_encode($analytics);
			} catch(Exception $e) {
			}
		}
		$this->layout->js = array('jquery-1.5.1.min', 'jquery.jqplot.min', 'jqplot/jqplot.dateAxisRenderer.min', 'home.index');
		$this->layout->css = array('jquery.jqplot.min', 'analytics');
		$this->load->view('home/index', array(
			'total_users' => $total_users,
			'new_users'	=> $new_users,
			'recent_users' => $recent_users,
			'latest_articles' => $latest_articles,
			'analytics' => $analytics
		));
	}
}

