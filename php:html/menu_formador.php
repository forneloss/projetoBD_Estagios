<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
<title>Formador</title>
</head>
<body>
<center>
Portal Formador
<br>
<br>

<?php

require("bd.php");
$estagios = new Estagios;
$estagios->Estagios();
$estagios->listarEstagiosPorAcabar();
$estagios->fecharBDEstagios();

?>

</center>
</body>
</html>
