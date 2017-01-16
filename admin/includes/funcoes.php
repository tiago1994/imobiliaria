<?
$acao = $_REQUEST['acao'];

if($_REQUEST['acao']!=""){
	switch($acao){
		case "buscamodelo":
			echo BuscaModelo($_REQUEST['idmarca']); 
			break;
	}
}

function BuscaModelo($id_marca){
	require_once('conexao.php');
	//$link 					= mysqli_connect("localhost", "root", "bolinha94", "base_careca");
	$retorno 			   	= array(); // array
	$sql_marca 		       	= mysqli_query($link, 'SELECT * FROM modelo WHERE id_marca = "'.$id_marca.'"'); // Seleciona tudo do projeto_tarefa_validacao para a listagem
	if($sql_marca){
		while($recebe = mysqli_fetch_object($sql_marca)){
			$retorno[] = $recebe;
		}
		return json_encode($retorno);
	}else{
		return 0;
	}
}

?>