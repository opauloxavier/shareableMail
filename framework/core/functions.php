<?php
	require_once("framework/core/core.php");

	function setCodeAlerta($numeroCodigo){
		if($numeroCodigo==4)
			header("location:sucesso/".$numeroCodigo);
		else
			header("location:error/".$numeroCodigo);
		//$_SESSION['status'] = $numeroCodigo;
	}

function connect_db(){

		$mysqli = new mysqli(db_user, db_login, db_password, db_name);

		if ($mysqli->connect_errno) {
   			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		return $mysqli;
	}


	function check_double($email) {

		$mysqli = connect_db();

		$table = db_table;

		$result = mysqli_query($mysqli,"SELECT * FROM px_user WHERE email = '$email'");

		$num = mysqli_num_rows($result);

		if ($num==0){
			$sql = "INSERT INTO users (email) VALUES ('$email')";

			mysqli_query($mysqli,$sql);

			return 1;
		}

		else{
			return 2;
		}

	}


	function check_double_referral($email,$id) {

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM `px_referral` WHERE Referred_Email = '$email' AND RefereeID = '$id' ");

		$num = mysqli_num_rows($result);

		if ($num==0){

			return 1;
		}

		else{
			return 2;
		}

	}

		function check_Referral_True($id) {

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM `px_referral` WHERE RefereeID = '$id' AND Status = '1' ");

		$num = mysqli_num_rows($result);

		return $num;

	}


	function autentica($login,$senha){

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM px_user WHERE email = '$login' AND password='$senha' ");

		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)!=false){
			$nome = mysqli_query($mysqli,"SELECT nome FROM px_user WHERE email = '$login'");
			$row = mysqli_fetch_array($nome);

			return $row['nome'];
		}

		else{
			setCodeAlerta(2);
			return false;
		}

		//header('Location: home');
	}

	function criaCadastro($nomeCadastro,$emailCadastro,$passwordCadastro,$refereeID=0){
		$mysqli = connect_db();

		if(check_double($emailCadastro)==1){

			if ($refereeID!=0){

				$result = mysqli_query($mysqli,"UPDATE px_referral SET `Status` = '1' WHERE `Referred_email`='$emailCadastro' and `RefereeID`='$refereeID'");

				if (mysqli_num_rows($result)==false)
					criaReferral($emailCadastro,1);
				//;
			}


			$result = mysqli_query($mysqli,"INSERT INTO px_user (email, nome, password) VALUES ('$emailCadastro','$nomeCadastro', '$passwordCadastro')");	
			
			return true;
			}
		
		else{
		
			setCodeAlerta(6);

			return false;
		}
	}

	function entrarSistema($email,$senha){
		if(isset($email) and (autentica($email,$senha)!=false)){

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT ID FROM px_user WHERE email = '$email'");

		$id = mysqli_fetch_array($result);

		$_SESSION['nome'] = autentica($email,$senha);
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $senha;
		$_SESSION['ID'] = $id[0];
		$_SESSION['logado'] = true;

		}

		else{

			if(check_double($email)==1){
				echo "entrei aqui";
				setCodeAlerta(1);
			}

			else {
				setCodeAlerta(2);
			}
		}

	}

	function headerLogin($logado){


		if($logado){
					include_once PAGES_URL."logado.php";
			}

		else{
				include_once PAGES_URL."form-login.php";
		
		}	
	}

function areaCadastro($logado){

	if($logado){
			include_once PAGES_URL."indica.php";
		}

	else{
			include_once PAGES_URL."form-cadastro.php";    
	}	
	
	}

function criaReferral($emailReferral,$status=0){

	$mysqli = connect_db();

	if (check_double($emailReferral)==1) {

		if(isset($_SESSION['ref']))
			$id=$_SESSION['ref'];	

		else 
			$id=$_SESSION['ID'];
		
		if(check_double_referral($emailReferral,$id)==1){

			$result = mysqli_query($mysqli,"INSERT INTO px_referral (`Referral_ID`, `RefereeID`, `Referred_Email`, `Status`) VALUES (NULL, '$id', '$emailReferral', '$status')");	

				if(!isset($_GET['ref']))
					setCodeAlerta(4);
		}

		else{
			setCodeAlerta(5);
		}
	}

	else {
		setCodeAlerta(6);
	}
}

	function displayAlerta($alertClass,$textoAlerta,$codAlerta){
		if($codAlerta!=0)
			echo '
				<div class="row">
					<div class="col-md-offset-6 col-md-2 text-center">
						<div class="alert '.$alertClass.' alert-dismissable alertas">
	   						<button type="button" name="buttonAlert" class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
	   						'.$textoAlerta.'
						</div>
					</div>
				</div>
			';

			//unset($_SESSION['status']);
	}



?>