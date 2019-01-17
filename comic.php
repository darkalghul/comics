<?php
	include 'rest_api.php';

	function getURL() {
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
			$link = "https";
		else
			$link = "http";

		$link .= "://";
		$link .= $_SERVER['HTTP_HOST'];
		$link .= $_SERVER['PHP_SELF'];

		return $link;
	}

	$test_url = getURL();

	$comic_parts = parse_url($test_url);
	$comic_path= explode('/', $comic_parts['path']);
	$current_comic_id = $comic_path[count($comic_path)-1];

	$json = retrieveOldComic($current_comic_id);

	$new_id = $json['num'];
	if ($new_id > $current_comic_id || $new_id < $current_comic_id) {
		header("Location: $new_id");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />	
	<title>Comic Book Store</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- styles -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/paper-kit.css?v=2.1.0" rel="stylesheet"/>
	<link href="../assets/css/demo.css" rel="stylesheet" />
	<!-- fonts & icons -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
</head>
<body>
	<div class="section section-dark">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 text-center">
					<h2 class="title"><?php echo $json['title']?></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-image">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<div class="card-register">
						<img src="<?php echo $json['img']?>" alt="<?php echo $json['alt']?>" class="img-fluid mx-auto d-block">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-dark">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 text-center">
					<p class="description"><?php echo $json['alt']?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-12 text-center">
					<nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item">
                            	<?php
                            		if ($json['num'] == 1) {
                            			echo "<a class='page-link no-link' href='#'' tabindex='-1'>Previous</a>";
                            		} else {
                            			$previous = $json['num'] - 1;
                            			echo "<a class='page-link' href='$previous' tabindex='-1'>Previous</a>";
                            		}
                            	?>
                            </li>
                            <?php
	                            $month = date('n');
	                            $year = date('o');
	                            // $day = date('j');
                            	if ($json['month'] == $month && $json['year'] == $year) {
                            		echo "<li class='page-item'>
                            				<a class='page-link no-link' href='#'>Next</a>
                            			  </li>";
                            	} else {
                            		$next = $json['num'] + 1;
                            		echo "<li class='page-item'>
                            				<a class='page-link' href='$next'>Next</a>
                            			  </li>";
                            	}
                            ?>
                        </ul>
                    </nav>
				</div>
			</div>
		</div>
	</div>

	<!-- Core JS Files -->
	<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
	<script src="../assets/js/popper.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- Switches -->
	<script src="../assets/js/bootstrap-switch.min.js"></script>
	<!--  Plugins for Slider -->
	<script src="../assets/js/nouislider.js"></script>
	<!--  Plugins for DateTimePicker -->
	<script src="../assets/js/moment.min.js"></script>
	<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
	<!--  Paper Kit Initialization and functons -->
	<script src="../assets/js/paper-kit.js?v=2.1.0"></script>
	<script src="../assets/js/custom_redirect.js"></script>
</body>
</html>