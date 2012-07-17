<?php

class Migrate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('migration');

		/** VERY IMPORTANT - only turn this on when you need it. */
//		show_error('Access to this controller is blocked, turn me on when you need me.');
	}

	// Install up to the most up-to-date version.
	public function install()
	{
		if ( ! $this->migration->current())
		{
			show_error($this->migration->error);
			exit;
		}

		echo "<br />Migration Successful<br />";
	}

	// This will migrate up to the configed migration version
	public function version($id = NULL)
	{
		// No $id supplied? Use the config version
		$id OR $id = $this->config->item('migration_version');

		if ( ! $this->migration->version($id))
		{
			show_error($this->migration->error);
			exit;
		}

		echo "<br />Migration Successful<br />";
	}
}
