<?php
class music {
	public function indexAction($save = false) {
		$db = Database::getDatabase();
		$view = new View();
		$view->setView('music');

		$db->query("SELECT song, artist FROM Songs");
		$songs = $db->getRows();
		$view->assign('songs', $songs);

		$view->render();
	}

	//As i could not find some free API that expose the top ten music worldwide i had to web scrap billboard.com website and save the top 10 locally
	//Run this method to maintain the ranking updated
	public function getmusicfromsource() {
		include_once '../vendor/simple_html_dom.php';
		
		$url = "http://www.billboard.com/charts/hot-100";
		$html = file_get_html($url);

		$topten = array();
		for($i=0; $i < 10; $i++) {
			$topten[] = array (
								'song' => trim($html->find('h2.chart-row__song', $i)->plaintext),
								'artist' => trim($html->find('a.chart-row__artist', $i)->plaintext)
								); 
		}

		$db = Database::getDatabase();

		$i = 1;
		foreach($topten as $music) {
			$song = $db->escape($music['song']);
			$artist = $db->escape($music['artist']);
			$db->query("UPDATE Songs SET song = '$song', artist = '$artist' WHERE id = $i");
			$i++;
		}
		
		$view = new View();
		$view->setView('rankingupdate');
		$view->render();
	}
}
?>