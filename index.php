<?
	require_once('admin/includes/conexao.php');
	$sql_loja = mysqli_query($link, 'SELECT * FROM loja WHERE id = 1');
    $loja = mysqli_fetch_array($sql_loja);
    if($loja['baner'] == 1){
        $sql_baner = mysqli_query($link, 'SELECT * FROM baner ORDER BY RAND()');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$loja['nome']?> - Exemplo de Title</title>
	
	<!-- Main CSS file -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/owl.carousel.css" />
	<link rel="stylesheet" href="css/magnific-popup.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/responsive.css" />

	
	<!-- Favicon -->
	<link rel="shortcut icon" href="images/icon/favicon.ico">
	
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
		#botao_real{
			text-decoration: none; 
			border: solid 2px green; 
			background-color: green;
			color: white;
			border-radius: 0px;
		}
		#botao_real_fundo{
			text-decoration: none; 
			border: solid 2px green; 
			background-color: green;
			color: white;
			border-radius: 0px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		#botao_real_fundo:hover{
			text-decoration: none; 
			border: solid 2px green; 
		 	color: green; 
			background-color: white;
			border-radius: 0px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		#botao_real:hover{
			text-decoration: none; 
			border: solid 2px green; 
		 	color: green; 
			background-color: white;
			border-radius: 0px;
		}
		.ativo{
			border-bottom: 3px solid black;
		}
		#box{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
					<a class="logo hidden-xs hidden-sm" href="<?=URL_BASE?>"><img src="admin/uploads/logo/<?=$loja['logo']?>" alt="" style="width: 300px;"></a>
					<a class="logo hidden-md hidden-lg" href="<?=URL_BASE?>"><img src="admin/uploads/logo/<?=$loja['logo']?>" alt="" style="width: 180px;"></a>
				</div>

				<div class="collapse navbar-collapse" id="st-navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
				    	<li class="ativo"><a href="#header">Início</a></li>
				    	<li><a href="#sobre">Sobre Nós</a></li>
				    	<li><a href="#nossa">Nossa Imobiliária</a></li>
				    	<li><a href="<?=URL_BASE?>imoveis">Imóveis</a></li>
				    	<li><a href="#contact">Fale Conosco</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
	</header>
	<!-- /HEADER -->

	<!-- SLIDER -->
	<section id="slider">
		<div id="home-carousel" class="carousel slide" data-ride="carousel">			
			<div class="carousel-inner">
				<?
					$primeira = 1;
					while($banner = mysqli_fetch_array($sql_baner)){
						echo '
							<div class="item '.(($primeira == 1)?'active':'').'" style="background-image: url(admin/uploads/banner/'.$banner['imagem'].')">
								<div class="carousel-caption container">
									<div class="row">
										<div class="col-sm-7">
											<h1>'.$banner['titulo'].'</h1>
											<h2>'.$banner['subtitulo'].'</h2>
										</div>
									</div>
								</div>					
							</div>
						';
						$primeira++;
					}
				?>
				<a class="home-carousel-left" href="#home-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
				<a class="home-carousel-right" href="#home-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
			</div>		
		</div> <!--/#home-carousel--> 
    </section>
	<!-- /SLIDER -->

	<!-- SOBRE -->
	<section id="sobre">
        <div class="container">
            <div class="row" style="margin-top: 150px; margin-bottom: 100px;">
                <div class="col-md-12">
					<div class="section-title">
						<h1><?=$loja['nome']?></h1>
						<span class="st-border"></span>
					</div>
				</div>
                <div class="col-md-7">
                    <p class="text-faded" style="font-size: 20px;">
                        <?=$loja['sobre']?>
                    </p>
                </div>
                <div class="col-md-5">
                    <center><img src="images/logo_chave.png" style="width: 70%;"></center>
                </div>
            </div>
        </div>
    </section>
	<!-- /SOBRE -->

	<!-- SERVICES -->
	<section id="nossa" style="background-color: #ffdb5b;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1 style="color: #bf515a;">Nossa Imobiliária</h1>
						<span class="st-border" style="color: #bf515a;"></span>
					</div>
				</div>
				<?
					$sql_aposentos = mysqli_query($link, 'SELECT * FROM aposentos ORDER BY RAND() LIMIT 6');
					while($a = mysqli_fetch_array($sql_aposentos)){
						echo '
						<div class="col-md-4 col-sm-6 st-service">
							<img src="admin/uploads/aposentos/'.$a['imagem'].'" style="width: 100%; max-height: 250px;">
						</div>
						';
					}
				?>
			</div>
		</div>
	</section>
	<!-- /SERVICES -->


	<!-- OUR WORKS -->
	<section id="services" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row" style="font-family: arial;">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Nossos Imóveis</h1>
						<span class="st-border"></span>
					</div>
				</div>

				<?
					//div com os imoveis
					$sql_imoveis = mysqli_query($link, 'SELECT * FROM imovel WHERE ativo = 1 ORDER BY RAND() limit 3');
					while($imoveis = mysqli_fetch_array($sql_imoveis)){
						$sql_cidade = mysqli_query($link, 'SELECT * FROM cidade WHERE id = "'.$imoveis['id_cidade'].'" LIMIT 1');
						$cidade = mysqli_fetch_array($sql_cidade);
						$sql_bairro = mysqli_query($link, 'SELECT * FROM bairro WHERE id_cidade = "'.$imoveis['id_cidade'].'" LIMIT 1');
						$bairro = mysqli_fetch_array($sql_bairro);
						$sql_tipo_imovel = mysqli_query($link, 'SELECT * FROM tipo_imovel WHERE id = "'.$imoveis['id_tipo_imovel'].'" LIMIT 1');
						$tipo_imovel = mysqli_fetch_array($sql_tipo_imovel);
						$sql_tipo_negocio = mysqli_query($link, 'SELECT * FROM tipo_negocio WHERE id = "'.$imoveis['id_tipo_negocio'].'" LIMIT 1');
						$tipo_negocio = mysqli_fetch_array($sql_tipo_negocio);
						$sql_imagem = mysqli_query($link, 'SELECT * FROM imovel_imagem WHERE id_imovel = "'.$imoveis['id'].'" LIMIT 1');
						if(mysqli_num_rows($sql_imagem) > 0){
							$img = mysqli_fetch_array($sql_imagem);
							$imagem = $img['imagem'];
						}else{
							$imagem = 'padrao.png';
						}
						echo '
							<div class="col-md-4 col-xs-12">
								<div class="panel panel-default" style="border-radius: 0px; border: none; background-color: #f5f5f5;" id="box">
	                                <a href="'.URL_BASE.'imovel/'.$imoveis['id'].'/'.RemoveEspaco($imoveis['nome']).'">
										<div class="panel-body" style="padding: 0px;">
											<img src="admin/uploads/imovel/'.$imagem.'" style="width: 100%; height: 280px;" class="hidden-xs hidden-sm">
											<img src="admin/uploads/imovel/'.$imagem.'" style="width: 100%; height: 200px;" class="hidden-md hidden-lg">
										</div>
										<div class="panel-footer" style="border: none; background-color: #fff;">
											<div class="row" style="font-size: 16px;">
												<div class="col-md-12 col-xs-12">
													<b>Estado</b>: '.$cidade['estado'].'
												</div>
												<div class="col-md-12 col-xs-12">
													<b>Cidade</b>: '.$cidade['nome'].'
												</div>
												<div class="col-md-12 col-xs-12">
													<b>Bairro</b>: '.$bairro['nome'].'
												</div>
												<div class="col-md-12 col-xs-12">
													<b>Rua</b>: '.$imoveis['endereco'].'
												</div>
												<div class="col-md-12 col-xs-12">
													<b>Área</b>: '.$imoveis['area'].'
												</div>
												<div class="col-md-12 col-xs-12">
													<b>REF</b>: '.$imoveis['codigo'].'
												</div>
												<div class="col-md-12" style="margin-top: -15px; margin-bottom: -15px;">
													<hr>
												</div>
												<div class="col-md-4 col-xs-4 text-center">
													<b><i class="fa fa-bed" title="Quartos"></i></b> '.$imoveis['quartos'].'
												</div>
												<div class="col-md-4 col-xs-4 text-center">
													<b><i class="fa fa-car"title="Garagens"></i></b> '.$imoveis['garagens'].'
												</div>
												<div class="col-md-4 col-xs-4 text-center">
													<b><i class="fa fa-bath"title="Banheiros"></i></b> '.$imoveis['banheiros'].'
												</div>
			                                    <div class="col-md-12 col-xs-12" style="margin-top: 10px;">
				                                    <a href="'.URL_BASE.'imovel/'.$imoveis['id'].'/'.RemoveEspaco($imoveis['nome']).'" id="botao_real" class="btn btn-block btn-lg">
				                                        <i class="fa fa-plus" style="float: right; margin-top: 2px; margin-right: -6px;"></i>
				                                        <b>
				                                            R$'.number_format($imoveis['valor'], 2, ',', '.').'
				                                        </b>
				                                    </a>
			                                	</div>
		                                	</div>
		                                </div>
		                            </a>
								</div>
							</div>
						';
					}
				?>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<a href="<?=URL_BASE?>imoveis" class="btn pull-right btn-lg" id="botao_real_fundo"><b><i class="fa fa-arrow-right"></i> Ver todos</b></a>
				</div>
			</div>
		</div>
	</section>
	<!-- /OUR WORKS -->

	
	<!-- TESTIMONIAL -->
	<section id="testimonial" style="background-image: url('images/fundo.jpg');">
		<div class="container">
			<div class="row">
				<div class="overlay"></div>
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div class="st-testimonials">
						<?
							//div de comentarios
							$sql_comentarios = mysqli_query($link, 'SELECT * FROM comentarios');
							$inicio = 1;
							while($comentarios = mysqli_fetch_array($sql_comentarios)){
								echo '
									<div class="item '.(($inicio == 1)?'active':'').' text-center">
										<p>"'.$comentarios['comentario'].'"</p>
										<div class="st-border"></div>
										<div class="client-info">
											<h5>'.$comentarios['nome'].'</h5>
										</div>
									</div>
								';
								$inicio++;
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /TESTIMONIAL -->



	<!-- FUN FACTS -->
	<section id="fun-facts" style="background-color: #f6d358;">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3><i class="fa fa-facebook"></i> <span class="st-counter">9302</span></h3>
						<p>Facebook</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3>
							<i class="fa fa-key fa-6"></i> 
							<span class="st-counter">27</span>
						</h3>
						<p>Imóveis para alugar</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3>	
							<i class="fa fa-home"></i> 
							<span class="st-counter">
								22
							</span>
						</h3>
						<p>Imóveis à venda</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3><i class="fa fa-user"></i> <span class="st-counter">16329</span></h3>
						<p>Clientes Atendidos</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /FUN FACTS -->

	<div style="background-color: #333; color: #fff;">
		<div class="container">
			<div class="row text-center" style="margin-top: 30px;">
				<div class="col-md-4">
					<h4 class="text-center" style="text-transform: none;">Venda seu terreno</h4>
					<p>Encontre a casa ou o lote na medida certa de sua exigência, em diversos bairros.</p>
				</div>
				<div class="col-md-4">
					<h4 class="text-center" style="text-transform: none;">Lançamentos Alto Padrão</h4>
					<p>Veja nossa seleção com os imóveis mais exclusivos, nos bairros mais valorizados da cidade.</p>
				</div>
				<div class="col-md-4">
					<h4 class="text-center" style="text-transform: none;">Mude Agora</h4>
					<p>Seleção de imóveis que já estão Prontos para Morar. Mude-se este ano, entre e confira.</p>
				</div>
			</div>
			<br>
			<div class="row text-center" style="margin-bottom: 30px;">
				<div class="col-md-4">
					<h4 class="text-center" style="text-transform: none;">Venda seu imóvel</h4>
					<p>Ao confiar seu imóvel a nossa equipe, você contará consultores que irão conduzir a negociação de forma
					personalizada. Solicite agora mesmo uma avaliação.</p>
				</div>
				<div class="col-md-4">
					<h4 class="text-center" style="text-transform: none;">Opções de Investimento</h4>
					<p>Aqui você encontra os melhores imóveis comerciais. Encontre
					agora sua oportunidade de investimento.</p>
				</div>
				<div class="col-md-4">
					<h4 class="text-center" style="text-transform: none;">Lotes e Casas</h4>
					<p>Aqui você encontra as melhores casas para o seu gosto.</p>
				</div>
			</div>
		</div>
	</div>

	
	<!-- CONTACT -->
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Contato</h1>
						<span class="st-border"></span>
					</div>
				</div>
				<div class="col-sm-4 contact-info">
					<p class="contact-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae voluptatum dolorum, possimus tenetur pariatur officia, quo commodi autem doloribus vero rerum aspernatur quidem temporibus.</p>
					<p class="st-address"><i class="fa fa-map-marker"></i> <strong>Rua endereço, 123</strong></p>
					<p class="st-phone"><i class="fa fa-mobile"></i> <strong>19 3221-2222</strong></p>
					<p class="st-email"><i class="fa fa-envelope-o"></i> <strong>email@suapizzaria.com.br</strong></p>
				</div>
				<div class="col-sm-7 col-sm-offset-1">
					<form action="php/send-contact.php" class="contact-form" name="contact-form" method="post">
						<div class="row">
							<div class="col-sm-6">
								<input type="text" name="name" required="required" placeholder="Nome*" id="box" style="color: black; font-weight: normal">
							</div>
							<div class="col-sm-6">
								<input type="email" name="email" required="required" placeholder="Email*" id="box" style="color: black; font-weight: normal">
							</div>
							<div class="col-sm-12">
								<input type="text" name="subject" placeholder="Assunto" id="box" style="color: black; font-weight: normal">
							</div>
							<div class="col-sm-12">
								<textarea name="message" required="required" cols="30" rows="7" placeholder="Mensagem*" id="box" style="color: black; font-weight: normal"></textarea>
							</div>
							<div class="col-sm-12">
								<input type="submit" name="submit" value="Realizar Contato" class="btn pull-right btn-lg" id="botao_real_fundo">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- /CONTACT -->

	<div style="background-color: #f6d358; color: #615b5c; padding-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="col-md-12">
                        <p style="color: #bf5155; font-size: 30px;" class="text-center"><b>Fale Conosco</b></p>
                    </div>
                    <form method="POST" action="http://www.macanetaweb.com.br/envio_levaeu.php">
                        <div class="col-md-12" style="margin-bottom: 12px;">
                            <input name="contato_nome" type="text" class="form-control" style="border-radius: 0px;" placeholder="Nome*" id="box" required>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 12px;">
                            <input name="contato_email" type="text" class="form-control" style="border-radius: 0px;" placeholder="Email*" id="box" required>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 12px;">
                            <input name="contato_telefone" type="text" class="form-control" style="border-radius: 0px;" placeholder="Telefone*" id="box" required>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 12px;">
                            <textarea name="contato_mensagem" rows="3" class="form-control" style="border-radius: 0px;" placeholder="Mensagem*" id="box" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="Realizar Contato" class="btn pull-right btn-lg" id="botao_real_fundo">
                        </div>
                    </form>
                </div>
                <div class="col-md-4 hidden-xs">
                    <div class="col-md-12">
                        <p style="color: #bf5155; font-size: 30px;" class="text-center"><b>Como chegar?</b></p>
                    </div>
                    <div class="col-md-12 text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58338.523226428704!2d-46.38009441280751!3d-23.954862970227886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce03423c3b1c3b%3A0x584dceedfc63644f!2sSantos%2C+SP!5e0!3m2!1spt-BR!2sbr!4v1477996661837" width="360" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="margin-top: 20px;">
                    <div class="col-xs-12">
                        <p style="color: #bf5155; font-size: 30px;" class="text-center"><b>Como chegar?</b></p>
                    </div>
                    <div class="col-xs-12 text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58338.523226428704!2d-46.38009441280751!3d-23.954862970227886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce03423c3b1c3b%3A0x584dceedfc63644f!2sSantos%2C+SP!5e0!3m2!1spt-BR!2sbr!4v1477996661837" width="230" height="175" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs">
                    <div class="col-md-12">
                        <p style="color: #bf5155; font-size: 30px;"" class="text-center"><b>Facebook</b></p>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="fb-page" data-href="https://www.facebook.com/imobiliariagalloamparo" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-height="280" data-width="360" data-show-facepile="true"><blockquote cite="https://www.facebook.com/imobiliariagalloamparo" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/imobiliariagalloamparo">Imobiliária</a></blockquote></div>
                    </div>
                </div>
                <div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="margin-top: 20px;">
                    <div class="col-xs-12">
                        <p style="color: #bf5155; font-size: 30px;" class="text-center"><b>Facebook</b></p>
                    </div>
                    <div class="col-xs-12 text-center">
                        <div class="fb-page" data-href="https://www.facebook.com/imobiliariagalloamparo" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-height="175" data-width="230" data-show-facepile="true"><blockquote cite="https://www.facebook.com/imobiliariagalloamparo" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/imobiliariagalloamparo">Imobiliária</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12 text-center">
            <div class="row" style="background-color: #e7e7e7; color: #615b5c; padding-top: 10px;">
                <p>Copyright &copy;<? echo date('Y').' '.$loja['nome'].' - Todos os direitos reservados <a style="color: #690057;" href="http://www.macanetaweb.com.br" target="_blank">MaçanetaWeb</a>.';?></p>
            </div>
        </div>
    </div>


	<!-- Scroll-up -->
	<div class="scroll-up">
		<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
	</div>

	
	<!-- JS -->
	<script type="text/javascript" src="js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="js/jquery.parallax.js"></script><!-- Parallax -->
	<script type="text/javascript" src="js/smoothscroll.js"></script><!-- Smooth Scroll -->
	<script type="text/javascript" src="js/masonry.pkgd.min.js"></script><!-- masonry -->
	<script type="text/javascript" src="js/jquery.fitvids.js"></script><!-- fitvids -->
	<script type="text/javascript" src="js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
	<script type="text/javascript" src="js/jquery.counterup.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="js/waypoints.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script><!-- isotope -->
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
	<script type="text/javascript" src="js/scripts.js"></script><!-- Scripts -->
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