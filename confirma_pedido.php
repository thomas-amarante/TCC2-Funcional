<?php
	
	//session_name('sessionuser');
	session_start();
	include('includes/connect.php');
	
	$quadra = $_POST['quadra'];
	$quadra_local = $_POST['quadra_local'];
	echo $data 	= $_POST ['data'];
	echo $hora 	= $_POST ['hora'];
	echo $dia 	= $_POST ['dia'];
	
	
	$dataformat = explode(":",$hora);
	echo $formatar_hora = $dataformat[0].'_00 ';
	
	echo $sql = "SELECT $formatar_hora as valor FROM tb_horarios WHERE id_quadras_h = '$quadra' AND id_quadras_locais_h = '$quadra_local' AND dias = '$dia'";
	$query = mysqli_query($conn, $sql);
	$dados = mysqli_fetch_array($query);
	
																/** trecho de código funcionando
	 $sql = "SELECT * FROM tb_quadras WHERE id = '$quadra'";
	$query = mysqli_query($conn, $sql);
	$dados = mysqli_fetch_array($query);
	
	switch ($hora) {
    case "09:00:00":
        $valor = $dados['valor_manha'];
        break;
    case "10:00:00":
        $valor = $dados['valor_manha'];
        break;
	case "11:00:00":
        $valor = $dados['valor_manha'];
        break;
	case "12:00:00":
        $valor = $dados['valor_manha'];
        break;
	case "13:00:00":
        $valor = $dados['valor_tarde'];
        break;
	case "14:00:00":
        $valor = $dados['valor_tarde'];
        break;
	case "15:00:00":
        $valor = $dados['valor_tarde'];
        break;
	case "16:00:00":
        $valor = $dados['valor_tarde'];
        break;
	case "17:00:00":
        $valor = $dados['valor_tarde'];
        break;
	case "18:00:00":
        $valor = $dados['valor_noite'];
        break;
	case "19:00:00":
        $valor = $dados['valor_noite'];
        break;
	case "20:00:00":
        $valor = $dados['valor_noite'];
        break;
	case "21:00:00":
        $valor = $dados['valor_noite'];
        break;
	case "22:00:00":
        $valor = $dados['valor_noite'];
        break;
	case "23:00:00":
        $valor = $dados['valor_noite'];
        break;
}       
														trecho de código funcionando  **/ 
	  
					$aux = '.00';
					$_SESSION['QUADRA'] 			= $quadra;
					$_SESSION['DATA'] 				= $data;
					$_SESSION['VALOR'] 				= $dados['valor'];
					$valor							= $dados['valor'];
					$_SESSION['HORA'] 				= $hora;
					$_SESSION['QUADRA_LOCAL'] 		= $quadra_local;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
	<link rel="stylesheet" href="now-ui-kit.css" type="text/css">
	<link rel="stylesheet" href="assets/css/nucleo-icons.css" type="text/css">
	<script src="assets/js/navbar-ontop.js"></script>
	
 <title>Pedido de teste</title>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>﻿
</head>

<body>
 
    
	<div class="container py-5 ">
	
	 </div>
	 <div class="container">
		 <div class="row">
			 <div class="col-md-12">
				<div class="card mb-4">
					<div class="card-header">
						<h1> Confirma os dados da sua reserva: </h3>
					</div>
					<div class="card-body mt-2">
								<h2><p class="text-center">Data selecionada: <?php echo $data ?></p><h2>
						
								<p class="text-center">Local selecionada: <?php echo $quadra ?></p>
								
								<p class="text-center">Quadra selecionada: <?php echo $quadra_local ?></p>
						
								<p class="text-center">Horário do jogo: <?php echo $hora ?></p>
						
								<p class="text-center">Usuário: <?php echo $_SESSION['NOME'] ?></p>
						
								<p class="text-center">Valor: R$<?php echo $_SESSION['VALOR'] ?></p>	
					</div>
					<div class="card-footer text-center">
					<button class="btn btn-success"  onclick="enviaPagseguro();">Efetuar pagamento online - PagSeguro</button>  <!-- botão com função ao clicar: executar a função enviaPagseguro -->
					</div>
					<div class="card-footer text-center">
					<form action="gravar_pedido_bd.php" method="post">
					<button type="submit" class="btn btn-info" >Desejo pagar no local</button>
					<input type="hidden" name="data" id="data" value="<?php echo $data ?>" placeholder="<?php echo $data ?>" />
					<input type="hidden" name="quadra" id="quadra" value="<?php echo $quadra ?>" placeholder="<?php echo $quadra ?>" />
					<input type="hidden" name="quadra_local" id="quadra_local" value="<?php echo $quadra_local ?>" placeholder="<?php echo $quadra_local ?>" />
					<input type="hidden" name="valor" id="valor" value="<?php echo $valor ?>" placeholder="<?php echo $valor ?>" />
					<input type="hidden" name="hora" id="hora" value="<?php echo $hora ?>" placeholder="<?php echo $hora ?>" />
					</form>
					</div>
				<div>
			 </div>
		 </div>
	 </div>
 

 
	<img src="loading.gif" id="loading" style="visibility: hidden">
 
	<form id="comprar" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
		<input type="hidden" name="code" id="code" value="" />
	</form>

	<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script> <!-- js necessário para execução da lightbox -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	 <script>
	 function enviaPagseguro(codigo){ <!-- função que salva o pedido no banco, recupera a coluna id e passa via post para a pagina pagseguro.php, além de passar dinamicamente a variável code junto com a url do form acima -->
	 
	   $.post('salvarPedido.php','',function(idPedido){
	 
		 $('#loading').css("visibility","visible");
	 
		 $.post('pagseguro.php',{idPedido:idPedido},function(data){

		   $('#code').val(data);
		   $('#comprar').submit();

		   $('#loading').css("visibility","hidden");
		 })
	   })
	 }
	 </script>
 
</body>
</html>	