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


