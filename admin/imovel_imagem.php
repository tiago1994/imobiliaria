<?
	session_start();
	$_SESSION['pagina'] = 'imovel';
    require_once('includes/topo.php');
    require_once('includes/imagem.php');

    $acao   		= ((isset($_REQUEST['acao']))?$_REQUEST['acao']:'');
    $id     		= ((isset($_REQUEST['id']))?$_REQUEST['id']:'');
    $id_imovel      = ((isset($_REQUEST['id_imovel']))?$_REQUEST['id_imovel']:'');

    if(isset($_POST['btn-adicionar'])){
        $id_imovel = $_POST['txtidimovel'];

        #Indice de identificacao da ordem de tratamento do arquivos no servidor
        $i = 0;
         
        #Analisa cada arquivo
        foreach ($_FILES["txtimagem"]["error"] as $key => $error) {
           
            $imagem = ''; 
            $imagem = SobeImagem($_FILES['txtimagem']['name'][$i], $_FILES['txtimagem']['tmp_name'][$i], 'uploads/imovel/');           
            $add = mysqli_query($link, 'INSERT INTO imovel_imagem (id_imovel, imagem) VALUES ("'.$id_imovel.'", "'.$imagem.'")');
            #Próximo arquivo a ser analisado
            $i++;
        }

        if($add){
        	header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=1');
            exit();
        }else{
        	header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=0');
            exit();
        }
    }
    if(isset($_POST['btn-atualizar'])){
        $sql_inf = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id = "'.$id.'" LIMIT 1');
        $inf = mysqli_fetch_array($sql_inf);

        $id_imovel = $inf['id_imovel'];
        if($_FILES['txtimagem']['name'] != ''){
            $imagem = SobeImagem($_FILES['txtimagem']['name'], $_FILES['txtimagem']['tmp_name'], 'uploads/imovel/');
            $att = mysqli_query($link, 'UPDATE imovel_imagem SET imagem = "'.$imagem.'" WHERE id = "'.$id.'" LIMIT 1');
            if($_POST['txtimagemantiga'] != ''){
                $remove = RemoveImagem($_POST['txtimagemantiga'], 'uploads/imovel/');
            }
        }else{
            header('Location: imovel.php?retorno=0');
            exit();
        } 


        if($att){
        	header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=1');
            exit();
        }else{
        	header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=0');
            exit();
        }
    }
    if($acao == 'editar'){
        $edd = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id = "'.$id.'" LIMIT 1');
        
        if(mysqli_num_rows($edd) > 0){
            $editar = mysqli_fetch_array($edd);
        }else{
            header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=0');
            exit();   
        }
    }
    if($acao == 'deletar'){
        $sql_del = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id = "'.$id.'" LIMIT 1');
        $s_del = mysqli_fetch_array($sql_del);
        $id_imovel = $s_del['id_imovel']; 
        if($s_del['imagem'] != ''){
            $remove = RemoveImagem($s_del['imagem'], 'uploads/imovel/');
        }
        $del = mysqli_query($link, 'DELETE FROM imovel_imagem WHERE id = "'.$id.'" LIMIT 1');

        if($del){
        	header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=1');
            exit();  
        }else{
        	header('Location: imovel_imagem.php?id_imovel='.$id_imovel.'&retorno=0');
            exit();   
        }
    }
?>
<?
if($acao == ''){
?>  
    <?
        $imovel = mysqli_query($link, 'SELECT * FROM imovel WHERE id = "'.$id_imovel.'" LIMIT 1');
        $v = mysqli_fetch_array($imovel);
    ?>
    <br>
    <a href="imovel.php" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Voltar</a>
    <a href="imovel_imagem.php?acao=novo&id_imovel=<?=$id_imovel?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a>
    <br>
    <br>
    <h1><u>Fotos - <?=$v['nome']?></u></h1><br>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Imagem</th>
            	<th style="width: 60px;">Opções</th>
            </tr>
        </thead>
        <tbody>
        	<?
        		$sql_midia_foto = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id_imovel = "'.$id_imovel.'"');
        		while($imovel_imagems = mysqli_fetch_array($sql_midia_foto)){
        			echo '<tr>';
                    echo '<td><img src="uploads/imovel/'.$imovel_imagems['imagem'].'" style="width: 100px;"></td>';
        			echo '<td><a href="imovel_imagem.php?acao=editar&id='.$imovel_imagems['id'].'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="imovel_imagem.php?acao=deletar&id='.$imovel_imagems['id'].'" class="btn btn-danger btn-xs btnremover"><i class="fa fa-trash"></i></a></td>';
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
                <?=(($acao == 'novo')?'Nova Foto':'Editar Foto')?>
            </h3>
        </div>
    </div>
    <!-- /.row -->

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label>Imagem</label>
                <input type="text" name="txtidimovel" class="form-control" value="<?=$id_imovel?>" style="display: none;">
                <input type="file" name="<?=(($acao == 'editar')?'txtimagem':'txtimagem[]')?>" id="imgInp" class="form-control" <?=(($acao == 'editar')?'':'multiple')?>>
                <input type="text" name="txtimagemantiga" style="display: none;" value="<?=(($acao == 'editar')?$editar['imagem']:'')?>">
            </div>
            <?
                if($acao == 'editar'){
            ?>
            <div class="col-md-6">
                <label>Prévia</label><br>
                <?
                    if($acao == 'editar'){
                        if($editar['imagem'] != ''){
                            echo "<img id='previa' src='uploads/imovel/".$editar['imagem']."' style='width: 100%'>";
                        }else{
                            echo "<img id='previa' src='' style='display: none; width: 100%''>";
                        }
                    }else{
                    	echo "<img id='previa' src='' style='display: none; width: 100%'>";
                    }
                ?>
            </div>
            <?
                }
            ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="imovel_imagem.php?id_imovel=<?=(($acao == 'editar')?$editar['id_imovel']:$id_imovel)?>" class="btn btn-default btn-left"><i class="fa fa-arrow-left"></i> Voltar</a>
                <input type="submit" class="btn btn-success pull-right" name="<?=(($acao == 'novo')?'btn-adicionar':'btn-atualizar')?>" value="<?=(($acao == 'novo')?'Adicionar':'Salvar')?>">
            </div>
        </div>
        <!-- /.row -->
    </form>
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
    