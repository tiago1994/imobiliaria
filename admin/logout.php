<?
  session_start();

  unset($_SESSION['usuarioid']);
  unset($_SESSION['usuarionome']);
  unset($_SESSION['usuarioemail']);
  unset($_SESSION['usuariosenha']);
  unset($_SESSION['usuarioavatar']);

  header('Location: login.php?deslogado=1');
  exit();
?>