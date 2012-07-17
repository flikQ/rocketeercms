<?php

class Articles extends MY_Controller
{
	private function output($data, $segment = NULL)
	{
		$output[] = '<?xml version="1.0" encoding="UTF-8"?>';
		$output[] = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
		$output[] = '	<channel>';
		$output[] = '		<title>Made2Game Article Feed</title>';
		
		if(!$segment)
		{
			$output[] = '		<atom:link href="'.site_url('rss/articles').'" rel="self" type="application/rss+xml" />';
			$output[] = '		<description>Article feed for all sections</description>';
		}
		else
		{
			$segment_url = strtolower($segment);
			$segment_url = str_replace(' ', '-', $segment_url);
			
			$output[] = '		<atom:link href="'.site_url('rss/articles/'.$segment_url).'" rel="self" type="application/rss+xml" />';
			$output[] = '		<description>Article feed for - '.$segment.'</description>';
		}
		
		$output[] = '		<link>'.site_url('articles').'</link>';
		
		
		foreach($data as $item)
		{
			$output[] = '		<item>';
			
			foreach($item as $key => $val)
			{
				$output[] = '			<'.$key.'>'.$val.'</'.$key.'>';
			}
			
			$output[] = '		</item>';
		}
		
		$output[] = '	</channel>';
		$output[] = '</rss>';
		
		// Send the content to the browser
		header('Content-Type: application/rss+xml; charset=UTF-8');
		
		foreach($output as $line)
		{
			echo $line."\n";
		}
		
		exit;
	}
	
	private function clean_text($text)
	{
		// Entites
		$entities           = get_html_translation_table(HTML_ENTITIES);
	    $entities[chr(130)] = '&sbquo;';   // Single Low-9 Quotation Mark
	    $entities[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
	    $entities[chr(132)] = '&bdquo;';   // Double Low-9 Quotation Mark
	    $entities[chr(133)] = '&hellip;';  // Horizontal Ellipsis
	    $entities[chr(134)] = '&dagger;';  // Dagger
	    $entities[chr(135)] = '&Dagger;';  // Double Dagger
	    $entities[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
	    $entities[chr(137)] = '&permil;';  // Per Mille Sign
	    $entities[chr(138)] = '&Scaron;';  // Latin Capital Letter S With Caron
	    $entities[chr(139)] = '&lsaquo;';  // Single Left-Pointing Angle Quotation Mark
	    $entities[chr(140)] = '&OElig;';   // Latin Capital Ligature OE
	    $entities[chr(145)] = '&lsquo;';   // Left Single Quotation Mark
	    $entities[chr(146)] = '&rsquo;';   // Right Single Quotation Mark
	    $entities[chr(147)] = '&ldquo;';   // Left Double Quotation Mark
	    $entities[chr(148)] = '&rdquo;';   // Right Double Quotation Mark
	    $entities[chr(149)] = '&bull;';    // Bullet
	    $entities[chr(150)] = '&ndash;';   // En Dash
	    $entities[chr(151)] = '&mdash;';   // Em Dash
	    $entities[chr(152)] = '&tilde;';   // Small Tilde
	    $entities[chr(153)] = '&trade;';   // Trade Mark Sign
	    $entities[chr(154)] = '&scaron;';  // Latin Small Letter S With Caron
	    $entities[chr(155)] = '&rsaquo;';  // Single Right-Pointing Angle Quotation Mark
	    $entities[chr(156)] = '&oelig;';   // Latin Small Ligature OE
	    $entities[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
		
		foreach($entities as $char => $val)
		{
			$text = str_replace($val, ' ', $text);
		}
		
		return $text;
	}
	
	public function index()
	{
		// RSS data
		// Holds data for output on RSS
		$data = array();
		
		// Get all articles
		$this->db->select('a.id, a.title, a.url_title, a.short_content, a.created_at, a.updated_at');
		$this->db->select('s.name AS section_name, s.url_name AS section_url');
		$this->db->from('articles a');
		$this->db->join('article_sections s', 'a.section_id = s.id', 'left');
		$this->db->where('a.status', 'published');
		$this->db->order_by('a.created_at', 'desc');
		$this->db->limit(50);
		
		$query = $this->db->get();
		
		if($query->num_rows() === 0)
		{
			show_404();
		}
		
		foreach($query->result() as $row)
		{
			// Get category
			$this->db->select('ac.name as category_name, ac.url_name as category_url');
			$this->db->from('article_categories ac');
			$this->db->join('article_categories_map acm', 'acm.category_id = ac.id', 'left');
			$this->db->where('acm.article_id', $row->id);
			$this->db->limit(1);
			
			$query = $this->db->get();
			
			$row->category_name = 'unknown';
			$row->category_url  = 'unknown';
			
			if($query->num_rows() > 0)
			{
				$row->category_name = $query->row()->category_name;
				$row->category_url  = $query->row()->category_url;
			}
			
			// Replace all crappy entities
			$short_content = $this->clean_text($row->short_content);
			
			// Build data array to output
			$add = array(
				'title'       => $row->title,
				'category'    => $row->section_name,
				'pubDate'     => date("r", $row->created_at),
				'link'        => site_url('articles/'.$row->section_url.'/'.$row->category_url.'/'.$row->id.'/'.$row->url_title),
				'guid'        => site_url('articles/'.$row->section_url.'/'.$row->category_url.'/'.$row->id.'/'.$row->url_title)
			);
			
			if(strlen(trim($short_content)) > 0)
			{
				$add['description'] = html_entity_decode(strip_tags($short_content));
			}
			
			$data[] = $add;
		}
		
		// Output
		$this->output($data);
	}
	
	public function segment()
	{
		// What article section are they requesting
		$segment = $this->uri->segment(3);
		
		// RSS data
		// Holds data for output on RSS
		$data = array();
		
		// Get all articles
		$this->db->select('a.id, a.title, a.url_title, a.short_content, a.created_at, a.updated_at');
		$this->db->select('s.name AS section_name, s.url_name AS section_url');
		$this->db->from('articles a');
		$this->db->join('article_sections s', 'a.section_id = s.id', 'left');
		$this->db->where('a.status', 'published');
		$this->db->where('s.url_name', $segment);
		$this->db->order_by('a.created_at', 'desc');
		$this->db->limit(50);
		
		$query = $this->db->get();
		
		if($query->num_rows() === 0)
		{
			show_404();
		}
		
		foreach($query->result() as $row)
		{
			// Get category
			$this->db->select('ac.name as category_name, ac.url_name as category_url');
			$this->db->from('article_categories ac');
			$this->db->join('article_categories_map acm', 'acm.category_id = ac.id', 'left');
			$this->db->where('acm.article_id', $row->id);
			$this->db->limit(1);
			
			$query = $this->db->get();
			
			$row->category_name = 'unknown';
			$row->category_url  = 'unknown';
			
			if($query->num_rows() > 0)
			{
				$row->category_name = $query->row()->category_name;
				$row->category_url  = $query->row()->category_url;
			}
			
			// Replace all crappy entities
			$short_content = $this->clean_text($row->short_content);
			
			// Build data to output
			$add = array(
				'title'       => $row->title,
				'pubDate'     => date("r", $row->created_at),
				'link'        => site_url('articles/'.$row->section_url.'/'.$row->category_url.'/'.$row->id.'/'.$row->url_title),
				'guid'        => site_url('articles/'.$row->section_url.'/'.$row->category_url.'/'.$row->id.'/'.$row->url_title)
			);
			
			if(strlen(trim($short_content)) > 0)
			{
				$add['description'] = html_entity_decode(strip_tags($short_content));
			}
			
			$data[] = $add;
		}
		
		// Output
		$segment = str_replace('-', ' ', $segment);
		
		$this->output($data, ucwords($segment));
	}
}