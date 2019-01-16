<?php
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

	function retrieveOldComic($comic_id) {
		$url_path = "https://xkcd.com/".$comic_id."/info.0.json";

		if (get_http_response_code($url_path) != "200") {
		    $comic_id++;
		    retrieveOldComic($comic_id);
		} else {
		    $json_url = file_get_contents($url_path);
		    $json = json_decode($json_url, true);

		    return $json;
		}
	}
?>