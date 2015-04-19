<?php if( !isset($_SESSION) ){ session_start(); }
	enviaMail('contato.pauloxavier@gmail.com','Seu amigo indicou você!',$_SESSION['ID'],$_SESSION['nome']);
?>