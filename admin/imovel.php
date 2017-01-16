<?
	session_start();
	$_SESSION['pagina'] = 'imovel';
    require_once('includes/topo.php');
    require_once('includes/imagem.php');

    $acao   = ((isset($_REQUEST['acao']))?$_REQUEST['acao']:'');
    $id     = ((isset($_REQUEST['id']))?$_REQUEST['id']:'');
    if(isset($_POST['btn-adicionar'])){
        $codigo                     = rand(111111, 999999);
        $id_cidade                  = $_POST['txtid_cidade'];
        $id_bairro                  = $_POST['txtid_bairro'];
        $id_tipo_imovel             = $_POST['txtid_tipo_imovel'];
        $id_tipo_negocio            = $_POST['txtid_tipo_negocio'];
        $nome                       = $_POST['txtnome'];
        $quartos                    = $_POST['txtquartos'];
        $banheiros                  = $_POST['txtbanheiros'];
        $garagens                   = $_POST['txtgaragens'];
        $area                       = $_POST['txtarea'];
        $valor                      = str_replace('.', '', $_POST['txtvalor']);
        $valor                      = str_replace(',', '.', $valor);
        $endereco                   = $_POST['txtendereco'];
        $valor_iptu                 = str_replace('.', '', $_POST['txtvalor_iptu']);
        $valor_iptu                 = str_replace(',', '.', $valor_iptu);
        $mapa                       = $_POST['txtmapa'];
        $ativo                      = $_POST['txtativo'];

        $add = mysqli_query($link, 'INSERT INTO imovel (codigo, id_cidade, id_bairro, id_tipo_imovel, id_tipo_negocio, nome, quartos, banheiros, garagens, area, valor, endereco, valor_iptu, mapa, ativo) VALUES ("'.$codigo.'", "'.$id_cidade.'", "'.$id_bairro.'", "'.$id_tipo_imovel.'", "'.$id_tipo_negocio.'", "'.$nome.'", "'.$quartos.'", "'.$banheiros.'", "'.$garagens.'", "'.$area.'", "'.$valor.'", "'.$endereco.'", "'.$valor_iptu.'", "'.$mapa.'", "'.$ativo.'")');
        if($add){
            header('Location: imovel.php?retorno=1');
            exit();
        }else{
            header('Location: imovel.php?retorno=0');
            exit();
        }
    }
    if(isset($_POST['btn-atualizar'])){
        $id_cidade                  = $_POST['txtid_cidade'];
        $id_bairro                  = $_POST['txtid_bairro'];
        $id_tipo_imovel             = $_POST['txtid_tipo_imovel'];
        $id_tipo_negocio            = $_POST['txtid_tipo_negocio'];
        $nome                       = $_POST['txtnome'];
        $quartos                    = $_POST['txtquartos'];
        $banheiros                  = $_POST['txtbanheiros'];
        $garagens                   = $_POST['txtgaragens'];
        $area                       = $_POST['txtarea'];
        $valor                      = str_replace('.', '', $_POST['txtvalor']);
        $valor                      = str_replace(',', '.', $valor);
        $endereco                   = $_POST['txtendereco'];
        $valor_iptu                 = str_replace('.', '', $_POST['txtvalor_iptu']);
        $valor_iptu                 = str_replace(',', '.', $valor_iptu);
        $mapa                       = $_POST['txtmapa'];
        $ativo                      = $_POST['txtativo'];

        $att = mysqli_query($link, 'UPDATE imovel SET id_cidade = "'.$id_cidade.'", id_bairro = "'.$id_bairro.'", id_tipo_imovel = "'.$id_tipo_imovel.'", id_tipo_negocio = "'.$id_tipo_negocio.'", nome = "'.$nome.'", quartos = "'.$quartos.'", banheiros = "'.$banheiros.'", garagens = "'.$garagens.'", area = "'.$area.'", valor = "'.$valor.'", endereco = "'.$endereco.'", valor_iptu = "'.$valor_iptu.'", mapa = "'.$mapa.'", ativo = "'.$ativo.'" WHERE id = "'.$id.'" LIMIT 1');

        if($att){
            header('Location: imovel.php?retorno=1');
            exit();
        }else{
            header('Location: imovel.php?retorno=0');
            exit();
        }
    }
    if($acao == 'editar'){
        $edd = mysqli_query($link, 'SELECT * FROM imovel WHERE id = "'.$id.'" LIMIT 1');
        
        if(mysqli_num_rows($edd) > 0){
            $editar = mysqli_fetch_array($edd);
        }else{
            header('Location: imovel.php?retorno=0');
            exit();   
        }
    }
    if($acao == 'deletar'){
        $sql_del = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id_imovel = "'.$id.'"');
        while($deleta_fotos = mysqli_fetch_array($sql_del)){
            $remove = RemoveImagem($deleta_fotos['imagem'], 'uploads/imovel/');
            $sql_deleta = mysqli_query($link, 'DELETE FROM imovel_imagem WHERE id = "'.$deleta_fotos['id'].'" LIMIT 1');
        }

        $del = mysqli_query($link, 'DELETE FROM imovel WHERE id = "'.$id.'" LIMIT 1');

        if($del){
            header('Location: imovel.php?retorno=1');
            exit();  
        }else{
            header('Location: imovel.php?retorno=0');
            exit();   
        }
    }
?>
<?
if($acao == ''){
?>
    <h1><u>Imóveis</u> <a href="imovel.php?acao=novo" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a></h1><br>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Bairro</th>
            	<th>Opções</th>
            </tr>
        </thead>
        <tbody>
        	<?
        		$sql_imovel = mysqli_query($link, 'SELECT * FROM imovel');
        		while($imovel = mysqli_fetch_array($sql_imovel)){
                    $slq_cit            = mysqli_query($link, 'SELECT * FROM cidade WHERE id = "'.$imovel['id_cidade'].'" LIMIT 1');
                    $cit                = mysqli_fetch_array($slq_cit);
                    $slq_bai            = mysqli_query($link, 'SELECT * FROM bairro WHERE id = "'.$imovel['id_bairro'].'" LIMIT 1');
                    $bai                = mysqli_fetch_array($slq_bai);
        			echo '<tr>';
                    echo '<td>'.$imovel['codigo'].'</td>';
                    echo '<td>'.$imovel['nome'].'</td>';
                    echo '<td>'.$cit['nome'].'</td>';
                    echo '<td>'.$bai['nome'].'</td>';
        			echo '<td><a href="imovel.php?acao=editar&id='.$imovel['id'].'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="imovel.php?acao=deletar&id='.$imovel['id'].'" class="btn btn-danger btn-xs btnremover"><i class="fa fa-trash"></i></a> <a href="imovel_imagem.php?id_imovel='.$imovel['id'].'" class="btn btn-info btn-xs"><i class="fa fa-picture-o"></i></a></td>';
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
                <?=(($acao == 'novo')?'Novo Imóvel':'Editar Imóvel')?>
            </h3>
        </div>
    </div>
    <!-- /.row -->
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-3">
                <label>Cidade</label>
                <select class="form-control" name="txtid_cidade">
                    <?
                        $sql_cidade = mysqli_query($link, 'SELECT * FROM cidade');
                        while($cidade = mysqli_fetch_array($sql_cidade)){
                            echo'<option value="'.$cidade['id'].'" '.(($acao == 'editar')?(($editar['id_cidade'] == $cidade['id'])?'selected = "selected"':''):'').'>'.$cidade['nome'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Bairro</label>
                <select class="form-control" name="txtid_bairro">
                <?
                    $sql_bairro = mysqli_query($link, 'SELECT * FROM bairro');
                    while($bairro = mysqli_fetch_array($sql_bairro)){
                        echo'<option value="'.$bairro['id'].'" '.(($acao == 'editar')?(($editar['id_bairro'] == $bairro['id'])?'selected = "selected"':''):'').'>'.$bairro['nome'].'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Tipo Imóvel</label>
                <select class="form-control" name="txtid_tipo_imovel">
                <?
                    $sql_tipo = mysqli_query($link, 'SELECT * FROM tipo_imovel');
                    while($tipo_imovel = mysqli_fetch_array($sql_tipo)){
                        echo'<option value="'.$tipo_imovel['id'].'" '.(($acao == 'editar')?(($editar['id_tipo_imovel'] == $tipo_imovel['id'])?'selected = "selected"':''):'').'>'.$tipo_imovel['nome'].'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Tipo Negócio</label>
                <select class="form-control" name="txtid_tipo_negocio">
                <?
                    $sql_negocio = mysqli_query($link, 'SELECT * FROM tipo_negocio');
                    while($tipo_negocio = mysqli_fetch_array($sql_negocio)){
                        echo'<option value="'.$tipo_negocio['id'].'" '.(($acao == 'editar')?(($editar['id_tipo_negocio'] == $tipo_negocio['id'])?'selected = "selected"':''):'').'>'.$tipo_negocio['nome'].'</option>';
                    }
                ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label>Nome</label>
                <input type="text" class="form-control" name="txtnome" value="<?=(($acao == 'editar')?$editar['nome']:'')?>">
            </div>
            <div class="col-md-2">
                <label>Quartos</label>
                <input type="text" class="form-control" name="txtquartos" value="<?=(($acao == 'editar')?$editar['quartos']:'')?>">
            </div>
            <div class="col-md-2">
                <label>Banheiros</label>
                <input type="text" class="form-control" name="txtbanheiros" value="<?=(($acao == 'editar')?$editar['banheiros']:'')?>">
            </div>
            <div class="col-md-2">
                <label>Garagens</label>
                <input type="text" class="form-control" name="txtgaragens" value="<?=(($acao == 'editar')?$editar['garagens']:'')?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label>Área</label>
                <input type="text" class="form-control" name="txtarea" value="<?=(($acao == 'editar')?$editar['area']:'')?>">
            </div>
            <div class="col-md-3">
                <label>Valor</label>
                <input type="text" class="form-control" onkeyup="moeda(this)" name="txtvalor" value="<?=(($acao == 'editar')?number_format($editar['valor'], 2, ',', '.'):'')?>">
            </div>
            <div class="col-md-4">
                <label>Endereço</label>
                <input type="text" class="form-control" name="txtendereco" value="<?=(($acao == 'editar')?$editar['endereco']:'')?>">
            </div>
            <div class="col-md-2">
                <label>Valor IPTU</label>
                <input type="text" class="form-control" onkeyup="moeda(this)" name="txtvalor_iptu" value="<?=(($acao == 'editar')?number_format($editar['valor_iptu'], 2, ',', '.'):'')?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label>Mapa</label>
                <input type="text" class="form-control" name="txtmapa" value="<?=(($acao == 'editar')?$editar['mapa']:'')?>">
            </div>
            <div class="col-md-2">
                <label>Ativo</label>
                <select class="form-control" name="txtativo">
                    <option value="1" <?=(($acao == 'editar')?(($editar['ativo'] == 1)?'selected = "selected"':''):'')?> >Sim</option>
                    <option value="0" <?=(($acao == 'editar')?(($editar['ativo'] == 0)?'selected = "selected"':''):'')?> >Não</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="imovel.php" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Voltar</a>
                <input type="submit" class="btn btn-success pull-right" name="<?=(($acao == 'novo')?'btn-adicionar':'btn-atualizar')?>" value="<?=(($acao == 'novo')?'Adicionar':'Salvar')?>">
                <br>
                <br>
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