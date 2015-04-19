<?php
	$numeroIndicados = check_Referral_True($_SESSION['ID']);

	if (isset($_POST['submitIndica'])){

		criaReferral($_POST['emailIndica']);
	}

	//echo $GLOBALS["status"];
?>

<div style="height:400px;" class="col-md-12 bordaroxa">
	<div class="col-md-12">
		<div class="col-md-6 col-md-offset-3 text-center">
			<h3> PARABÉNS! Você já possui <span class="rosa">10% de desconto</span> em sua primeira compra na loja Essência do Prazer e participará do sorteio do <span class="rosa">Rabbit!</span></h3>
		</div>
		<div class="col-md-6 col-md-offset-3 text-center">
			<h4> Agora, que tal <span class="rosa">contar para seus amigos?</span> Para cada amigo seu indicado, suas chances de ganhar o sorteio <span class="rosa">aumentam!</span></h4>
		</div>

		<div class="col-md-6 col-md-offset-3 text-center">
			<h4> Seu Link de Referência é: <span class="rosa"><?php echo $_SERVER['HTTP_HOST'].'/ref/'.$_SESSION['ID'].'/';?></span>. Para cada amigo seu indicado, suas chances de ganhar o sorteio <span class="rosa">aumentam!</span></h4>
		</div>
		<div class="col-md-8 col-md-offset-3 text-center">
			<form class="form-horizontal" method="POST" action="<?php echo BASE_URL; ?>index.php" id="formIndica" name="formIndica">
				<div class="form-group">
					<div class="col-md-8">
					    <input type="email" class="form-control" id="emailIndica" name="emailIndica" placeholder=" Digite o Email do seu amigo" required="true">
					</div>	
					<div class="col-md-2">
					      <button type="submit" name="submitIndica" class="btn btn-default btn-block btn-custom">Indicar Amigo</button>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				<h5> Amigos Cadastrados:<span class="rosa"> <?php echo $numeroIndicados?></span></h5>
			</div>
		</div>
	</div>
</div>