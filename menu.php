<?php
session_start();
$id_user = $_SESSION['idUser'];
$_SESSION['idUser'] = $id_user;

include('conexao.php');
$sql = "SELECT * FROM users WHERE id='$id_user'";
$resultado = mysqli_query($conexao, $sql) or die("erro ao buscar dados!");
$busca = mysqli_fetch_array($resultado);

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
                <button><a href="atividade.php">Atividades Gerais</a></button>
                <?php
                if ($busca['admin'] = 's') {
                    echo "<button><a href='administracao.php'>Administracao</a></button>";
                }
                ?>
                <button><a href="index.php">Deslogar</a></button>
            </ul>
        </nav>
    </header>
    <h1>Minhas Atividades</h1>
    <?php
    echo "<table><tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Situação</th>
                <th>Data fim</th>
                <th>Hora fim</th>
                <th>Responsavel</th>
            </tr>
            <tr>";
    $sql = "SELECT * FROM atividades WHERE responsavel='" . $busca['id'] . "'";
    $resultado = mysqli_query($conexao, $sql) or die("Erro ao procurar dados de Atividades!");
    while ($val = mysqli_fetch_array($resultado)) {
        echo "<tr>
                    <td>" . $val['titulo'] . "</td>
                    <td>" . $val['descricao'] . "</td>
                    <td>" . $val['situacao'] . "</td>
                    <td>" . $val['data_fim'] . "</td>
                    <td>" . $val['hora_fim'] . "</td>
                    </tr>";
    }

    ?>
</body>
<script type="text/javascript" src="js/navegacao.js"></script>

</html>