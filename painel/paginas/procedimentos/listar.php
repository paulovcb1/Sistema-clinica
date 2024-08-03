<?php

$tabela = 'procedimentos';
require_once("../../../conexao.php");
$senha = '123';
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
	<th class="esc">Valor</th>	
	<th class="esc">Tempo</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for ($i = 0; $i < $linhas; $i++) {
    $id = $res[$i]['id'];
    $nome = $res[$i]['nome'];
    $tempo = $res[$i]['tempo'];
    $valor = $res[$i]['valor'];
    $ativo = $res[$i]['ativo'];
    

    $total_valorF = number_format($valor, 2, ',', '.');
    

    if($ativo == 'Sim'){
        $icone = 'fa-check-square';
        $titulo_link = 'Desativar Usuario';
        $acao = 'Não';
        $classe_ativo = '';
    }else{
        $icone = 'fa-square-o';
        $titulo_link = 'Ativar Usuario';
        $acao = 'Sim';
        $classe_ativo = '#c4c4c4';
    }



echo <<<HTML
    <tr style="color:{$classe_ativo}">
        <td>
            <input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
            {$nome}</td>
        <td class="esc">{$valor}</td>
        <td class="esc">{$tempo} Minutos</td>
        <td>
            <a href="#" onclick="editar('{$id}','{$nome}','{$valor}','{$tempo}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a>

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

            <big>
                <a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a>
            </big>

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
                var table = new DataTable('#tabela', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.1.2/i18n/pt-BR.json',
                }, "ordering": false, "stateSave": true
            });
            </script>

    <script>
        function editar (id, nome, valor, tempo){
            $('#mensagem').text('');
            $('#titulo_inserir').text('Editar Registro');

            $('#id').val(id);
            $('#nome').val(nome);
            $('#valor').val(valor);
            $('#tempo').val(tempo);
            

            $('#modalForm').modal('show');
        }
        

        function limparCampos(){
            $('#id').val('');
            $('#nome').val('');
            $('#valor').val('');
            $('#tempo').val('');


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


        function listarPermissoes (id){
            $.ajax({
            url: 'paginas/' + pag + "/listar_permissoes.php",
            method: 'POST',
            data: {id},
            dataType: "html",

            success:function(result){
                $("#listar_permissoes").html(result);
                $('#mensagem_permissao').text('');
        }
    });

        }


        
        
    </script>





