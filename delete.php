<?php 

if(array_key_exists('idAluno', $_GET)){
    $conexao = new PDO('mysql:dbname=ifto;host=127.0.0.1', 'root', '');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = $conexao->prepare("DELETE FROM alunos WHERE  id_aluno = :id;");
    $consulta->bindValue(":id", $_GET["idAluno"]);
    $consulta->execute();
    
}


header("location: index.php");