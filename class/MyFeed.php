<?php
class MyFeed
{
	private $myXML;
	private $titles;
	private $links;
	private $descriptions;

	public function parse($rssAtom)
	{
		$i = 0;
		$this->myXML = simplexml_load_file($rssAtom);
		if(!strcmp($this->myXML->feed['xmlns'],
			'http://www.w3.org/2005/Atom')) 
		{
			return false;
		}
		foreach($this->myXML->entry as $entry) {
			$this->titles[$i] = $entry->title;
			$this->links[$i] = $entry->link['href'];
			$this->descriptions[$i] = $entry->summary;
			$i++;
		}
	}

	public function getTitles() 
	{
		return $this->titles;
	}
	
	public function getLinks()
	{
		return $this->links;
	}

	public function getDesc()
	{
		return $this->descriptions;
	}

	public function setTitles($title, $i) 
	{
		$this->titles[$i] = $title;
	}
	
	public function setLinks($link, $i)
	{
		$this->links[$i] = $link;
	}

	public function setDesc($desc, $i)
	{
		$this->descriptions[$i] = $desc;
	}

	public function createRss()
	{
		require("dbHandler.php");
		$db = new DbHandler();
		$rssentr = $db->getData(10);
		if(!$rssentr) {
			return 0;
		}

		$newXML = new SimpleXMLElement("<feed></feed>");
		$newXML->addAttribute('xmlns', 'http://www.w3.org/2005/Atom');
		$header = $newsXML->addChild('title', 'webtop');
		$header->addChild('updated', date3339());
		$header->addChild('id','tag:webtop,2013:http://www.lorien.chickenkiller.com/pages/atoms.php');
		while ($row = mysql_fetch_assoc($rssentr)) {
			$entry = $header->addChild('entry');
			$entry->addChild('title', $row['title']);
			$entry->addChild('link', $row['link']);
			$entry->addChild('summary', $row['description']);
		}
		Header('Content-type: text/xml');
		echo $newXML->asXML();

	}

	private function date3339($timestamp=0) {

	if (!$timestamp) {
		$timestamp = time();
	}
	$date = date('Y-m-d\TH:i:s', $timestamp);

	$matches = array();
	if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
		$date .= $matches[1].$matches[2].':'.$matches[3];
	} else {
		$date .= 'Z';
	}
	return $date;
 
	}
}
?>
