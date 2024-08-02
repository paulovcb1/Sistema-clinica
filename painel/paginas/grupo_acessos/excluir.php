<?php

$tabela = 'grupo_acessos';
require_once("../../../conexao.php");

$id = $_POST['id']; 

$query2 = $pdo ->query("SELECT * FROM $tabela where id = '$id'");
$res2 = $query2->fetchall(PDO::FETCH_ASSOC);
$total_acessos = @count ($res2);

    if ($total_acessos > 0) {
        echo"Voce primeiro precisa excluir os acessos que pertecem a este grupo";
        exit();
    }

$pdo ->query("DELETE FROM $tabela WHERE id = '$id' ");
echo "Excluído com Sucesso";