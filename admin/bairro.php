<?
	session_start();
	$_SESSION['pagina'] = 'bairro';
    require_once('includes/topo.php');
    require_once('includes/imagem.php');

    $acao         = ((isset($_REQUEST['acao']))?$_REQUEST['acao']:'');
    $id           = ((isset($_REQUEST['id']))?$_REQUEST['id']:'');

    if(isset($_POST['btn-adicionar'])){

        $nome                   = $_POST['txtnome'];  
        $cidade                 = $_POST['txtcidade'];  

        $add = mysqli_query($link, 'INSERT INTO bairro (nome, id_cidade) VALUES ("'.$nome.'", "'.$cidade.'")');
        
        if($add){
            header('Location: bairro.php?retorno=1');
            exit();
        }else{
            header('Location: bairro.php?retorno=0');
            exit();
        }
    }
    if(isset($_POST['btn-atualizar'])){
        $nome                   = $_POST['txtnome'];  
        $cidade                 = $_POST['txtcidade'];  

        $att = mysqli_query($link, 'UPDATE bairro SET nome = "'.$nome.'", id_cidade = "'.$cidade.'" WHERE id = "'.$id.'" LIMIT 1');              

        if($att){
            header('Location: bairro.php?retorno=1');
            exit();
        }else{
            header('Location: bairro.php?retorno=0');
            exit();
        }
    }
    if($acao == 'editar'){
        $edd = mysqli_query($link, 'SELECT * FROM bairro WHERE id = "'.$id.'" LIMIT 1');

        if(mysqli_num_rows($edd) > 0){
            $editar = mysqli_fetch_array($edd);
        }else{
            header('Location: bairro.php?retorno=0');
            exit();   
        }
    }
    if($acao == 'deletar'){
        $del = mysqli_query($link, 'DELETE FROM bairro WHERE id = "'.$id.'" LIMIT 1');
        if($del){
            header('Location: bairro.php?retorno=1');
            exit();  
        }else{
            header('Location: bairro.php?retorno=0');
            exit();   
        }
    }
?>
<?
if($acao == ''){
?>
    <h1><u>Bairro</u> <a href="bairro.php?acao=novo" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a></h1><br>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th style="width: 100px;">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?
                $sql_bairro = mysqli_query($link, 'SELECT * FROM bairro');
                while($bairro = mysqli_fetch_array($sql_bairro)){
                    echo '<tr>';
                    echo '<td>'.$bairro['nome'].'</td>';
                    echo '<td><a href="bairro.php?acao=editar&id='.$bairro['id'].'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="bairro.php?acao=deletar&id='.$bairro['id'].'" class="btn btn-danger btn-xs btnremover"><i class="fa fa-trash"></i></a></td>';
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
                <?=(($acao == 'novo')?'Novo bairro':'Editar bairro')?>
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
                <label>Cidade</label>
                <select class="form-control" name="txtcidade">
                    <?
                        $sql_cidade = mysqli_query($link, 'SELECT * FROM cidade');
                        while($c = mysqli_fetch_array($sql_cidade)){
                            echo '<option value="'.$c['id'].'" value="'.(($acao == 'editar')?(($editar['id_cidade'] == $c['id'])?'selected = "selected"':''):'').'">'.$c['nome'].'</option>';
                        }
                    ?>
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
    