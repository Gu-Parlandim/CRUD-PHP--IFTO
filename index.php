<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CRUD PHP</title>
</head>
<body>
   <header class="header-bg">
       <div class="header-container">
            <div class="logo">
                <img src="./Images/iftologo.svg" alt="logo do ifto"/>
            </div>
            <nav class="menu">
                <ul>
                    <li>
                        <a href="index.php">Lista de alunos</a>
                    </li>
                    <li>
                        <a href="cadastra.php">Cadastra aluno</a>
                    </li>
                </ul>
            </nav>
       </div>
   </header>

   <main>
        <h1>Sistema Estudantil - IFTO</h1>
        <div class="formBusca">
            <form action="" method="POST">
                <div>
                    <label for="buscaAluno">Buscar por nome:</label>
                    <input type="text" name="buscaAlunoNome" id="buscaAluno" placeholder="digite um nome" />
                </div>
                <div>
                    <button type="submit">Buscar</button>
                </div>
            </form>
        </div>
        <div class="tabela">
            <caption>Mostrando todos os alunos</caption>
            <table>
                <thead>
                    <tr>
                        <th class="table-id">Id</th>
                        <th>Nome</th>
                        <th>Nota</th>
                        <th>Atualização</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     $conexao = new PDO('mysql:dbname=ifto;host=127.0.0.1', 'root', '');
                     $database = [];
                     function buscaAlunos(){
                         global $conexao;
                         $consulta = $conexao->prepare("SELECT * FROM alunos");
                         $consulta->execute();
                         $resulConsulta = $consulta->fetchAll();
                         
                         return $resulConsulta;
                     }
             
                     function buscaAlunosByName($nome){
                         global $conexao;
                         $consulta = $conexao->prepare("SELECT * FROM alunos WHERE nome LIKE :nomeAlun");
                         $consulta->execute([":nomeAlun"=>"%$nome%"]);
                     
                         $resulConsulta = $consulta->fetchAll();
             
                         return $resulConsulta;
                     }
             
                    if(isset($conexao)){
                        if($_POST){
                             $database = BuscaAlunosByName($_POST["buscaAlunoNome"]);
                        }
                        else {
                            $database = buscaAlunos();
                        }
             
                        foreach($database as $dados){
                 ?>
                    <tr>
                        <td> <?php echo $dados["id_aluno"]?> </td>
                        <td> <?php  echo $dados["nome"]?> </td>
                        <td> <?php  echo $dados["nota"]?> </td>
                        <td class="table-button">
                            <div>
                                <a href="editar.php?idAluno=<?php echo $dados['id_aluno']?>" class="button">
                                    <div class="button-img">
                                        <img src="./images/edit.svg" alt="alt">
                                    </div>
                                    Editar
                                </a>

                                <a href="delete.php?idAluno=<?php echo $dados['id_aluno']?>" class="button">
                                    <div class="button-img">
                                        <img src="./images/delete.svg" alt="alt">
                                    </div>
                                    Deletar
                                </a>
                            </div>
                        </td>
                    </tr> 
                    <?php }} ?>
                </tbody>
            </table>
        </div>
   </main>

   <footer>
        <div>
            <p>© Todos os direitos reservado</p>
        </div>
   </footer>
</body>
</html>