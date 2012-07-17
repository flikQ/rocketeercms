<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Produces a <select> drop down for selecting a country.
 * It uses ISO standard ISO 3166-1 country codes
 */
if(!function_exists('country_dropdown'))
{
	function country_dropdown($name = 'country', $top_countries = array(), $selection = NULL, $show_all = TRUE)
	{
		// Get CI instance
		$CI =& get_instance();

		// Load config to get array of countries and their ISO codes
		$CI->config->load('countries');

		$countries = $CI->config->item('countries_list');

		$selected = NULL;
		$html     = '<select name="'.$name.'">';

		if(in_array($selection, $top_countries))
		{
			$top_selection = $selection;
			$all_selection = '';
		}
		else
		{
			$top_selection = NULL;
			$all_selection = $selection;
		}

		if(!empty($top_countries))
		{
			foreach($top_countries as $country)
			{
				if(array_key_exists($country, $countries))
				{
					if($country === $top_selection)
					{
						$selected = 'selected="selected"';
					}
					
					$html    .= '<option value="'.$country.'" '.$selected.'>'.$countries[$country].'</option>';
					$selected = NULL;
				}
			}
			
			$html .= '<option>------------------</option>';
		}

		if($show_all)
		{
			foreach($countries as $key => $country)
			{
				if($key === $all_selection)
				{
					$selected = 'selected="selected"';
				}
				
				$html    .= '<option value="'.$key.'" '.$selected.'>'.$country.'</option>';
				$selected = NULL;
			}
		}

		$html .= '</select>';

		return $html;
	}
}