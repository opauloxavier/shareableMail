<?php
	
	require_once("framework/core/core.php");


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

	function connect_db(){

		$mysqli = new mysqli(db_user, db_login, db_password, db_name);

		if ($mysqli->connect_errno) {
   			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		return $mysqli;
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

	function criaCadastro($nomeCadastro,$emailCadastro,$passwordCadastro){
		$mysqli = connect_db();
		
		if(check_double($emailCadastro)==1){
			$result = mysqli_query($mysqli,"INSERT INTO px_user (email, nome, password) VALUES ('$emailCadastro','$nomeCadastro', '$passwordCadastro')");	
			
			return true;
		}
		
		else{
			return false;
		}
	}

	function entrarSistema($email,$senha){
		if(isset($email) and (autentica($email,$senha)!=false)){

		$db = connect_db();

		$_SESSION['nome'] = autentica($email,$senha);
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $senha;
		$_SESSION['logado'] = true;
		
		}

	}

	function headerLogin($logado){


	if($logado){
				echo 

				'<div class="col-md-4 pull-right">
				Bem vindo, <span style="color:#7f4098">'.$_SESSION["nome"].'</span>.'.'<div class="col-md-2 pull-right text-center" style="color:#C21952;"><a style="color:#C21952;" href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"> Sair</span></a>
				</div>
				</div>';
		}

	else{
			echo'	
		     <form class="form-inline" method="POST" action="home">
				  <div class="form-group">
				    <label class="control-label" for="exampleInputEmail3">E-mail</label>
				    <input type="email" class="form-control" id="emailLogin" name="emailLogin" required="true" placeholder="Digite seu email">
				  </div>
				  <div class="form-group">
				    <label class="control-label" for="exampleInputPassword3">Senha</label>
				    <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" required="true" placeholder="Digite sua senha">
				  </div>
				  <button type="submit" name="submitLogin" class="btn btn-default">Entrar</button>
				</form>';
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
?>