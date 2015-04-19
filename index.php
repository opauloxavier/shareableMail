<?php if( !isset($_SESSION) ){ session_start(); }
	
	require_once('framework/core/functions.php');

	$theme_Default=1;

	if (isset($_SESSION["status_page"]))
		echo $_SESSION["status_page"];
	

	if(isset($_SESSION["nome"])){
		$_SESSION['logado'] = true;
	}

	else{
		$_SESSION['logado'] = false;
	}

	if (isset($_SESSION['logado'])){
	  if ($_SESSION['logado'] != NULL){                   
	  	}
	}


	if (isset($_POST['submitLogin'])){
		entrarSistema($_POST['emailLogin'],$_POST['passwordLogin']);
	}

	if (isset($_GET['ref'])){
		$_SESSION['ref'] = $_GET['ref'];
		}
	
if(isset($_POST['submitCadastro'])){

		if(isset($_SESSION['ref'])){

			if(criaCadastro($_POST['nomeCadastro'],$_POST['emailCadastro'],$_POST['passwordCadastro'],$_SESSION['ref'])){
				entrarSistema($_POST['emailCadastro'],$_POST['passwordCadastro']);
			}
		}

		else {
			if(criaCadastro($_POST['nomeCadastro'],$_POST['emailCadastro'],$_POST['passwordCadastro'],0)){
				entrarSistema($_POST['emailCadastro'],$_POST['passwordCadastro']);
			}

		}
	}

	include_once THEME_URL."header.php";

	include_once PAGES_URL."featured.php";

	include_once PAGES_URL."status.php";

	if(isset($_GET['to'])){
		if($_GET['to']=='home'){
			include_once PAGES_URL."cadastro.php";
		}

		elseif($_GET['to']=='logout'){
			include_once PAGES_URL."logout.php";
		}

		elseif($_GET['to']=='teste'){
			include_once PAGES_URL."functionTest.php";
		}

		elseif($_GET['to']=='error'){
			include_once PAGES_URL."cadastro.php";
		}

		else{
			include_once PAGES_URL."404.php";
		}

	}
	
	else{
		include_once PAGES_URL."cadastro.php";
	}


	include_once THEME_URL."footer.php";

?>
