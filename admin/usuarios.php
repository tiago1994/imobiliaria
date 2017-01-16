<?
	session_start();
	$_SESSION['pagina'] = 'usuarios';
    require_once('includes/topo.php');

    $acao   = ((isset($_REQUEST['acao']))?$_REQUEST['acao']:'');
    $id     = ((isset($_REQUEST['id']))?$_REQUEST['id']:'');

    if(isset($_POST['btn-adicionar'])){
        $nome = $_POST['txtnome'];
        $email = $_POST['txtemail'];
        $senha = md5($_POST['txtsenha']);
        
        if($senha == ''){
            header('Location: logout.php');
            exit();
        }else{
            $add = mysqli_query($link, 'INSERT INTO usuario (nome, email, senha) VALUES ("'.$nome.'", "'.$email.'", "'.$senha.'")');
        }
        if($add){
            header('Location: usuarios.php?retorno=1');
            exit();
        }else{
            header('Location: usuarios.php?retorno=0');
            exit();
        }
    }
    if(isset($_POST['btn-atualizar'])){
        $nome = $_POST['txtnome'];
        $email = $_POST['txtemail'];
        $senha = md5($_POST['txtsenha']);
        if($_POST['txtsenha'] == ''){
            $att = mysqli_query($link, 'UPDATE usuario SET nome = "'.$nome.'", email = "'.$email.'" WHERE id = "'.$id.'" LIMIT 1');
        }else{
            $att = mysqli_query($link, 'UPDATE usuario SET nome = "'.$nome.'", email = "'.$email.'", senha = "'.$senha.'" WHERE id = "'.$id.'" LIMIT 1');
        }

        if($att){
            header('Location: usuarios.php?retorno=1');
            exit();
        }else{
            header('Location: usuarios.php?retorno=0');
            exit();
        }
    }
    if($acao == 'editar'){
        $edd = mysqli_query($link, 'SELECT * FROM usuario WHERE id = "'.$id.'" LIMIT 1');
        
        if(mysqli_num_rows($edd) > 0){
            $editar = mysqli_fetch_array($edd);
        }else{
            header('Location: usuarios.php?retorno=0');
            exit();   
        }
    }
    if($acao == 'deletar'){
        $del = mysqli_query($link, 'DELETE FROM usuario WHERE id = "'.$id.'" LIMIT 1');

        if($del){
            header('Location: usuarios.php?retorno=1');
            exit();  
        }else{
            header('Location: usuarios.php?retorno=0');
            exit();   
        }
    }
?>
<?
if($acao == ''){
?>
    <h1><u>Usuários</u> <a href="usuarios.php?acao=novo" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a></h1><br>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            	<th>Opções</th>
            </tr>
        </thead>
        <tbody>
        	<?
        		$sql_usuario = mysqli_query($link, 'SELECT * FROM usuario');
        		while($usuario = mysqli_fetch_array($sql_usuario)){
        			echo '<tr>';
        			echo '<td>'.$usuario['id'].'</td>';
        			echo '<td>'.$usuario['nome'].'</td>';
        			echo '<td>'.$usuario['email'].'</td>';
        			echo '<td><a href="usuarios.php?acao=editar&id='.$usuario['id'].'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="usuarios.php?acao=deletar&id='.$usuario['id'].'" class="btn btn-danger btn-xs btnremover"><i class="fa fa-trash"></i></a></td>';
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
                <?=(($acao == 'novo')?'Novo Usuário':$editar['nome'])?>
            </h3>
        </div>
    </div>
    <!-- /.row -->

    <form method="POST" action="">
        <div class="row">
            <div class="col-md-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="txtnome" placeholder="Digite o nome do usuário." value="<?=(($acao == 'editar')?$editar['nome']:'')?>" required>
            </div>
            <div class="col-md-4">
                <label>E-mail</label>
                <input type="text" name="txtemail" class="form-control" placeholder="Digite o e-mail do usuário." value="<?=(($acao == 'editar')?$editar['email']:'')?>" required>
            </div>
            <div class="col-md-4">
                <label>Senha</label>
                <input type="password" class="form-control" name="txtsenha" <?=(($acao == 'editar')?'':'required')?>>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
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
    