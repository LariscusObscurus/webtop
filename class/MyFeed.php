<?php
class MyFeed
{
	private $myXML;
	private $titles;
	private $links;
	private $descriptions;
	private $times;

	public function parse($rssAtom, $mode=0)
	{
		$i = 0;
		switch($mode) {
		case 0:
			$this->myXML = simplexml_load_file($rssAtom);
			break;
		case 1:
			$this->myXML = simplexml_load_string($rssAtom);
			break;
		}
		//error_log($this->myXML->feed['xmlns'], 0);
		if(!strcmp($this->myXML->feed['xmlns'],
			'http://www.w3.org/2005/Atom')) 
		{
			return false;
		}
		foreach($this->myXML->entry as $entry) {
			$this->titles[$i] = $entry->title;
			$this->links[$i] = $entry->link['href'];
			$this->descriptions[$i] = $entry->summary;
			$this->times[$i] = date('Y-m-d H:i:s', strtotime( $entry->updated));
			$i++;
		}
		return true;
	}

	public function getTitles() 
	{
		return $this->titles;
	}
	
	public function getLinks()
	{
		return $this->links;
	}
	
	public function getTimes()
	{
		return $this->times;
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
	public function setTimes($desc, $i)
	{
		$this->times[$i] = $times;
	}

	public function createRss($mode=0)
	{
		require("dbHandler.php");
		$db = new DbHandler();
		$rssentr = $db->getData(10);
		if(!$rssentr) {
			return 0;
		}

		$header = new SimpleXMLElement("<feed></feed>");
		$header->addAttribute('xmlns', 'http://www.w3.org/2005/Atom');
		$header->addChild('title', 'webtop');
		$header->addChild('updated', $this->date3339());
		$header->addChild('id','tag:webtop,2013:http://www.lorien.chickenkiller.com/pages/atom.php');
		while ($row = mysql_fetch_assoc($rssentr)) {
			$entry = $header->addChild('entry');
			$entry->addChild('title', htmlspecialchars($row['title'], ENT_XML1));
			$link = $entry->addChild('link');
			$link->addAttribute('href', htmlspecialchars($row['link'], ENT_XML1));
			$entry->addChild('summary', $row['description']);
			$entry->addChild('updated',
			$this->date3339(strtotime($row['date'])));
			$entry->addChild('id', htmlspecialchars($row['link'], ENT_XML1));
		}
		if(!$mode) {
			echo $header->asXML();
		}
		return $header->asXML();

	}

	private function date3339($timestamp=0) 
	{

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
