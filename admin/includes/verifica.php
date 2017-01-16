<?
  if($_SESSION['usuarioemail'] != "" or $_SESSION['usuariosenha'] != ""){
    $busca = mysqli_query($link, "SELECT * FROM usuario WHERE email = '".$_SESSION['usuarioemail']."' AND senha = '".$_SESSION['usuariosenha']."' LIMIT 1");
    if(count($busca) > 0){

    }else{
      header('Location: login.php');
      exit();
    }
  }else{
    header('Location: login.php');
    exit();
  }
?>