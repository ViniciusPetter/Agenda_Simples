<?php
include_once('conexao.php');
$id_user = $_SESSION['idUser'];

session_start();
$_SESSION['acao'] = $acao;

if (isset($_POST['historico'])) {
    $acao = 'historico';
}
if (isset($_POST['andamento'])) {
    $acao = 'andamento';
}
if (isset($_POST['canceladas'])) {
    $acao = 'canceladas';
}
if (isset($_POST['userAdd'])) {
    $acao = 'userAdd';
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
                <form method="post" action="administracao.php">
                    <button type="submit" id='historico' name='historico'>Historico de atividades</button>
                    <!--<button type="submit" id='andamento' name='andamento'>Atividades em andamento</button>
                    <button type="submit" id='canceladas' name='canceladas'>Atividades Canceladas</button>-->
                    <button type="submit" id='userAdd' name='userAdd'>Adicionar Usuários</button>
                    <button><a href="menu.php">Voltar</a></button>
                </form>
            </ul>
        </nav>
    </header>
    <hr>
    <?php
    if ($acao == 'historico') {
        echo "<table><tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Situação</th>
            </tr>
            <tr>";
        $sqlh = "SELECT * FROM atividades";
        $resultado = mysqli_query($conexao, $sqlh) or die("Erro ao procurar dados de Atividades!");
        while ($valh = mysqli_fetch_array($resultado)) {
            echo "<tr>
                    <td>" . $valh['titulo'] . "</td>
                    <td>" . $valh['descricao'] . "</td>
                    <td>" . $valh['situacao'] . "</td>
                    </tr>";
        }
        echo "<div id='piechart'></div>";
    }
    if ($acao == 'andamento') {
        echo "<table><tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Situação</th>
            </tr>
            <tr>";
        $sqla = "SELECT * FROM atividades WHERE situacao='A'";
        $resultado = mysqli_query($conexao, $sqla) or die("Erro ao procurar dados de Atividades!");
        while ($vala = mysqli_fetch_array($resultado)) {
            echo "<tr>
                    <td>" . $vala['titulo'] . "</td>
                    <td>" . $vala['descricao'] . "</td>
                    <td>" . $vala['situacao'] . "</td>
                    </tr>";
        }
    }
    if ($acao == 'canceladas') {
        echo "<table><tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Situação</th>
            </tr>
            <tr>";
        $sqlc = "SELECT * FROM atividades WHERE situacao='C'";
        $resultado = mysqli_query($conexao, $sqlc) or die("Erro ao procurar dados de Atividades!");
        while ($valc = mysqli_fetch_array($resultado)) {
            echo "<tr>
                    <td>" . $valc['titulo'] . "</td>
                    <td>" . $valc['descricao'] . "</td>
                    <td>" . $valc['situacao'] . "</td>
                    </tr>";
        }
    }
    ?> </tr>
    </table>
    <?php
    if ($acao == 'userAdd') {
        echo "<form>
                    <input type='text' id='nome' name='nome' placeholder='Nome'></input></br></br>
                    <input type='text' id='email' name='email' placeholder='Email'></input></br></br>
                    <input type='password' id='senha' name='senha' placeholder='Senha'></input></br></br>
                    <input type='password' id='senhaC' name='senhaC' placeholder='Confirmar Senha'></input>
                </form>";
    }
    ?>
</body>
<script type="text/javascript" src="js/navegacao.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="js/grafico.js"></script>

</html>