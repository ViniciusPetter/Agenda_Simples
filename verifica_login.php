<?php
include_once('conexao.php'); //FAZER A CONEXÇÃO COM BD
$email = $_POST['email'];
$senha = $_POST['senha'];
session_start();
$_SESSION['email'] = $email;
$_SESSION['senha'] = $senha;

$sql = "SELECT * FROM users WHERE email='$email' AND senha='$senha'";
$resultado = mysqli_query($conexao, $sql) or die("erro ao buscar dados dos usuarios!");
$busca = mysqli_fetch_array($resultado);
$_SESSION['idUser'] = $busca['id'];

if ($busca <= 0) {
    echo 'Usuario não cadastrado!';
    echo "<form metho='post' action='index.php'>
    <button type='submmit'>Ok</button>
    </form>";
} else {
    echo 'Bem vindo '.$busca['nome'].'!';
    echo "<form method='post' action='menu.php'>
    <button type='submmit'>Obrigado</button>
    </form>";
}
?>
<html>
<script type="text/javascript" src="js/navegacao.js"></script>
<link href="config.css" rel="stylesheet">
</html>