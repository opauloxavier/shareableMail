<?php
	$theme_Default=1;
	//session_start();  
	require_once 'framework/core/core.php';

/*if(isset($_SESSION['views']))
    $_SESSION['views'] = $_SESSION['views']+ 1;
else
    $_SESSION['views'] = 1;

echo "views = ". $_SESSION['views']; */
	//echo $_GET['to'];

	include_once THEME_URL."header.php";

	include_once PAGES_URL."featured.php";

	if( $_GET['to']=='home' or $_GET['to']==''){
		include_once PAGES_URL."cadastro.php";
	}

	else{
		include_once PAGES_URL."404.php";
	}

	include_once THEME_URL."footer.php";

?>
