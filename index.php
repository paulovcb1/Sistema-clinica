<?php
include_once("conexao.php");
$query = $pdo ->query("SELECT * FROM usuarios");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count ($res);
$senha = 123;
$senha_crip = md5($senha);

if ($linhas == 0){
    $query = $pdo ->query("INSERT INTO usuarios SET nome = '$nome_sistema', email = '$email_sistema', senha =  '$senha', senha_crip = '$senha_crip', nivel = 'Administrador', ativo = 'sim', foto = 'sem-foto.jpg', telefone = '$telefone_sistema' ");
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo do sistema</title>
    <link rel="stylesheet" href="css\style.css">
    <link rel="shortcut icon" href="img\icone.png">
    
</head>
<body>
    <div class="login">
        <div class="form">
            <img src="img\icone.png" alt="Logo">
            <form method="post" action="autenticar.php">
                <input type="text" name="email" placeholder="Seu Email">
                <input type="password" name="senha" placeholder="Sua Senha">
                <button class="button">
                    Login
                </button>
            </form>
        </div>
        
    </div>
</body>
</html>