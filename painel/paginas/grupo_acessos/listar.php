<?php

$tabela = 'grupo_acessos';
require_once("../../../conexao.php");
$query = $pdo ->query("SELECT * FROM $tabela order by id desc");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count ($res);
if ($linhas > 0) {
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th> 
	<th>Acessos</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for ($i = 0; $i < $linhas; $i++) {
    $id = $res[$i]['id'];
    $nome = $res[$i]['nome'];

    $query2 = $pdo ->query("SELECT * FROM acessos where grupo = '$id'");
    $res2 = $query2->fetchall(PDO::FETCH_ASSOC);
    $total_acessos = @count ($res2);



echo <<<HTML
    <tr>
        <td>
            <input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
            {$nome}</td>
        <td class="esc">{$total_acessos}</td>
        <td>
        <big>
            <a href="#" onclick="editar('{$id}','{$nome}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a>
        </big>   

            <li class="dropdown head-dpdn2" style="display: inline-block;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

                <ul class="dropdown-menu" style="margin-left:-230px;">
                    <li>
                        <div class="notification_desc2">
                        <p>Tem certeza que deseja excluir? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
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

<!-- DATA TABLE CONFERIR SEMPRE ERROS NELA POIS E RECORRENTE -->
<script type="text/javascript">
                var table = new DataTable('#tabela', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.1.2/i18n/pt-BR.json',
                }, "ordering": false, "stateSave": true
            });
            </script>

    <script>
        function editar (id, nome){
            $('#mensagem').text('');
            $('#titulo_inserir').text('Editar Registro');

            $('#id').val(id);
            $('#nome').val(nome);

            

            $('#modalForm').modal('show');
        }
    

        function limparCampos(){
            $('#id').val('');
            $('#nome').val('');
            $('#email').val('');
            $('#telefone').val('');
            $('#endereco').val('');
            $('#ids').val('');
            $('#btn-deletar').hide();
        }

        function selecionar(id) {

            var ids = $('#ids').val();

            if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

        var ids_final = $('#ids').val();

        if(ids_final != ""){
            $('#btn-deletar').show();
        }else {
            $('#btn-deletar').hide(); 
        }

        }


        function excluirSel(id){
            var ids = $('#ids').val();
            var id = ids.split("-");
            for (i = 0 ; i < id.length - 1; i++){
                    excluir(id[i])
            }

            limparCampos();
        }
        
    </script>





