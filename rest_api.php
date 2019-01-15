<?php
	$url_path = "https://xkcd.com/info.0.json";

	function get_http_response_code($url) {
	    $headers = get_headers($url);
	    return substr($headers[0], 9, 3);
	}

	if (get_http_response_code($url_path) != "200") {
	    echo "error";
	} else {
	    $json_url = file_get_contents($url_path);
	    $json = json_decode($json_url, true);

	    $current_month = $json['month'];
	    $current_year = $json['year'];
	    $current_day = $json['day'];

	    $title = $json['title'];
		$trasncript = $json['transcript'];
		$alt = $json['alt'];
		$image_url = $json['img'];
		$last_comic = $json['num'];
	}
?>