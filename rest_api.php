<?php
	date_default_timezone_set('America/Costa_Rica');
	
	function getComicId($comic_url) {
		$parts = parse_url($comic_url);
		$path= explode('/', $parts['path']);
		$comic_number = $path[count($path)-1];

		return $comic_number;
	}

	function get_http_response_code($url) {
	    $headers = get_headers($url);
	    return substr($headers[0], 9, 3);
	}

	function retrieveTodayComic($url_path) {
		if (get_http_response_code($url_path) != "200") {
		    echo "error";
		} else {
		    $json_url = file_get_contents($url_path);
		    $json = json_decode($json_url, true);

		    return $json;
		}
	}

	function retrieveOldComic($comic_id, $current_id) {
		$url_path = "https://xkcd.com/".$comic_id."/info.0.json";

		//Check if we reach the last comic
		$todays_comic = retrieveTodayComic('https://xkcd.com/info.0.json');
		if ($todays_comic['num'] == $current_id) {
			header("Location: ../index.php");
			die();
		} else {
			if (get_http_response_code($url_path) != "200") {
				if($current_id > $comic_id) {
					$comic_id--;
				    $json_file = retrieveOldComic($comic_id, $current_id);
				    return $json_file;
				} elseif ($current_id < $comic_id) {
					$comic_id++;
				    $json_file = retrieveOldComic($comic_id, $current_id);
				    return $json_file;
				}
			} else {
				$json_url = file_get_contents($url_path);
			    $json = json_decode($json_url, true);
			    return $json;
			}
		}
		//Check if we reach the last comic
	}
?>