<?php
include_once("conexao.php");
$query = $pdo ->query("SELECT * FROM usuarios");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count ($res);
$senha = 123;
$senha_crip = sha1($senha);

if ($linhas == 0){
    $query = $pdo ->query("INSERT INTO usuarios SET nome = '$nome_sistema', email = '$email_sistema', senha =  '$senha', senha_crip = '$senha_crip', nivel = 'Administrador', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = '$telefone_sistema', data = curDate() ");
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo do sistema</title>
    <link rel="stylesheet" href="css\style.css">
    <link rel="shortcut icon" href="img\icone.png">
    
</head>
<body>
    <div class="logar">
        <div class="formulario">
            <img src="img\icone.png" alt="Logo">
            <form method="post" action="autenticar.php">
                <input type="text" name="email" placeholder="Seu Email" required>
                <input type="password" name="senha" placeholder="Sua Senha" required >
                <button class="botao">
                    Login
                </button>
            </form>
            <p class="recuperar"><a title="Clique para recupearar a senha" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Esqueci minha senha</a></p>
        </div>
        
    </div>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content form">
     
      <form method="post" id="form-recuperar">     

      <div class="modal-body "> 
        <div class="row">
            <div class="col-md-9">
                <form method="post" id="form-recuperar">
				<input placeholder="Digite seu Email" class="form-control" type="email" name="email" id="email-recuperar" required> 
			    </form>	
            </div>
            
                <div class="col-md-3">
                    <button class="btn btn-primary" type="submit">Recuperar</button>
                </div>
        
       <br>
       <small><div id="mensagem-recuperar" align="center"></div></small>
   
     
  </form>
    </div>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


 <script type="text/javascript">
	$("#form-recuperar").submit(function () {

        $('#mensagem-recuperar').text('Enviando...');

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "recuperar-senha.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-recuperar').text('');
				$('#mensagem-recuperar').removeClass()
				if (mensagem.trim() == "Recuperado com Sucesso") {
					//$('#btn-fechar-rec').click();					
					$('#email-recuperar').val('');
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