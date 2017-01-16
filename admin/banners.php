<?
	session_start();
	$_SESSION['pagina'] = 'banners';
    require_once('includes/topo.php');
    require_once('includes/imagem.php');

    $acao         = ((isset($_REQUEST['acao']))?$_REQUEST['acao']:'');
    $id           = ((isset($_REQUEST['id']))?$_REQUEST['id']:'');

    if(isset($_POST['btn-adicionar'])){

        if($_FILES['txtimagem']['name'] != ''){
            $imagem = SobeImagem($_FILES['txtimagem']['name'], $_FILES['txtimagem']['tmp_name'], 'uploads/banner/');
        }else{
            header('Location: banners.php?retorno=0');
            exit();
        } 
        $titulo = $_POST['txttitulo']; 
        $subtitulo = $_POST['txtsubtitulo']; 


        $add = mysqli_query($link, 'INSERT INTO baner (imagem, titulo, subtitulo) VALUES ("'.$imagem.'", "'.$titulo.'", "'.$subtitulo.'")');
        
        if($add){
            header('Location: banners.php?retorno=1');
            exit();
        }else{
            header('Location: banners.php?retorno=0');
            exit();
        }
    }
    if(isset($_POST['btn-atualizar'])){
        $titulo = $_POST['txttitulo']; 
        $subtitulo = $_POST['txtsubtitulo']; 

        if($_FILES['txtimagem']['name'] != ''){
            $imagem = SobeImagem($_FILES['txtimagem']['name'], $_FILES['txtimagem']['tmp_name'], 'uploads/banner/');
            $att = mysqli_query($link, 'UPDATE baner SET imagem = "'.$imagem.'", titulo = "'.$titulo.'", subtitulo = "'.$subtitulo.'" WHERE id = "'.$id.'" LIMIT 1');
            if($_POST['txtimagemantiga'] != ''){
                $remove = RemoveImagem($_POST['txtimagemantiga'], 'uploads/banner/');
            }
        }else{
            $att = mysqli_query($link, 'UPDATE baner SET titulo = "'.$titulo.'", subtitulo = "'.$subtitulo.'" WHERE id = "'.$id.'" LIMIT 1');              
        }

        if($att){
            header('Location: banners.php?retorno=1');
            exit();
        }else{
            header('Location: banners.php?retorno=0');
            exit();
        }
    }
    if($acao == 'editar'){
        $edd = mysqli_query($link, 'SELECT * FROM baner WHERE id = "'.$id.'" LIMIT 1');

        if(mysqli_num_rows($edd) > 0){
            $editar = mysqli_fetch_array($edd);
        }else{
            header('Location: banners.php?retorno=0');
            exit();   
        }
    }
    if($acao == 'deletar'){
        $sql_del = mysqli_query($link, 'SELECT * FROM baner WHERE id = "'.$id.'" LIMIT 1');
        $s_del = mysqli_fetch_array($sql_del);
        if($s_del['imagem'] != ''){
            $remove = RemoveImagem($s_del['imagem'], 'uploads/banner/');
        }

        $del = mysqli_query($link, 'DELETE FROM baner WHERE id = "'.$id.'" LIMIT 1');
        if($del){
            header('Location: banners.php?retorno=1');
            exit();  
        }else{
            header('Location: banners.php?retorno=0');
            exit();   
        }
    }
?>
<?
if($acao == ''){
?>
    <h1><u>Banners</u> <a href="banners.php?acao=novo" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a></h1><br>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?
                $sql_banner = mysqli_query($link, 'SELECT * FROM baner');
                while($banner = mysqli_fetch_array($sql_banner)){
                    echo '<tr>';
                    echo '<td><img src="uploads/banner/'.$banner['imagem'].'" style="width: 100px;"></td>';
                    echo '<td>'.$banner['titulo'].'</td>';
                    echo '<td>'.$banner['subtitulo'].'</td>';
                    echo '<td><a href="banners.php?acao=editar&id='.$banner['id'].'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="banners.php?acao=deletar&id='.$banner['id'].'" class="btn btn-danger btn-xs btnremover"><i class="fa fa-trash"></i></a></td>';
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
                <?=(($acao == 'novo')?'Novo Banner':$editar['titulo'])?>
            </h3>
        </div>
    </div>
    <!-- /.row -->

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label>Título</label>
                <input type="text" class="form-control" name="txttitulo" value="<?=(($acao == 'editar')?$editar['titulo']:'')?>">
            </div>
            <div class="col-md-6">
                <label>Subtítulo</label>
                <input type="text" class="form-control" name="txtsubtitulo" value="<?=(($acao == 'editar')?$editar['subtitulo']:'')?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label>Imagem</label>
                <input type="file" name="txtimagem" id="imgInp" class="form-control">
                <input type="text" name="txtimagemantiga" style="display: none;" value="<?=(($acao == 'editar')?$editar['imagem']:'')?>">
            </div>
            <div class="col-md-6">
                <label>Prévia</label><br>
                <?
                    if($acao == 'editar'){
                        if($editar['imagem'] != ''){
                            echo "<img id='previa' style='width: 100%' src='uploads/banner/".$editar['imagem']."'>";
                        }else{
                            echo "<img id='previa' src='' style='display: none; width: 100%'>";
                        }
                    }else{
                        echo "<img id='previa' src='' style='display: none; width: 100%'>";
                    }
                ?>
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
    