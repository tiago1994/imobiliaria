<?
    ob_start();
    $pagina = ((isset($_SESSION['pagina']))?$_SESSION['pagina']:'');
    require_once('includes/conexao.php');
    require_once('includes/verifica.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="dist/css/lightbox.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">      
        <!--font oswald -->
        <link href='https://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
        <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
        <title>Painel Administrativo</title>
        <style type="text/css">
            h2{
                font-family: 'Oswald', sans-serif;
                font-weight: 700;
                color: #67cff6;
            }
            body{
                font-family: 'Oswald', sans-serif;
                font-weight: 700;
                color: #615b5c;
                background-color: #eee;
            }
            .container{
                background-color: #fff;
            }
            .filtro{
                font-weight: normal;
                color: #9a9595;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">MAÇANETA</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li <?=(($pagina == 'home')?'class="active"':'')?>><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li <?=(($pagina == 'imovel')?'class="active"':'')?>><a href="imovel.php"><i class="fa fa-home"></i> Imóveis</a></li>
                    <li <?=(($pagina == 'aposentos')?'class="active"':'')?>><a href="aposentos.php"><i class="fa fa-group"></i> Aposentos</a></li>
                    <li <?=(($pagina == 'comentarios')?'class="active"':'')?>><a href="comentarios.php"><i class="fa fa-pencil"></i> Comentários</a></li>
                    <li <?=(($pagina == 'banners')?'class="active"':'')?>><a href="banners.php"><i class="fa fa-picture-o"></i> Banner</a></li>
                    <li <?=(($pagina == 'tipo_imovel')?'class="active"':'')?>><a href="tipo_imovel.php"><i class="fa fa-plus"></i> Tipo Imovel</a></li>
                    <li <?=(($pagina == 'tipo_negocio')?'class="active"':'')?>><a href="tipo_negocio.php"><i class="fa fa-money"></i> Tipo Negócio</a></li>
                    <li <?=(($pagina == 'cidade')?'class="active"':'')?>><a href="cidade.php"><i class="fa fa-globe"></i> Cidade</a></li>
                    <li <?=(($pagina == 'bairro')?'class="active"':'')?>><a href="bairro.php"><i class="fa fa-chain-broken"></i> Bairro</a></li>
                    <li <?=(($pagina == 'usuarios')?'class="active"':'')?>><a href="usuarios.php"><i class="fa fa-user"></i> Usuários</a></li>
                    <li <?=(($pagina == 'sistema')?'class="active"':'')?>><a href="sistema.php"><i class="fa fa-cog"></i> Sistema</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Sair</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
            <div class="container">
                <div class="col-md-12 col-xs-12">
                <?
                    if(isset($_GET['retorno'])){
                        if($_GET['retorno'] === "0"){    
                            echo '<br><br><div class="alert alert-danger" role="alert">
                                    <strong>Ops!</strong> Erro na operação. Estamos trabalhando para resolver.
                                </div>';
                        }else{
                            echo '<br><br><div class="alert alert-success" role="alert">
                                    <strong>Parabéns!</strong> Sua operação foi realizada com sucesso.
                                </div>';
                        }
                    }else{

                    }
                ?>