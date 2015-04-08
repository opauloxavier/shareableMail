<?php
	$theme_Default=1;
	//session_start();  
	require_once 'config/config.php';

/*if(isset($_SESSION['views']))
    $_SESSION['views'] = $_SESSION['views']+ 1;
else
    $_SESSION['views'] = 1;

echo "views = ". $_SESSION['views']; */

	
 if(isset($_GET['to']) and $theme_default==1/*and isset($_SESSION))*/{

 	include_once THEME_URL."header.php";

		if($_GET['to']=='home'){
				include_once PAGES_URL."table.php";
		}

		elseif($_GET['to']=='about'){
			include_once PAGES_URL."desenvolvimento.php";
		}

		elseif($_GET['to']=='contact'){
			include_once PAGES_URL."desenvolvimento.php";
		}

		elseif($_GET['to']=='version'){
			include_once PAGES_URL."sv_details.php";
		}

		else{
			include_once PAGES_URL."404.php";
		}

			include_once THEME_URL."footer.php";
	}

else{
		include_once PAGES_URL."login.php";
	}
	
?>

