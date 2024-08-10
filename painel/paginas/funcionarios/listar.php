<?php

$tabela = 'usuarios';
require_once("../../../conexao.php");
$query = $pdo->query("SELECT * FROM $tabela order by id desc");
$res = $query->fetchall(PDO::FETCH_ASSOC);
$linhas = @count($res);
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
        $cpf = $res[$i]['cpf'];
        $intervalo = $res[$i]['intervalo'];

        $data_formatada = implode('/', array_reverse(@explode('-', $data)));

        if ($ativo == 'Sim') {
            $icone = 'fa-check-square';
            $titulo_link = 'Desativar Usuario';
            $acao = 'Não';
            $classe_ativo = '';
        } else {
            $icone = 'fa-square-o';
            $titulo_link = 'Ativar Usuario';
            $acao = 'Sim';
            $classe_ativo = '#c4c4c4';
        }

        if ($nivel == 'Administrador' and $atendimento != 'Sim') {
            continue;
        }

        $mostrar_func = '';

        if ($atendimento != 'Sim') {
            $mostrar_func = 'ocultar';
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
        <td class="iconestabela">
        <big>
            <a href="#" onclick="editar('{$id}','{$nome}','{$email}','{$telefone}','{$endereco}','{$nivel}','{$atendimento}','{$pagamento}','{$comissao}','{$cpf}','{$intervalo}')" title="Editar Dados"><i class="fa-regular fa-pen-to-square text-primary"></i></a>
        </big>   

            <li class="dropdown head-dpdn2" style="display: inline-block;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"title="Deletar Funcionario"></i></big></a>

                <ul class="dropdown-menu" style="margin-left:-230px;">
                    <li>
                        <div class="notification_desc2">
                        <p>Tem certeza que deseja excluir? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                        </div>
                    </li>										
                </ul>
            </li>
            <big>
                <a href="#" onclick="mostrar('{$nome}','{$email}','{$telefone}','{$endereco}','{$ativo}','{$data_formatada}', '{$nivel}', '{$atendimento}', '{$comissao}','{$pagamento}','{$cpf}','{$foto}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a>
            </big>

            <big>
                <a class="{$mostrar_func}" href="#" onclick="procedimentos('{$id}', '{$nome}')" title="Inserir Procedimentos"><i class="fa-solid fa-stethoscope text-sucess"></i></a>
            </big>
            <big>
                <a class="{$mostrar_func}" href="#" onclick="horarios('{$id}', '{$nome}')" title="Inserir Horarios"><i class="fa-regular fa-clock "></i></a>
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


<script>
    function editar(id, nome, email, telefone, endereco, nivel, atendimento, pagamento, comissao, cpf, intervalo) {
        $('#mensagem').text('');
        $('#titulo_inserir').text('Editar Registro');

        $('#id').val(id);
        $('#nome').val(nome);
        $('#email').val(email);
        $('#telefone').val(telefone);
        $('#endereco').val(endereco);
        $('#nivel').val(nivel).change();
        $('#atendimento').val(atendimento).change();
        $('#comissao').val(comissao);
        $('#pagamento').val(pagamento);
        $('#cpf').val(cpf);
        $('#intervalo').val(intervalo);


        $('#modalForm').modal('show');
    }

    function mostrar(nome, email, telefone, endereco, ativo, data, nivel, atendimento, comissao, pagamento, cpf, foto) {
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
        $('#cpf_dados').text(cpf);
        $('#foto_dados').attr("src", "images/perfil/" + foto);



        $('#modalDados').modal('show');


    }

    function limparCampos() {
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

        if ($('#seletor-' + id).is(":checked") == true) {
            var novo_id = ids + id + '-';
            $('#ids').val(novo_id);
        } else {
            var retirar = ids.replace(id + '-', '');
            $('#ids').val(retirar);
        }

        var ids_final = $('#ids').val();

        if (ids_final != "") {
            $('#btn-deletar').show();
        } else {
            $('#btn-deletar').hide();
        }

    }


    function excluirSel(id) {
        var ids = $('#ids').val();
        var id = ids.split("-");
        for (i = 0; i < id.length - 1; i++) {
            excluir(id[i])
        }

        limparCampos();
    }

    function procedimentos(id, nome) {
        $('#id_procedimento').val(id);
        $('#nome_procedimento').text(nome);




        $('#modalProcedimentos').modal('show');
        listarProcedimentos(id);


    }

    function horarios(id, nome) {
        $('#id_dias').val(id);
        $('#nome_horario').text(nome);




        $('#modalHorarios').modal('show');
        listarDias(id);


    }
</script>




<script type="text/javascript">
    var table = new DataTable('#tabela', {
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.2/i18n/pt-BR.json',
        },
        "ordering": false,
        "stateSave": true
    });
</script>