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
        </br>
        <h1 id="tituloCabecalho">Agendex</h1>
        <p id="autor">by Vinicius Renan Petter</p>
        </br>
    </header>
    <form id="forms" method="post" action="verifica_login.php">
        <p id="textoCompletar">Digite seu email</p>
        <input type="text" placeholder="Email" name="email" id="email"></br></br>
        <p id="textoCompletar">Digite sua senha</p>
        <input type="password" placeholder="Senha" name="senha" id="senha"></br></br></br>
        <input id="confirmar" type="submit" name="logar" value="Entrar">
    </form>
</body>
<script type="text/javascript" src="js/navegacao.js"></script>
</html>