<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tag_limiter'))
{
	function tag_limiter($string, $tag, $nb=1, $start=0) {
		
		$rString = '';
		
		if ($string != '')
		{
			$startPos = 0;
			$endPos = strlen($string);
			
			$tag = "</".$tag.">";
			$wString = $string;
			$nbTag = substr_count($string, $tag);
			$cPos = 0;
			$nb = $start + $nb;
		
			for($i=0; $i<$nbTag; $i++) {
		
				if($i== $start) 
				{
					$startPos = $cPos ;
				}
				if($i== $nb) 
				{
					$endPos = $cPos ;
				}
				$pos = strpos($wString, $tag) + strlen($tag);
				$wString = substr($wString, $pos, strlen($wString));
				$cPos += $pos;
			}
			if (!isset($endPos)) $endPos = strlen($string);
		
			$rString = substr($string, $startPos, $endPos-$startPos);
		}
		
		return $rString;
	}
}
