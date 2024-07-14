<?php

//definir fuso-horario

date_default_timezone_set('America/Sao_Paulo');

$servidor= 'localhost';
$banco= "clinica";
$usuario= "root";
$senha= "";

try {
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (\Throwable $th) {
    echo 'Erro ao conectar com ao banco de dados! <br>';
    echo $th;
}


$nome_sistema = 'Paulo Barbosa';
$email_sistema = 'paulovcb1@gmail.com';
$telefone_sistema = '(61) 999845-0867';


$query = $pdo ->query("SELECT * FROM config");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count ($res);

if ($linhas == 0){
    $query = $pdo ->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone = '$telefone_sistema', logo = 'foto.png', logo_relatorio = 'foto.jpg', icone = 'icone.png'  ");
    //VERIFICAR NOME DAS FOTOS DO BANCO DE DADOS COM AS DO ARQUIVOS
} else {
    $nome_sistema = $res[0] ['nome'];
    $email_sistema = $res[0] ['email'];
    $telefone_sistema = $res[0] ['telefone'];
    $endereco_sistema = $res[0] ['endereco'];
    $instagram_sistema = $res[0] ['instagram'];
    $logo_sistema = $res[0] ['logo'];
    $logo_relatorio = $res[0] ['logo_relatorio'];
    $icone_sistema = $res[0] ['icone'];

}


