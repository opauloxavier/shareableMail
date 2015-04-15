<?php
	
	require_once("framework/core/core.php");

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
		if(mysqli_num_rows($result)>0){
			$nome = mysqli_query($mysqli,"SELECT nome FROM px_user WHERE email = '$login'");
			$row = mysqli_fetch_array($nome);

			return $row['nome'];
		}

		else
			return false;

		header('Location: home');
	}

	function criaCadastro($nomeCadastro,$emailCadastro,$passwordCadastro,$refereeID=false){
		$mysqli = connect_db();
		
		if(check_double($emailCadastro)==1){

			if ($refereeID!=false){

				$result = mysqli_query($mysqli,"UPDATE px_referral SET `Status` = '1' WHERE `Referred_email`='$emailCadastro' and `RefereeID`='$refereeID'");
				//;
			}


			$result = mysqli_query($mysqli,"INSERT INTO px_user (email, nome, password) VALUES ('$emailCadastro','$nomeCadastro', '$passwordCadastro')");	
			
			return true;
			}
		
		else{
			
			$status_page = 6;
			
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
				$status_page=1;
			}

			else {
				$status_page=2;
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

function criaReferral($emailReferral){

	$mysqli = connect_db();

	if (check_double($emailReferral)==1) {

		$id=$_SESSION['ID'];
		
		if(check_double_referral($emailReferral,$id)==1){

			$result = mysqli_query($mysqli,"INSERT INTO px_referral (`Referral_ID`, `RefereeID`, `Referred_Email`, `Status`) VALUES (NULL, '$id', '$emailReferral', '0')");	

					echo 'ok';
					$status_page=4;
		}

		else{
			$status_page=5;
			echo 'ja criado para esse id';
		}
	}

	else {
		echo 'email ja cadastrado';
		$status_page=6;
	}
}



?>