<?php if( !isset($_SESSION) ){ session_start(); }
	
	$theme_Default=1;
	$status_page=0;
	
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

	require_once('framework/core/functions.php');

	if (isset($_POST['submitLogin']) and (autentica($_POST['emailLogin'],$_POST['passwordLogin'])!=false)){
	
		entrarSistema($_POST['emailLogin'],$_POST['passwordLogin']);
	
	}

if(isset($_POST['submitCadastro'])){
	
	if(criaCadastro($_POST['nomeCadastro'],$_POST['emailCadastro'],$_POST['passwordCadastro']))
		entrarSistema($_POST['emailCadastro'],$_POST['passwordCadastro']);
}

	include_once THEME_URL."header.php";

	include_once PAGES_URL."featured.php";

	if(isset($_GET['to'])){
		if($_GET['to']=='home'){
			include_once PAGES_URL."cadastro.php";
		}
		elseif($_GET['to']=='teste'){
			include_once PAGES_URL."functionTest.php";
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
