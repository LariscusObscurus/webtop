<?php
	include_once("./scripts/handling.php");
	$title = "Home";
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?> | WEBTOP</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="jquery.fancybox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="helpers/jquery.fancybox-buttons.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="helpers/jquery.fancybox-thumbs.css" media="screen" />
		<script type="text/javascript" src="jquery.mousewheel-3.0.6.pack.js"></script>
		<script type="text/javascript" src="jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="jquery.mousewheel-3.0.6.pack.js"></script>
		<script type="text/javascript" src="helpers/jquery.fancybox-buttons.js"></script>
		<script type="text/javascript" src="helpers/jquery.fancybox-media.js"></script>
		<script type="text/javascript" src="helpers/jquery.fancybox-thumbs.js"></script>
		<script type="text/javascript" src="jquery-ui-1.10.2.custom.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
        <?php
            
            if (isset($_SESSION["username"]) || isset($_COOKIE["username"])) {
                include_once("./pages/webtop.php");
            } else {
                include_once("./pages/login.php");
            }
            
        ?>
	</body>
</html>