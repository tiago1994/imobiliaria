<?
	require_once('admin/includes/conexao.php');
	$sql_loja = mysqli_query($link, 'SELECT * FROM loja WHERE id = 1');
    $loja = mysqli_fetch_array($sql_loja);
    if($loja['baner'] == 1){
        $sql_baner = mysqli_query($link, 'SELECT * FROM baner ORDER BY RAND()');
    }

    $id_imovel = ((isset($_GET['id']))?$_GET['id']:'');
    $sql_imovel = mysqli_query($link, 'SELECT * FROM imovel WHERE id = "'.$id_imovel.'" LIMIT 1');
    $imovel = mysqli_fetch_array($sql_imovel);

    $sql_cidade = mysqli_query($link, 'SELECT * FROM cidade WHERE id = "'.$imovel['id_cidade'].'" LIMIT 1');
    $cidade = mysqli_fetch_array($sql_cidade);

    $sql_bairro = mysqli_query($link, 'SELECT * FROM bairro WHERE id = "'.$imovel['id_bairro'].'" LIMIT 1');
    $bairro = mysqli_fetch_array($sql_bairro);

    $sql_tipo_imovel = mysqli_query($link, 'SELECT * FROM tipo_imovel WHERE id = "'.$imovel['id_tipo_imovel'].'" LIMIT 1');
    $tipo_imovel = mysqli_fetch_array($sql_tipo_imovel);

    $sql_tipo_negocio = mysqli_query($link, 'SELECT * FROM tipo_negocio WHERE id = "'.$imovel['id_tipo_negocio'].'" LIMIT 1');
    $tipo_negocio = mysqli_fetch_array($sql_tipo_negocio);

    //atualiza acesso
    $acessosmaisum = $imovel['acessos'] + 1;
    $sql_atualiza_acesso = mysqli_query($link, 'UPDATE imovel SET acessos = "'.$acessosmaisum.'" WHERE id = "'.$imovel['id'].'" LIMIT 1');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$loja['nome']?> - Exemplo de Title</title>
	
	<!-- Main CSS file -->
	<link rel="stylesheet" href="<?=URL_BASE?>css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=URL_BASE?>css/owl.carousel.css" />
	<link rel="stylesheet" href="<?=URL_BASE?>css/magnific-popup.css" />
	<link rel="stylesheet" href="<?=URL_BASE?>css/font-awesome.css" />
	<link rel="stylesheet" href="<?=URL_BASE?>css/style.css" />
	<link rel="stylesheet" href="<?=URL_BASE?>css/responsive.css" />

	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=URL_BASE?>images/icon/favicon.ico">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		#botao{
			border: none;
			border-radius: 0px;
		}
		.ativo{
			border-bottom: 3px solid black;
		}
	</style>
	
	
</head>
<body>

	<!-- PRELOADER -->
	<div id="st-preloader">
		<div id="pre-status">
			<div class="preload-placeholder"></div>
		</div>
	</div>
	<!-- /PRELOADER -->

	
	<!-- HEADER -->
	<header id="header">
		<nav class="navbar st-navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#st-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
					</button>
					<a class="logo hidden-xs hidden-sm" href="<?=URL_BASE?>"><img src="<?=URL_BASE?>admin/uploads/logo/<?=$loja['logo']?>" alt="" style="width: 300px;"></a>
					<a class="logo hidden-md hidden-lg" href="<?=URL_BASE?>"><img src="<?=URL_BASE?>admin/uploads/logo/<?=$loja['logo']?>" alt="" style="width: 180px;"></a>
				</div>

				<div class="collapse navbar-collapse" id="st-navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
				    	<li><a href="<?=URL_BASE?>index">Início</a></li>
				    	<li><a href="<?=URL_BASE?>index#sobre">Sobre Nós</a></li>
				    	<li><a href="<?=URL_BASE?>index#nossa">Nossa Imobiliária</a></li>
				    	<li class="ativo"><a href="<?=URL_BASE?>imoveis">Imóveis</a></li>
				    	<li><a href="<?=URL_BASE?>index#contact">Fale Conosco</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
	</header>
	<!-- /HEADER -->

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Realizar contato</h4>
	      	</div>
      		<form method="POST">
		      	<div class="modal-body">
		      			<input type="text" name="txttitulo" placeholder="Sobre o imóvel: <?=$imovel['codigo']?>" class="form-control" readonly>
		      			<br>
		      			<input type="text" name="txtemail" placeholder="Digite seu email" class="form-control">
		      			<br>
		      			<input type="text" name="txtnome" placeholder="Digite seu nome" class="form-control">
		      			<br>
		      			<textarea class="form-control" name="txtmensagem" placeholder="Digite a sua mensagem" rows="5"></textarea>
			      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-warning" data-dismiss="modal" style="border: none; border-radius: 0px;">Sair</button>
		        	<button type="button" class="btn btn-success" style="border: none; border-radius: 0px;">Enviar</button>
		     	</div>
      		</form>
	    </div>
	  </div>
	</div>
	<!-- Modal -->

	<!-- TESTIMONIAL -->
	<section id="testimonial" style="background-image: url('<?=URL_BASE?>images/fundo.jpg'); margin-top: 60px;">
		<div class="container">
			<div class="row">
				<div class="overlay"></div>
				<div class="col-md-12">
					<div class="col-md-12">
						<h2 style="color: white;"><?=$tipo_imovel['nome'].' - REF. '.$imovel['codigo']?></h2>
						<p style="color: white;"><?=$imovel['endereco'].', '.$bairro['nome'].', '.$cidade['nome'].', '.$cidade['estado']?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /TESTIMONIAL -->
	<!-- SOBRE -->
	<section id="sobre" class="hidden-xs hidden-sm" style="background-color: #f5f5f5">
        <div class="container">
            <div class="row" style="margin-top: -120px; margin-bottom: 60px;">
            	<div class="col-md-8">
            		<div class="col-md-12">
	            		<div class="panel panel-default" style="border-radius: 0px;">
							<div class="panel-body">
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							      	<!-- Indicators -->
							      	<ol class="carousel-indicators">
							      		<?
							      			$sql_imagens = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id_imovel = "'.$id_imovel.'"');
							      			$quantidade = mysqli_num_rows($sql_imagens);
							      			$numero = 0;
							      			while($numero < $quantidade){
							      				echo '<li data-target="#carousel-example-generic" data-slide-to="'.$numero.'" class="'.(($numero == 0)?'active':'').'"></li>';
							      				$numero++;
							      			}
							      		?>
							      	</ol>

							      	<!-- Wrapper for slides -->
							      	<div class="carousel-inner">
							      		<?
							      			$primeira = 1;
										    if(mysqli_num_rows($sql_imagens) > 0){
										    	while($imagem = mysqli_fetch_array($sql_imagens)){
										    		echo '
										    		<div class="item '.(($primeira == 1)?'active':'').'">
										          		<img src="'.URL_BASE.'admin/uploads/imovel/'.$imagem['imagem'].'" style="width: 100%;">
										        	</div>
										    		';
										    		$primeira++;
										    	}
										    }
					            		?>
							      	</div>

							      <!-- Controls -->
							      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							        <span class="glyphicon glyphicon-chevron-left"></span>
							      </a>
							      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							        <span class="glyphicon glyphicon-chevron-right"></span>
							      </a>
							    </div>
	                    	</div>
						</div>
					</div>
					<div class="col-md-6">
						<a class="btn btn-success btn-lg btn-block" style="border: none; border-radius: 0px;"><b><i class="fa fa-whatsapp"></i> <?=$loja['celular']?></b></a>
					</div>
					<div class="col-md-6">
						<a class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#myModal" style="border: none; border-radius: 0px;"><b><i class="fa fa-envelope"></i> Fale Conosco</b></a>
					</div>
            	</div>
            	<div class="col-md-4">
            		<div class="panel panel-default" style="border-radius: 0px;">
						<div class="panel-body">
							<div class="col-md-12 text-center">
								<a class="btn btn-success btn-lg btn-block" style="border: none; border-radius: 0px;"><b>R$<?=number_format($imovel['valor'], 2, ',', '.')?></b></a>
							</div>
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-6 text-left">
								<b>Cidade:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$cidade['nome']?>
							</div>
							<div class="col-md-6 text-left">
								<b>Tipo Imóvel:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$tipo_imovel['nome']?>
							</div>
							<div class="col-md-6 text-left">
								<b>Tipo Negócio:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$tipo_negocio['nome']?>
							</div>
							<div class="col-md-6 text-left">
								<b>Quartos:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$imovel['quartos']?>
							</div>
							<div class="col-md-6 text-left">
								<b>Banheiros:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$imovel['banheiros']?>
							</div>
							<div class="col-md-6 text-left">
								<b>Garagens:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$imovel['garagens']?>
							</div>
							<div class="col-md-6 text-left">
								<b>Área:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=(($imovel['area'] == '')?'0':$imovel['area'])?>
							</div>
							<div class="col-md-6 text-left">
								<b>Valor IPTU:</b>
							</div>
							<div class="col-md-6 text-left">
								R$<?=number_format($imovel['valor_iptu'], 2, ',', '.')?>
							</div>
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-6 text-left">
								<b>Acessos:</b>
							</div>
							<div class="col-md-6 text-left">
								<?=$imovel['acessos']?>
							</div>
							<div class="col-md-12">
								<br>
								<iframe src="<?=$imovel['mapa']?>" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
            	</div>
            </div>
        </div>
    </section>
	<!-- /SOBRE -->

	<!-- SOBRE -->
	<section id="sobre" class="hidden-lg hidden-md" style="background-color: #f5f5f5">
        <div class="container">
            <div class="row" style="margin-top: -40px; margin-bottom: 60px;">
            	<div class="col-md-8 col-xs-12">
            		<div class="col-md-12">
	            		<div class="panel panel-default" style="border-radius: 0px;">
							<div class="panel-body">
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							      	<!-- Indicators -->
							      	<ol class="carousel-indicators">
							      		<?
							      			$sql_imagens = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id_imovel = "'.$id_imovel.'"');
							      			$quantidade = mysqli_num_rows($sql_imagens);
							      			$numero = 0;
							      			while($numero < $quantidade){
							      				echo '<li data-target="#carousel-example-generic" data-slide-to="'.$numero.'" class="'.(($numero == 0)?'active':'').'"></li>';
							      				$numero++;
							      			}
							      		?>
							      	</ol>

							      	<!-- Wrapper for slides -->
							      	<div class="carousel-inner">
							      		<?
							      			$primeira = 1;
										    if(mysqli_num_rows($sql_imagens) > 0){
										    	while($imagem = mysqli_fetch_array($sql_imagens)){
										    		echo '
										    		<div class="item '.(($primeira == 1)?'active':'').'">
										          		<img src="'.URL_BASE.'admin/uploads/imovel/'.$imagem['imagem'].'" style="width: 100%;">
										        	</div>
										    		';
										    		$primeira++;
										    	}
										    }
					            		?>
							      	</div>

							      <!-- Controls -->
							      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							        <span class="glyphicon glyphicon-chevron-left"></span>
							      </a>
							      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							        <span class="glyphicon glyphicon-chevron-right"></span>
							      </a>
							    </div>
	                    	</div>
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<a class="btn btn-success btn-lg btn-block" style="border: none; border-radius: 0px;"><b><i class="fa fa-whatsapp"></i> <?=$loja['celular']?></b></a>
					</div>
					<div class="col-md-6 col-xs-12">
						<a class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#myModal" style="border: none; border-radius: 0px;"><b><i class="fa fa-envelope"></i> Fale Conosco</b></a>
						<br><br>
					</div>
            	</div>
            	<div class="col-md-4 col-xs-12">
            		<div class="col-md-12">
	            		<div class="panel panel-default" style="border-radius: 0px;">
							<div class="panel-body">
								<div class="col-md-12 text-center">
									<a class="btn btn-success btn-lg btn-block" style="border: none; border-radius: 0px;"><b>R$<?=number_format($imovel['valor'], 2, ',', '.')?></b></a>
								</div>
								<div class="col-md-12">
									<hr>
								</div>
								<div class="col-md-6 text-center">
									<b>Cidade:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$cidade['nome']?>
								</div>
								<div class="col-md-6 text-center">
									<b>Tipo Imóvel:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$tipo_imovel['nome']?>
								</div>
								<div class="col-md-6 text-center">
									<b>Tipo Negócio:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$tipo_negocio['nome']?>
								</div>
								<div class="col-md-6 text-center">
									<b>Quartos:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$imovel['quartos']?>
								</div>
								<div class="col-md-6 text-center">
									<b>Banheiros:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$imovel['banheiros']?>
								</div>
								<div class="col-md-6 text-center">
									<b>Garagens:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$imovel['garagens']?>
								</div>
								<div class="col-md-6 text-center">
									<b>Área:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=(($imovel['area'] == '')?'0':$imovel['area'])?>
								</div>
								<div class="col-md-6 text-center">
									<b>Valor IPTU:</b>
								</div>
								<div class="col-md-6 text-center">
									R$<?=$imovel['valor_iptu']?>
								</div>
								<div class="col-md-12">
									<hr>
								</div>
								<div class="col-md-6 text-center">
									<b>Acessos:</b>
								</div>
								<div class="col-md-6 text-center">
									<?=$imovel['acessos']?>
								</div>
								<div class="col-md-12">
									<br>
									<iframe src="<?=$imovel['mapa']?>" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
	            	</div>
            </div>
        </div>
    </section>
	<!-- /SOBRE -->

	<div style="">
        <div class="col-md-12 text-center">
            <div class="row" style="background-color: #e7e7e7; color: #615b5c; padding-top: 10px; margin-top: -10px;">
                <p>Copyright &copy;<? echo date('Y').' '.$loja['nome'].' - Todos os direitos reservados <a style="color: #690057;" href="http://www.macanetaweb.com.br" target="_blank">MaçanetaWeb</a>.';?></p>
            </div>
        </div>
    </div>


	<!-- Scroll-up -->
	<div class="scroll-up">
		<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
	</div>

	
	<!-- JS -->
	<script type="text/javascript" src="<?=URL_BASE?>js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="<?=URL_BASE?>js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="<?=URL_BASE?>js/jquery.parallax.js"></script><!-- Parallax -->
	<script type="text/javascript" src="<?=URL_BASE?>js/smoothscroll.js"></script><!-- Smooth Scroll -->
	<script type="text/javascript" src="<?=URL_BASE?>js/masonry.pkgd.min.js"></script><!-- masonry -->
	<script type="text/javascript" src="<?=URL_BASE?>js/jquery.fitvids.js"></script><!-- fitvids -->
	<script type="text/javascript" src="<?=URL_BASE?>js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
	<script type="text/javascript" src="<?=URL_BASE?>js/jquery.counterup.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="<?=URL_BASE?>js/waypoints.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="<?=URL_BASE?>js/jquery.isotope.min.js"></script><!-- isotope -->
	<script type="text/javascript" src="<?=URL_BASE?>js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
	<script type="text/javascript" src="<?=URL_BASE?>js/scripts.js"></script><!-- Scripts -->
	<div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


</body>
</html>