<?php

$tabela = 'usuarios';
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
	<th class="esc">Telefone</th>	
	<th class="esc">Email</th>	
	<th class="esc">Nivel / Cargo</th>	
	<th class="esc">Atendimento</th>	
	<th style="text-align: left" class="esc">Comissão</th>	
	<th class="esc">Foto</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for ($i = 0; $i < $linhas; $i++) {
    $id = $res[$i]['id'];
    $nome = $res[$i]['nome'];
    $email = $res[$i]['email'];
    $telefone = $res[$i]['telefone'];
    $nivel = $res[$i]['nivel'];
    $foto = $res[$i]['foto'];
    $endereco = $res[$i]['endereco'];
    $ativo = $res[$i]['ativo'];
    $data = $res[$i]['data'];
    $atendimento = $res[$i]['atendimento'];
    $comissao = $res[$i]['comissao'];
    $pagamento = $res[$i]['pagamento'];

    $data_formatada = implode('/', array_reverse(@explode('-', $data)));

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

    $mostrar_adm = "";
    if($nivel == 'Administrador'){
        $senha = '*********';
        $mostrar_adm = "ocultar";

    }

echo <<<HTML
    <tr style="color:{$classe_ativo}">
        <td>
            <input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
            {$nome}</td>
        <td class="esc">{$telefone}</td>
        <td class="esc">{$email}</td>
        <td class="esc">{$nivel}</td>
        <td class="esc">{$atendimento}</td>
        <td style="text-align: left" class="esc">{$comissao}%</td>
        <td class="esc"><img src="images/perfil/{$foto}" width="20px" alt="Foto"></td>
        <td>
        <big>
            <a href="#" onclick="editar('{$id}','{$nome}','{$email}','{$telefone}','{$endereco}','{$nivel}','{$atendimento}','{$pagamento}','{$comissao}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a>
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
            <big>
                <a href="#" onclick="mostrar('{$nome}','{$email}','{$telefone}','{$endereco}','{$ativo}','{$data_formatada}', '{$senha}', '{$nivel}', '{$foto}','{$atendimento}','{$pagamento}','{$comissao}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a>
            </big>


            <big>
                <a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a>
            </big>

            <big>
                <a class="{$mostrar_adm}" href="#" onclick="permissoes('{$id}', '{$nome}')" title="Dar Permissões"><i class="fa-solid fa-lock text-primary"></i></a>
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
        function editar (id, nome, email, telefone,  endereco, grupo, atendimento, pagamento, comissao){
            $('#mensagem').text('');
            $('#titulo_inserir').text('Editar Registro');

            $('#id').val(id);
            $('#nome').val(nome);
            $('#email').val(email);
            $('#telefone').val(telefone);
            $('#endereco').val(endereco);
            $('#grupo').val(grupo).change();
            $('#atendimento').val(atendimento).change();
            $('#comissao').val(comissao);
            $('#pagamento').val(pagamento);
            

            $('#modalForm').modal('show');
        }
        function mostrar (nome, email, telefone, endereco, ativo, data, senha, nivel, foto, atendimento, pagamento, comissao){
            $('#titulo_dados').text(nome);
            $('#email_dados').text(email);
            $('#telefone_dados').text(telefone);
            $('#endereco_dados').text(endereco);
            $('#ativo_dados').text(ativo);
            $('#data_dados').text(data);
            $('#nivel_dados').text(nivel);
            $('#atendimento_dados').text(atendimento);
            $('#comissao_dados').text(comissao + '%');
            $('#pagamento_dados').text(pagamento);
            $('#foto_dados').attr("src", "images/perfil/" + foto);

            

            $('#modalDados').modal('show');


        }

        function limparCampos(){
            $('#id').val('');
            $('#nome').val('');
            $('#email').val('');
            $('#telefone').val('');
            $('#endereco').val('');
            $('#atendimento').val('Não').change();
            $('#comissao').val('');
            $('#pagamento').val('');


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

        function permissoes (id, nome){
            $('#id_permissoes').val(id);
            $('#nome_permissoes').text(nome);
   

            

            $('#modalPermissoes').modal('show');
            listarPermissoes(id);


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





