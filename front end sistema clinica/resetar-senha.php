<?php
require_once("conexao.php");

if (!isset($_REQUEST['email']) || !isset($_REQUEST['token'])) {
	header('location: ' . $url_sistema);
	exit;
}

$statement = $pdo->prepare("SELECT * FROM usuarios WHERE email=? AND token=?");
$statement->execute([$_REQUEST['email'], $_REQUEST['token']]);
$result = $statement->fetchAll();
$tot = $statement->rowCount();
if ($tot == 0) {
	header('location: ' . $url_sistema);
	exit;
}

$_SESSION['temp_reset_email'] = $_REQUEST['email'];
$_SESSION['temp_reset_token'] = $_REQUEST['token'];



?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $nome_sistema ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="img/icone.png">
	<link rel="stylesheet" href="css\style.css">


</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<img class="imagem" src="login-form-15/images/foto.png" alt="IMG">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Recuperar Senha</h3>
								</div>
							</div>
							<form method="post" id="form-recuperar" class="mb-3">
								<div class="form-group mt-3">
									<input type="password" class="form-control" placeholder="Digite uma nova senha" id="senha" name="senha" required>
								</div>
								<div class="form-group">
									<input id="password-field" type="password" class="form-control" placeholder="Repita sua senha" id="re_senha" name="re_senha" required>
									<small><div id="mensagem-recuperar" align="center"></div></small>


									<input type="hidden" name="token" id="token" value="">

									<input type="hidden" name="email" id="email" value="<?php echo $_REQUEST['email'] ?>">

									<button style="margin-top: 10px;" class="form-control btn btn-primary submit" id="botao" type="submit">Alterar Senha</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="login-form-15/js/jquery.min.js"></script>
	<script src="login-form-15/js/popper.js"></script>
	<script src="login-form-15/js/bootstrap.min.js"></script>
	<script src="login-form-15/js/main.js"></script>
</body>

</html>




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
	$("#form-recuperar").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "alterar-senha.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-recuperar').text('');
				$('#mensagem-recuperar').removeClass()
				if (mensagem.trim() == "Senha alterada com Sucesso") {
					//$('#btn-fechar-rec').click();					
					$('#senha').val('');
					$('#re_senha').val('');
					$('#mensagem-recuperar').addClass('text-success')
					$('#mensagem-recuperar').text('Sua Senha foi enviada para o Email')

				} else {

					$('#mensagem-recuperar').addClass('text-danger')
					$('#mensagem-recuperar').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>