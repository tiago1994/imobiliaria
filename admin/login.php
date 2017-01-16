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
        <title>Login Painel Administrativo</title>
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
            }
            .filtro{
                font-weight: normal;
                color: #9a9595;
            }
        </style>
    </head>
    <body style="background:#F7F7F7;">
        <div id="wrapper">
            <div class="col-md-offset-3 col-md-6" style="margin-top: 15%;">
                <div class="box_login panel panel-default" >
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-3 hidden-xs">
                                <img src="imagens/logo.png" class="img-responsive">
                            </div>
                            <div class="col-md-8 col-sm-9 col-xs-12">
                                <form method="POST" action="valida.php">              
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" name="txtloginemail" class="form-control" placeholder="E-mail" required value="<?=((isset($_GET['email']))?$_GET['email']:'')?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="password" name="txtloginsenha" class="form-control" placeholder="****" required/>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Acessar</button>
                                    </div>
                                    <?
                                    if(isset($_GET['deslogado'])){
                                      if($_GET['deslogado'] === '1'){
                                        echo '<div class="alert alert-success" style="margin-top: 20px;">
                                                    <strong>Logoff</strong> realizado com sucesso.
                                                </div>';
                                      }
                                    }
                                    if(isset($_GET['erro'])){
                                      if($_GET['erro'] === '1'){
                                        echo '<div class="alert alert-danger" style="margin-top: 20px;">
                                                    <strong>Erro!</strong> Email ou Senha não conferem.
                                                </div>';
                                      }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.fittext.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/creative.js"></script>
        <script src="dist/js/lightbox-plus-jquery.min.js"></script>
        <script src='https://code.jquery.com/jquery-1.12.3.js'></script>
        <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js'></script>
        <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
        <script src='https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js'></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>      