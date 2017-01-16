<?
	session_start();
	$_SESSION['pagina'] = 'cidade';
    require_once('includes/topo.php');
    require_once('includes/imagem.php');

    $acao         = ((isset($_REQUEST['acao']))?$_REQUEST['acao']:'');
    $id           = ((isset($_REQUEST['id']))?$_REQUEST['id']:'');

    if(isset($_POST['btn-adicionar'])){

        $nome                   = $_POST['txtnome'];  
        $estado                 = $_POST['txtestado'];  

        $add = mysqli_query($link, 'INSERT INTO cidade (nome, estado) VALUES ("'.$nome.'", "'.$estado.'")');
        
        if($add){
            header('Location: cidade.php?retorno=1');
            exit();
        }else{
            header('Location: cidade.php?retorno=0');
            exit();
        }
    }
    if(isset($_POST['btn-atualizar'])){
        $nome                   = $_POST['txtnome'];  
        $estado                 = $_POST['txtestado'];  

        $att = mysqli_query($link, 'UPDATE cidade SET nome = "'.$nome.'", estado = "'.$estado.'" WHERE id = "'.$id.'" LIMIT 1');              

        if($att){
            header('Location: cidade.php?retorno=1');
            exit();
        }else{
            header('Location: cidade.php?retorno=0');
            exit();
        }
    }
    if($acao == 'editar'){
        $edd = mysqli_query($link, 'SELECT * FROM cidade WHERE id = "'.$id.'" LIMIT 1');

        if(mysqli_num_rows($edd) > 0){
            $editar = mysqli_fetch_array($edd);
        }else{
            header('Location: cidade.php?retorno=0');
            exit();   
        }
    }
    if($acao == 'deletar'){
        $del = mysqli_query($link, 'DELETE FROM cidade WHERE id = "'.$id.'" LIMIT 1');
        if($del){
            header('Location: cidade.php?retorno=1');
            exit();  
        }else{
            header('Location: cidade.php?retorno=0');
            exit();   
        }
    }
?>
<?
if($acao == ''){
?>
    <h1><u>Cidades</u> <a href="cidade.php?acao=novo" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a></h1><br>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th style="width: 100px;">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?
                $sql_cidade = mysqli_query($link, 'SELECT * FROM cidade');
                while($cidade = mysqli_fetch_array($sql_cidade)){
                    echo '<tr>';
                    echo '<td>'.$cidade['nome'].'</td>';
                    echo '<td><a href="cidade.php?acao=editar&id='.$cidade['id'].'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="cidade.php?acao=deletar&id='.$cidade['id'].'" class="btn btn-danger btn-xs btnremover"><i class="fa fa-trash"></i></a></td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
    <!-- modal delete -->
    <div class="modal fade confirmaexclusao" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content text-center" style="padding:15px;">
                <h2 class="text-danger">Deseja realmente remover?</h2>
                <a href="javascript: void();" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</a>
                <a href="#" class="btn btn-danger btn-lg" id="btnconexclusao">Confirmar</a>
            </div>
        </div>
    </div>
<?
}
if($acao == 'editar' or $acao == 'novo'){
?>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">    
                <?=(($acao == 'novo')?'Novo Cidade':'Editar Cidade')?>
            </h3>
        </div>
    </div>
    <!-- /.row -->

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label>Nome</label>
                <input type="text" class="form-control" name="txtnome" value="<?=(($acao == 'editar')?$editar['nome']:'')?>" placeholder="Digite o nome.">
            </div>
            <div class="col-md-6">
                <label>Estado</label>
                <select class="form-control" name="txtestado">
                    <option value="" <?=(($acao == 'editar')?(($editar['estado'] == '')?'selected = "selected"':''):'')?>>Selecione</option>
                    <option value="AC" <?=(($acao == 'editar')?(($editar['estado'] == 'AC')?'selected = "selected"':''):'')?>>Acre</option>
                    <option value="AL" <?=(($acao == 'editar')?(($editar['estado'] == 'AL')?'selected = "selected"':''):'')?>>Alagoas</option>
                    <option value="AP" <?=(($acao == 'editar')?(($editar['estado'] == 'AP')?'selected = "selected"':''):'')?>>Amapá</option>
                    <option value="AM" <?=(($acao == 'editar')?(($editar['estado'] == 'AM')?'selected = "selected"':''):'')?>>Amazonas</option>
                    <option value="BA" <?=(($acao == 'editar')?(($editar['estado'] == 'BA')?'selected = "selected"':''):'')?>>Bahia</option>
                    <option value="CE" <?=(($acao == 'editar')?(($editar['estado'] == 'CE')?'selected = "selected"':''):'')?>>Ceará</option>
                    <option value="DF" <?=(($acao == 'editar')?(($editar['estado'] == 'DF')?'selected = "selected"':''):'')?>>Distrito Federal</option>
                    <option value="ES" <?=(($acao == 'editar')?(($editar['estado'] == 'ES')?'selected = "selected"':''):'')?>>Espirito Santo</option>
                    <option value="GO" <?=(($acao == 'editar')?(($editar['estado'] == 'GO')?'selected = "selected"':''):'')?>>Goiás</option>
                    <option value="MA" <?=(($acao == 'editar')?(($editar['estado'] == 'MA')?'selected = "selected"':''):'')?>>Maranhão</option>
                    <option value="MS" <?=(($acao == 'editar')?(($editar['estado'] == 'MS')?'selected = "selected"':''):'')?>>Mato Grosso do Sul</option>
                    <option value="MT" <?=(($acao == 'editar')?(($editar['estado'] == 'MT')?'selected = "selected"':''):'')?>>Mato Grosso</option>
                    <option value="MG" <?=(($acao == 'editar')?(($editar['estado'] == 'MG')?'selected = "selected"':''):'')?>>Minas Gerais</option>
                    <option value="PA" <?=(($acao == 'editar')?(($editar['estado'] == 'PA')?'selected = "selected"':''):'')?>>Pará</option>
                    <option value="PB" <?=(($acao == 'editar')?(($editar['estado'] == 'PB')?'selected = "selected"':''):'')?>>Paraíba</option>
                    <option value="PR" <?=(($acao == 'editar')?(($editar['estado'] == 'PR')?'selected = "selected"':''):'')?>>Paraná</option>
                    <option value="PE" <?=(($acao == 'editar')?(($editar['estado'] == 'PE')?'selected = "selected"':''):'')?>>Pernambuco</option>
                    <option value="PI" <?=(($acao == 'editar')?(($editar['estado'] == 'PI')?'selected = "selected"':''):'')?>>Piauí</option>
                    <option value="RJ" <?=(($acao == 'editar')?(($editar['estado'] == 'RJ')?'selected = "selected"':''):'')?>>Rio de Janeiro</option>
                    <option value="RN" <?=(($acao == 'editar')?(($editar['estado'] == 'RN')?'selected = "selected"':''):'')?>>Rio Grande do Norte</option>
                    <option value="RS" <?=(($acao == 'editar')?(($editar['estado'] == 'RS')?'selected = "selected"':''):'')?>>Rio Grande do Sul</option>
                    <option value="RO" <?=(($acao == 'editar')?(($editar['estado'] == 'RO')?'selected = "selected"':''):'')?>>Rondônia</option>
                    <option value="RR" <?=(($acao == 'editar')?(($editar['estado'] == 'RR')?'selected = "selected"':''):'')?>>Roraima</option>
                    <option value="SC" <?=(($acao == 'editar')?(($editar['estado'] == 'SC')?'selected = "selected"':''):'')?>>Santa Catarina</option>
                    <option value="SP" <?=(($acao == 'editar')?(($editar['estado'] == 'SP')?'selected = "selected"':''):'')?>>São Paulo</option>
                    <option value="SE" <?=(($acao == 'editar')?(($editar['estado'] == 'SE')?'selected = "selected"':''):'')?>>Sergipe</option>
                    <option value="TO" <?=(($acao == 'editar')?(($editar['estado'] == 'TO')?'selected = "selected"':''):'')?>>Tocantins</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-success pull-right" name="<?=(($acao == 'novo')?'btn-adicionar':'btn-atualizar')?>" value="<?=(($acao == 'novo')?'Adicionar':'Salvar')?>">
            </div>
        </div>
        <!-- /.row -->
    </form>
    <br>
<?
}
?>
<?
    require_once('includes/rodape.php');
?>      
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#previa').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function(){
        $("#previa").show();
        readURL(this);
    });
</script>
    