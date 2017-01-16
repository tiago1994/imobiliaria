<?
	session_start();
	$_SESSION['pagina'] = 'sistema';
    require_once('includes/topo.php');
    require_once('includes/imagem.php');

    $editar_sql = mysqli_query($link, 'SELECT * FROM loja WHERE id = "1" LIMIT 1');
    $editar = mysqli_fetch_array($editar_sql);

    if(isset($_POST['btn-atualizar'])){ 

        $nome = $_POST['txtnome'];
        $estado = $_POST['txtestado'];
        $cidade = $_POST['txtcidade'];
        $rua = $_POST['txtrua'];
        $numero = $_POST['txtnumero'];
        $complemento = $_POST['txtcomplemento'];
        $banner = $_POST['txtbanner'];
        $telefone = $_POST['txttelefone'];
        $celular = $_POST['txtcelular'];
        $bairro = $_POST['txtbairro'];
        $sobre = $_POST['txtsobre'];
        if($_FILES['txtlogo']['name'] != ''){
            $imagem = SobeImagem($_FILES['txtlogo']['name'], $_FILES['txtlogo']['tmp_name'], 'uploads/logo/');
            $att = mysqli_query($link, 'UPDATE loja SET nome = "'.$nome.'", estado = "'.$estado.'", cidade = "'.$cidade.'", rua = "'.$rua.'", numero = "'.$numero.'", complemento = "'.$complemento.'", baner = "'.$banner.'", logo = "'.$imagem.'", telefone = "'.$telefone.'", celular = "'.$celular.'", bairro = "'.$bairro.'", sobre = "'.$sobre.'" WHERE id="1" LIMIT 1');
            if($_POST['txtlogoantigo'] != ''){
                $remove = RemoveImagem($_POST['txtlogoantigo'], 'uploads/logo/');
            }

        }else{
            $att = mysqli_query($link, 'UPDATE loja SET nome = "'.$nome.'", estado = "'.$estado.'", cidade = "'.$cidade.'", rua = "'.$rua.'", numero = "'.$numero.'", complemento = "'.$complemento.'", baner = "'.$banner.'", telefone = "'.$telefone.'", celular = "'.$celular.'", bairro = "'.$bairro.'", sobre = "'.$sobre.'" WHERE id="1" LIMIT 1');
              
        }

        if($att){
            header('Location: sistema.php?retorno=1');
            exit();
        }else{
            header('Location: sistema.php?retorno=0');
            exit();
        }
    }
?>
    <h1><u>Dados do sistema</u></h1><br>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="txtnome" value="<?=$editar['nome']?>">
            </div>
            <div class="col-md-4">
                <label>Estado</label>
                <input type="text" class="form-control" name="txtestado" value="<?=$editar['estado']?>">
            </div>
            <div class="col-md-4">
                <label>Cidade</label>
                <input type="text" class="form-control" name="txtcidade" value="<?=$editar['cidade']?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label>Bairro</label>
                <input type="text" class="form-control" name="txtbairro" value="<?=$editar['bairro']?>">
            </div>
            <div class="col-md-3">
                <label>Rua</label>
                <input type="text" class="form-control" name="txtrua" value="<?=$editar['rua']?>">
            </div>
            <div class="col-md-1">
                <label>Numero</label>
                <input type="text" class="form-control" name="txtnumero" value="<?=$editar['numero']?>">
            </div>
            <div class="col-md-2">
                <label>Complemento</label>
                <input type="text" class="form-control" name="txtcomplemento" value="<?=$editar['complemento']?>">
            </div>
            <div class="col-md-3">
                <label>Banner</label>
                <select class="form-control" name="txtbanner">
                    <option value="1" <?=(($editar['baner'] == '1')?'selected = "selected"':'')?>>Sim</option>
                    <option value="0" <?=(($editar['baner'] == '0')?'selected = "selected"':'')?>>Não</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label>Telefone</label>
                <input type="text" class="form-control" name="txttelefone" value="<?=$editar['telefone']?>">
            </div>
            <div class="col-md-3">
                <label>Celular</label>
                <input type="text" class="form-control" name="txtcelular" value="<?=$editar['celular']?>">
            </div>
            <div class="col-md-6">
                <label>Logo</label>
                <input type="file" class="form-control" name="txtlogo">
                <input type="text" class="form-control" name="txtlogoantigo" style="display: none;" value="<?=$editar['logo']?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label>Sobre</label>
                <textarea class="form-control" rows="3" name="txtsobre"><?=$editar['sobre']?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-success pull-right" name="btn-atualizar" value="Atualizar">
            </div>
        </div>
        <!-- /.row -->
    </form>
<?
    require_once('includes/rodape.php');
?>      
    