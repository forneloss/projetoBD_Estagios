<?php
class BD {
  var $conn;

   function ligarBD() {
      $this->conn = mysqli_connect("localhost", "root", "", "projeto_2");
	  if(!$this->conn){
		return -1;
	  }
	}
 
  function executarSQL($sql_command) {
    $resultado = mysqli_query( $this->conn, $sql_command);
    return $resultado;
 }
 
 function numero_tuplos($tabela) {
	 return mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM $tabela"));  
 }
 
 function fecharBD() {
 mysqli_close($this->conn);
 }

}

class Estagios {
 var $db;
 
 function Estagios() {
    $this->db = new BD;
	  $this->db->ligarBD(); 
  }
 
  function novoEstagio($estabelecimento, $empresa, $data_inicio, $aluno, $formador) {
    $sql = "INSERT INTO estagio VALUES ('$empresa', '$estabelecimento', '$aluno', '$formador', '$data_inicio', NULL, NULL, 0, 0, 0, NULL, NULL)";
    if($this->db->executarSQL($sql) == false) {
      printf("Erro a criar o estagio");
    }
  }
 
  function apagarEstagio($empresa, $estabelecimento, $aluno) {
    $sql = "DELETE FROM estagio WHERE estabelecimento_empresa_id = $empresa AND estabelecimento_id = $estabelecimento AND aluno_id = $aluno";
    $this->db->executarSQL($sql);
    print("
      <br>
      Apagado com sucesso
      <br>
    ");
  }

  
  function alterarEstagio($empresa, $estabelecimento, $aluno, $formador, $data_inicio) {
    if($data_inicio == 'NULL') {
      $data_inicio == "NULL";
    }
    else {
      $data_inicio = "'$data_inicio'";
    }

    $sql = " UPDATE estagio 
    SET data_inicio = $data_inicio, 
    formador_id = $formador 
    WHERE aluno_id = $aluno AND estabelecimento_id = $estabelecimento AND estabelecimento_empresa_id = $empresa";

    $this->db->executarSQL($sql);
  }

  function terminarEstagio($empresa, $estabelecimento, $aluno, $nota_empresa, $nota_escola, $nota_relatorio, $nota_procura) {
    $nota_final = ($nota_empresa + $nota_escola + $nota_relatorio + $nota_procura) / 4;

    $sql = " UPDATE estagio 
    SET nota_empresa = $nota_empresa, 
    data_fim = CURDATE(),
    nota_escola = $nota_escola, 
    nota_relatorio = $nota_relatorio, 
    nota_procura = $nota_procura, 
    nota_final = $nota_final
    WHERE aluno_id = $aluno AND estabelecimento_id = $estabelecimento AND estabelecimento_empresa_id = $empresa";

    $this->db->executarSQL($sql);
  }

  function listarEstagios() {
    $result_set = $this->db->executarSQL("SELECT * FROM estagio");
    $tuplos = $this->db->numero_tuplos("estagio");

    if($tuplos == 0) {
      echo "<p>Não há estagios</p>";
      return;
    }

    echo "<table border=1 cellpadding=3 cellspacing=3>\n";
    echo "<p>Estágios:</p>";
    echo "<thead>
        <tr>
            <th>Empresa ID</th>
            <th>Estabelecimento ID</th>
            <th>Aluno ID</th>
            <th>Formador ID</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Nota Empresa</th>
            <th>Nota Escola</th>
            <th>Nota Relatório</th>
            <th>Nota Procura</th>
            <th>Nota Final</th>
            <th>Classificação</th>
        </tr>
    </thead>";
    for($registo=0; $registo<$tuplos; $registo++) {
      echo "<tr>\n";
      $row = mysqli_fetch_assoc($result_set);
      $this->escreveEstagio($row["estabelecimento_empresa_id"], $row["estabelecimento_id"], $row["aluno_id"], $row["formador_id"], $row["data_inicio"], $row["data_fim"], $row["nota_empresa"], $row["nota_escola"], $row["nota_relatorio"], $row["nota_procura"], $row["nota_final"], $row["classificacao"] );
      echo "</tr>\n";    
    }

    echo "</table>\n";
  }

  function listarEstagiosPorAcabar() {
    $result_set = $this->db->executarSQL("SELECT * 
                                          FROM estagio e
                                          WHERE e.data_fim IS NULL");
    $tuplos = mysqli_num_rows($result_set);

    if($tuplos == 0) {
      echo "<p>Não há estagios</p>";
      return;
    }

    echo "<table border=1 cellpadding=3 cellspacing=3>\n";
    echo "<p>Estágios:</p>";
    echo "<thead>
        <tr>
            <th>Empresa ID</th>
            <th>Estabelecimento ID</th>
            <th>Aluno ID</th>
            <th>Formador ID</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Nota Empresa</th>
            <th>Nota Escola</th>
            <th>Nota Relatório</th>
            <th>Nota Procura</th>
            <th>Nota Final</th>
            <th>Classificação</th>
        </tr>
    </thead>";
    for($registo=0; $registo<$tuplos; $registo++) {
      echo "<tr>\n";
      $row = mysqli_fetch_assoc($result_set);
      $this->escreveEstagioPorAcabar($row["estabelecimento_empresa_id"], $row["estabelecimento_id"], $row["aluno_id"], $row["formador_id"], $row["data_inicio"], $row["data_fim"], $row["nota_empresa"], $row["nota_escola"], $row["nota_relatorio"], $row["nota_procura"], $row["nota_final"], $row["classificacao"] );
      echo "</tr>\n";    
    }

    echo "</table>\n";
  }

  function escreveEstagioPorAcabar($estabelecimento_empresa_id , $estabelecimento_id, $aluno_id, $formador_id, $data_inicio, $data_fim, $nota_empresa, $nota_escola, $nota_relatorio, $nota_procura, $nota_final, $classificacao ) {
      printf(
        "<td>$estabelecimento_empresa_id</td>
        <td>$estabelecimento_id</td>
        <td>$aluno_id</td>
        <td>$formador_id</td>
        <td>$data_inicio</td>
        <td>$data_fim</td>
        <td>$nota_empresa</td>
        <td>$nota_escola</td>
        <td>$nota_relatorio</td>
        <td>$nota_procura</td>
        <td>$nota_final</td>
        <td>$classificacao</td>
        <form action=\"acabar.php\" method=post>
        <td>
        <input type='hidden' name='empresa' value='$estabelecimento_empresa_id'>
        <input type='hidden' name='estabelecimento' value='$estabelecimento_id'>
        <input type='hidden' name='aluno' value='$aluno_id'>
        <input type=submit value=Alterar></td>
        </form>"
      );
  }
  
  //Escreve os detalhes de um determinado estagio 
  function escreveEstagio($estabelecimento_empresa_id , $estabelecimento_id, $aluno_id, $formador_id, $data_inicio, $data_fim, $nota_empresa, $nota_escola, $nota_relatorio, $nota_procura, $nota_final, $classificacao ) {
    if($data_fim == NULL) {
      printf(
        "<td>$estabelecimento_empresa_id</td>
        <td>$estabelecimento_id</td>
        <td>$aluno_id</td>
        <td>$formador_id</td>
        <td>$data_inicio</td>
        <td>$data_fim</td>
        <td>$nota_empresa</td>
        <td>$nota_escola</td>
        <td>$nota_relatorio</td>
        <td>$nota_procura</td>
        <td>$nota_final</td>
        <td>$classificacao</td>
        <form action=\"apagar.php\" method=post>
        <td>
        <input type='hidden' name='empresa' value='$estabelecimento_empresa_id'>
        <input type='hidden' name='estabelecimento' value='$estabelecimento_id'>
        <input type='hidden' name='aluno' value='$aluno_id'>
        <input type=submit value=Apagar>
        </td>
        </form>
        <form action=\"alterar.php\" method=post>
        <td>
        <input type='hidden' name='empresa' value='$estabelecimento_empresa_id'>
        <input type='hidden' name='estabelecimento' value='$estabelecimento_id'>
        <input type='hidden' name='aluno' value='$aluno_id'>
        <input type=submit value=Alterar></td></form>"
      );
    }
    else {
      printf(
        "<td>$estabelecimento_empresa_id</td>
        <td>$estabelecimento_id</td>
        <td>$aluno_id</td>
        <td>$formador_id</td>
        <td>$data_inicio</td>
        <td>$data_fim</td>
        <td>$nota_empresa</td>
        <td>$nota_escola</td>
        <td>$nota_relatorio</td>
        <td>$nota_procura</td>
        <td>$nota_final</td>
        <td>$classificacao</td>"
      );
    }
  }

  function devolveCampo($empresa, $estabelecimento, $aluno, $campo) {
    $sql="SELECT * FROM estagio WHERE aluno_id = $aluno AND estabelecimento_id = $estabelecimento AND estabelecimento_empresa_id = $empresa";
	  $result_set = $this->db->executarSQL($sql);
	  $row = mysqli_fetch_assoc($result_set);
    $return = $row["$campo"];
    if($row["$campo"] == "") {
      $return = "NULL";
    }
	  return $return;
  }
  
  function fecharBDEstagios() {
  $this->db->fecharBD();
  }
}

class Empresas {
  var $db;

  function Empresas() {
    $this->db = new BD;
    $this->db->ligarBD();
  }

  function escreveEmpresa($firma, $tipo, $localidade, $telefone, $website, $empresa_id) {
    printf("
        <td>$firma</td>
        <td>$tipo</td>
        <td>$localidade</td>
        <td>$telefone</td>
        <td>$website</td>
        <form action=\"estagios_empresa.php\" method=post>
        <td>
        <input type='hidden' name='empresa' value='$empresa_id'>
        <input type=submit value='Ver Estágios'>
        </td>
        </form>
    ");
  }

  function escreveEmpresaShort($firma, $descricao, $morada_sede, $localidade, $telefone) {
    printf("
        <td>$firma</td>
        <td>$descricao</td>
        <td>$morada_sede</td>
        <td>$localidade</td>
        <td>$telefone</td>
    ");
  }


  function escreverEstabelecimento($nome, $morada, $localidade) {
    printf("
        <td>$nome</td>
        <td>$morada</td>
        <td>$localidade</td>
    ");
  }

  function escreverResponsavel($nome_responsavel, $cargo_responsavel, $telemovel_responsavel, $email_responsavel) {
    printf("
        <td>$nome_responsavel</td>
        <td>$cargo_responsavel</td>
        <td>$telemovel_responsavel</td>
        <td>$email_responsavel</td>
    ");
  }


  function escreveTransporte($meio_transporte, $linha) {
    printf("
        <td>$meio_transporte</td>
        <td>$linha</td>
    ");
  }

  function listarEmpresas($localidade, $ramo) {
    $sql = "SELECT * FROM empresa em, disponibilidade d WHERE em.empresa_id = d.empresa_id AND d.ano = YEAR(CURDATE())";


    if($localidade != "" && $ramo != "") {
      $sql = "SELECT * 
              FROM empresa em, disponibilidade d, trabalha t, ramo_atividade r 
              WHERE em.empresa_id = d.empresa_id AND em.localidade = '$localidade' AND d.ano = YEAR(CURDATE()) AND t.empresa_id = em.empresa_id AND t.ramo_atividade_id = r.ramo_atividade_id AND r.descricao = '$ramo'";
    }
    else if($localidade != "") {
      $sql = "SELECT * FROM empresa em, disponibilidade d WHERE em.empresa_id = d.empresa_id AND em.localidade = '$localidade' AND d.ano = YEAR(CURDATE())";
    }
    else if($ramo != "") {
      $sql = "SELECT * 
              FROM empresa em, disponibilidade d, trabalha t, ramo_atividade r 
              WHERE em.empresa_id = d.empresa_id AND d.ano = YEAR(CURDATE()) AND t.empresa_id = em.empresa_id AND t.ramo_atividade_id = r.ramo_atividade_id AND r.descricao LIKE '%$ramo%'";
    }

    $result_set = $this->db->executarSQL($sql);
    $tuplos = mysqli_num_rows($result_set);

    //caso nao haja ou empresas ou empresas com disponibilidades
    if($tuplos == 0) {
      echo "<p>Não há estagios disponíveis</p>";
      return;
    }

    echo "<table border=1 cellpadding=3 cellspacing=3>\n";
    echo "<p>Empresas:</p>";
    echo "<thead>
        <tr>
            <th>Firma</th>
            <th>Tipo</th>
            <th>Localidade</th>
            <th>Telefone</th>
            <th>Website</th>
        </tr>
    </thead>";
    for($registo=0; $registo<$tuplos; $registo++) {
      echo "<tr>\n";
      $row = mysqli_fetch_assoc($result_set);
      $this->escreveEmpresa($row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"], $row["empresa_id"]);
      echo "</tr>\n";    
    }

    echo "</table>\n";
  }

  function listarEstagiosDeEmpresa($empresa_id) {
    $sql = "SELECT  em.empresa_id, es.nome_comercial, es.morada, es.localidade, es.responsavel_id, es.estabelecimento_id, em.firma, em.morada_sede, em.localidade, em.telefone
            FROM empresa em, estabelecimento es
            WHERE em.empresa_id = es.empresa_id AND em.empresa_id = $empresa_id
          ";

    $result_set = $this->db->executarSQL($sql);
    $tuplos = mysqli_num_rows($result_set);

    //caso nao haja ou empresas ou empresas com disponibilidades
    if($tuplos == 0) {
      echo "<p>Não há estagios disponíveis</p>";
    }

    //escrever as tabelas para cada estágio
    for($registo=0; $registo<$tuplos; $registo++) {
      echo "<table border=1 cellpadding=3 cellspacing=3>\n";
      echo "<h1>Estágio:</h1>";
      echo "<tr>\n";
      echo "<thead>
          <tr>
              <th>Nome</th>
              <th>Morada</th>
              <th>Localidade</th>
          </tr>
      </thead>";
      $row = mysqli_fetch_assoc($result_set);
      $this->escreverEstabelecimento($row["nome_comercial"], $row["morada"], $row["localidade"]);
      echo "</tr>\n";    
      echo "</table>\n";

      echo "<table border=1 cellpadding=3 cellspacing=3>\n";
      echo "<p>Responsável:</p>";
      echo "<tr>\n";
      echo "<thead>
          <tr>
              <th>Nome Responsábel</th>
              <th>Cargo do Responsável</th>
              <th>Telemóvel do Responsável</th>
              <th>Email do Responsável</th>
          </tr>
      </thead>";
      $responsavel = $this->devolveResponsavel($row["responsavel_id"]);
      $this->escreverResponsavel($responsavel["nome"], $responsavel["cargo"], $responsavel["telemovel"], $responsavel["email"]);
      echo "</tr>\n";    
      echo "</table>\n";

      echo "<table border=1 cellpadding=3 cellspacing=3>\n";
      echo "<p>Empresa:</p>";
      echo "<tr>\n";
      echo "<thead>
          <tr>
              <th>Nome Empresa</th>
              <th>Ramo de Atividade</th>
              <th>Morada da Sede</th>
              <th>Localidade</th>
              <th>Telefone</th>
          </tr>
      </thead>";
      $ramo = $this->devolveRamo($row["empresa_id"]);
      $this->escreveEmpresaShort($row["firma"], $ramo["descricao"], $row["morada_sede"], $row["localidade"], $row["telefone"]);
      echo "</tr>\n";    
      echo "</table>\n";

      echo "<table border=1 cellpadding=3 cellspacing=3>\n";
      echo "<p>Transportes:</p>";
      echo "<tr>\n";
      echo "<thead>
          <tr>
              <th>Meio Transporte</th>
              <th>Linha</th>
          </tr>
      </thead>";
      $transporte = $this->devolveTransporte($row["empresa_id"], $row["estabelecimento_id"]);
      $this->escreveTransporte($transporte["meio_transporte"], $transporte["linha"]);
      echo "</tr>\n";    
      echo "</table>\n";

    }

  }

  function devolveResponsavel($responsavel) {
    $sql = "SELECT nome, cargo, telemovel, email
            FROM responsavel r
            WHERE r.responsavel_id = $responsavel
    ";
    return mysqli_fetch_assoc($this->db->executarSQL($sql));
  }

  function devolveRamo($empresa) {
    $sql = "SELECT r.descricao
            FROM ramo_atividade r, empresa e, trabalha t 
            WHERE e.empresa_id = t.empresa_id AND r.ramo_atividade_id = t.ramo_atividade_id AND e.empresa_id = $empresa 
    ";
    return mysqli_fetch_assoc($this->db->executarSQL($sql));
  }

  function devolveTransporte($empresa, $estabelecimento) {
    $sql = "SELECT t.meio_transporte, t.linha 
            FROM transporte t,  estabelecimento es, servido s
            WHERE es.empresa_id = $empresa AND es.estabelecimento_id = $estabelecimento AND s.estabelecimento_id = es.estabelecimento_id AND s.estabelecimento_empresa_id= es.empresa_id AND s.transporte_id = t.transporte_id
    ";
    return mysqli_fetch_assoc($this->db->executarSQL($sql));
  }

  function fecharBDEmpresas() {
    $this->db->fecharBD();
  }
}

class Alunos {
  var $db;

  function Alunos() {
    $this->db = new BD;
    $this->db->ligarBD();
  }

  function novoAluno($turma, $utilizador, $numero, $observacoes) {
    $sql = "INSERT INTO aluno VALUES ($turma, $utilizador, $numero, '$observacoes')";
    $res =$this->db->executarSQL($sql);  
  }

  function fecharBDAlunos() {
    $this->db->fecharBD();
  }
}


?>
