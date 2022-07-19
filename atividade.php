<?php
session_start();
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];
include_once('conexao.php');
$sqlii = "SELECT * FROM users WHERE email='$email' AND senha='$senha'";
$resultado = mysqli_query($conexao, $sqlii) or die("erro ao buscar dados!");
$busca = mysqli_fetch_array($resultado);

$atv = $_GET['atv'];
$_SESSION['atv'] = $atv;

if (isset($_POST['nova'])) {
    $atv = 'nova';
}
if (isset($_POST['edit'])) {
    $atv = 'editar';
}
if (isset($_POST['salvar'])) {
    $titulo = $_POST['tit'];
    $descricao = $_POST['desc'];
    $sql = "INSERT INTO atividades
    (titulo,descricao,responsavel,data_inicio)
    VALUES
    ('" . $titulo . "','" . $descricao . "','" . $busca['id'] . "','" . $_POST['dt_inicio'] . "')";
    $resultado = mysqli_query($conexao, $sql) or die("Erro ao salvar nova Atividade!");
}

?>
<html>

<head>
    <metacharset="UTF-8" />
    <title>
        Agendex - Sistema de agendamento
    </title>
    <link href="config.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav id="menu">
            <ul>
                <form method="post" action="atividade.php">
                    <button type='submit' id='nova' name='nova'>Nova Atividade</a></button>
                    <button type='submit' id='edit' name='edit'><a>Editar Atividade</a></button>
                    <button><a href="menu.php">Voltar</a></button>
                </form>
            </ul>
        </nav>
    </header>
    <?php
    if ($atv == 'nova') {
        echo "
        <form id='forms' method='post'>
            <p id='textoCompletar'>Nova Atividade</p>
        Título <input type='text' placeholder='Título' name='tit' id='tit'></br></br>
        Descrição <input type='text' placeholder='Descrição' name='desc' id='desc'></br></br>
        Data Inicio <input type='date' Inicio' name='dt_inicio' id='dt_inicio'></br></br>
        Data Fim <input type='date' Fim' name='dt_fim' id='dt_fim'></br></br>
        Hora Inicio <input type='time' Inicio' name='h_inicio' id='h_inicio'></br></br>
        Hora Fim <input type='time' Fim' name='h_fim' id='h_fim'></br></br>
        <input type='submit' value='Salvar' id='salvar' name='salvar'>
    </form>";
    }
    if ($atv == 'editar') {
        if ($_GET['id']) {
            $sqlh = "SELECT * FROM atividades WHERE id=" . $_GET['id'];
            $resultado = mysqli_query($conexao, $sqlh) or die("Erro ao procurar dados de Atividades!");
            $vall = mysqli_fetch_array($resultado);
        }
        echo "
        <form id='forms' method='post'>
            <p id='textoCompletar'>Nova Atividade</p>
        Título    <input type='text' placeholder='Título' name='tit' id='tit' value=" . $vall['titulo'] . "></br></br>
        Descrição <input type='text' placeholder='Descrição' name='desc' id='desc'value=" . $vall['descricao'] . "></br></br>
        Data Fim  <input type='date' placeholder='Data Fim' name='dt_fim' id='dt_fim'value=" . $vall['data_fim'] . "></br></br>
        Hora Fim  <input type='time' placeholder='Hora Fim' name='hr_fim' id='hr_fim'value=" . $vall['hora_fim'] . "></br></br>
        <input type='submit' value='Salvar' id='salvEdit' name='salvEdit'>
    </form>";
        echo "<table><tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Situação</th>
                <th>Data Final</th>
            </tr>
            <tr>";
        $sqlh = "SELECT * FROM atividades WHERE responsavel='".$busca['id']."'";
        $resultado = mysqli_query($conexao, $sqlh) or die("Erro ao procurar dados de Atividades para editar!");
        while ($valh = mysqli_fetch_array($resultado)) {
            echo "<tr>
                    <td>" . $valh['titulo'] . "</td>
                    <td>" . $valh['descricao'] . "</td>
                    <td>" . $valh['situacao'] . "</td>
                    <td>" . $valh['data_fim'] . "</td>
                    <td><button type='submit' id='edita' nome='edita' onclick='editando(" . $valh['id'] . ");'>📝</button></td>
                    </tr>";
        }
        if (isset($_POST['salvEdit'])) {
            $sqlh = "UPDATE atividades SET titulo='" . $_POST['tit'] . "', descricao='" . $_POST['desc'] . "',data_fim='" . $_POST['dt_fim'] ."',hora_fim='".$_POST['hr_fim']."' WHERE id='" . $busca['id'] . "'";
            $resultado = mysqli_query($conexao, $sqlh) or die("Erro ao procurar dados de Atividades para editar!");
            echo "<script>alert('Salvo com sucesso!');window.open('atividade.php','_self');</script>";
        }
    }
    ?>
</body>
<script type="text/javascript" src="js/navegacao.js"></script>

</html>
