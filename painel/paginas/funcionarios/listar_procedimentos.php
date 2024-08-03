<?php

$tabela = 'func_proc';
require_once("../../../conexao.php");

$usuario = $_POST['id'];

$query = $pdo ->query("SELECT * FROM $tabela where funcionario = '$usuario' ");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count ($res);
if ($linhas > 0) {
echo <<<HTML
<small>
    <table class="table table-hover">
    <thead>
	<tr> 
	<th>Procedimento</th>	
	<th>Excluir</th>	
	</tr> 
	</thead> 
	<tbody>	
HTML;

for ($i = 0; $i < $linhas; $i++) {
    $id = $res[$i]['id'];
    $procedimento = $res[$i]['procedimento'];

    $query2 = $pdo ->query("SELECT * FROM procedimentos where id = '$procedimento' ");
    $res2 = $query2->fetchall(PDO::FETCH_ASSOC);
    $nome_procedimento = $res2[0]['nome'];
    

echo <<<HTML
    <tr >
        <td class="esc">{$nome_procedimento}</td>
        <td class="iconestabela">
            <li class="dropdown head-dpdn2" style="display: inline-block;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"title="Deletar Funcionario"></i></big></a>

                <ul class="dropdown-menu" style="margin-left:-230px;">
                    <li>
                        <div class="notification_desc2">
                        <p>Tem certeza que deseja excluir? <a href="#" onclick="excluirProcedimento('{$id}','{$usuario}')"><span class="text-danger">Sim</span></a></p>
                        </div>
                    </li>										
                </ul>
            </li>
        </td>
    </tr>
HTML;

}
echo <<<HTML
    </tbody>
        <small>
            <div align="center" id="mensagem-excluir">
                
            </div>
        </small>
    </table>
    
HTML;

} else {
    echo 'Nenhum Registro Encontrado!';
}

?>



    <script type="text/javascript">
       
        function excluirProcedimento (id, usuario){
        $.ajax({
        url: 'paginas/' + pag + "/excluir_procedimento.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {
                listarProcedimentos(usuario);
            }
        }
    });


        }

        
        
    </script>



