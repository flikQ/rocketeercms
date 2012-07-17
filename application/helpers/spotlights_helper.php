<?php

if(! function_exists('spotlight')) {

	function spotlight($name) {
		static $model;
		if(! $model) {
			$model = new Spotlight;
		}
		$spotlight = $model->find_by_name($name);
		if($spotlight->exists()) {
			view('../spotlights/'.$spotlight->template_name, array('spotlight' => $spotlight));
		}
	}

}
