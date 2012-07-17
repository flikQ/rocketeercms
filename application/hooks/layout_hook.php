<?php

class Layout_Hook {	

	private $called = 0; // don't know, but layout method was called twice. Need to prevent it
	
	public function layout() {
		if($this->called == 1) {
			return FALSE;
		}
		$this->called++;
		if(get_instance()->router->fetch_class() == 'migrate') return false;
		if(! $this->is_ajax()) {
			global $OUT;
			$CI =& get_instance();
			$output = $CI->output->get_output();
			$layout_name = 'default';
			if(isset($CI->layout)) 
			{
				$layout_name = $CI->layout->name;
				$CI->load->vars($CI->layout->get());
			}
			
			$layout_override = (isset($CI->layout->theme) AND isset($CI->layout->layout)) ? 
								TRUE : FALSE;
			
			if($layout_override)
			{
				$theme  = $CI->layout->theme;
				$layout = $CI->layout->layout;
				
				$layout = $CI->load->file(FCPATH.'themes/'.$theme.'/'. $layout.'.php', true);
			}
			else
			{
				// die($layout_name);
				$layout = $CI->load->file(FCPATH.'themes/'.$layout_name.'/'. $layout_name.'.php', true);
			}
			
			unset($CI);
			$view = str_replace("{yield}", $output, $layout);
			$OUT->_display($view);
		}
	}
	
	private function is_ajax () {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ? TRUE : FALSE;
	}
}
