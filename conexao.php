<?php

//definir fuso-horario

date_default_timezone_set('America/Sao_Paulo');


$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/Sistema-clinica/";
}

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
    $query = $pdo ->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone = '$telefone_sistema', logo = 'foto.png', logo_relatorio = 'foto.jpg', icone = 'icone.png', ativo = 'Sim' , marca_dagua = 'Sim' ");
    //VERIFICAR NOME DAS FOTOS DO BANCO DE DADOS COM AS DO ARQUIVOS
} else {
    $nome_sistema = $res[0] ['nome'];
    $email_sistema = $res[0] ['email'];
    $telefone_sistema = $res[0] ['telefone'];
    $endereco_sistema = $res[0] ['endereco'];
    $logo_sistema = $res[0] ['logo'];
    $logo_relatorio = $res[0] ['logo_relatorio'];
    $icone_sistema = $res[0] ['icone'];
    $ativo_sistema = $res[0] ['ativo'];
    $comissao_sistema = $res[0] ['comissao'];
    $token_sistema = $res[0] ['token'];
    $instancia_sistema = $res[0] ['instancia'];
    $horas_confirmacao_sistema = $res[0] ['horas_confirmacao'];
    $marca_dagua = $res[0] ['marca_dagua'];
    $whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);


    if($ativo_sistema != 'Sim' and $ativo_sistema != ''){
        echo 'Sistema Desativado';
        exit();
    }
}


