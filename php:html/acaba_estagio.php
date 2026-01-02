<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Acabar Estágio</title>
</head>
<body bgcolor="#FFFFFF">

<?php
require('bd.php');
$estagios = new Estagios;
$estagios->Estagios();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $estagios->terminarEstagio(
        $_POST["empresa"], 
        $_POST["estabelecimento"],
        $_POST["aluno"], 
        $_POST["nota_empresa"], 
        $_POST["nota_escola"], 
        $_POST["nota_relatorio"], 
        $_POST["nota_procura"], 
    );
}
$estagios->fecharBDEstagios();
?>
<br>
<p>Alteração efetuada com sucesso!</p>
<br>
<br>
<a href="menu_formador.php">voltar ao menu</a>
</body>
</html>