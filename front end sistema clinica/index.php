<?php
include_once("conexao.php");
$query = $pdo->query("SELECT * FROM usuarios");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count($res);
$senha = 123;
$senha_crip = sha1($senha);

if ($linhas == 0) {
    $query = $pdo->query("INSERT INTO usuarios SET nome = '$nome_sistema', email = '$email_sistema', senha =  '$senha', senha_crip = '$senha_crip', nivel = 'Administrador', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = '$telefone_sistema', data = curDate() ");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo do sistema</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img\icone.png">

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
                                    <h3 class="mb-4">Login</h3>
                                </div>
                            </div>
                            <form method="post" action="autenticar.php" class="signin-form">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" placeholder="Nome de Usuário" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" placeholder="Senha" id="senha" name="senha" required>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="form-control btn submit" id="botao">Login</button>
                                </div>
                                <div class="form-group d-md-flex">

                                </div>
                            </form>
                            <div class="w-50 text-md-left">
                                <p class="recuperar"><a title="Clique para recupearar a senha" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Esqueci minha senha</a></p>
                            </div>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content form">

            <form method="post" id="form-recuperar">

                <div class="modal-body ">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" id="form-recuperar">
                                <input placeholder="Digite seu Email" class="form-control" type="email" name="email" id="email-recuperar" required>
                            </form>
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit">Recuperar</button>
                        </div>

                        <br>
                        <small>
                            <div id="mensagem-recuperar" align="center"></div>
                        </small>


            </form>
        </div>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
    $("#form-recuperar").submit(function() {

        $('#mensagem-recuperar').text('Enviando...');

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "recuperar-senha.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
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