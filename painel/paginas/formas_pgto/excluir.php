<?php

$tabela = 'formas_pgto';
require_once("../../../conexao.php");

$id = $_POST['id']; 


$pdo ->query("DELETE FROM $tabela WHERE id = '$id' ");
echo "Excluído com Sucesso";