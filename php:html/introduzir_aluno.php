<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head><title>Introduzir</title>
</head>
<body background=#ffffff>
<?php
require('bd.php');

$alunos = new Alunos;
$alunos->Alunos();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $alunos->novoAluno(
        $_POST["turma"],
        $_POST["utilizador"],
        $_POST["numero"],
        $_POST["observacoes"]
    );
}
$alunos->fecharBDAlunos();
?>
<br>
<a href="menu_administrador.html">voltar ao menu</a>
</body>
</html>