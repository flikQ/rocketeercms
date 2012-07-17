<?php

if( ! function_exists('ads')) 
{
	/**
	* Fetch ads by slot name
	*
	* @access	public
	* @return	array
	*/
	function ads($name) 
	{
		static $slot;
		
		if( ! $slot)
		{
			$slot = new Ad_Slot;
		}
		
		// Get slot by name
		$slot = $slot->find_by_name($name);
		
		if( ! $slot) 
		{
			// Not existing slot
			return array();
		}
		
		// Return random advertisement
		$ads = $slot->ads();
		$_ads = array();
		
		foreach($ads as $ad) 
		{
			if($ad->check()) 
			{
				$_ads[] = $ad;
				$ad->view();
			}
		}
		
		return $_ads;
	}
}
