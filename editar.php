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
                        <a href="#">Cadastra aluno</a>
                    </li>
                </ul>
            </nav>
       </div>
   </header>

   <main>
       <?php
         $conexao = new PDO('mysql:dbname=ifto;host=127.0.0.1', 'root', '');

        if($_GET){
            $consulta = $conexao->prepare("SELECT * FROM alunos WHERE id_aluno = :id");
            $consulta->bindValue(":id", $_GET["idAluno"]);
            $consulta->execute();

            $resulConsulta = $consulta->fetch();
        }

        if($_POST){
            $consulta = $conexao->prepare("UPDATE  alunos set nome = :nome, nota = :nota WHERE id_aluno = :id;");
            $consulta->bindValue(":nome", $_POST["nomeAluno"]);
            $consulta->bindValue(":nota", $_POST["notaAluno"]);
            $consulta->bindValue(":id", $_POST["idAluno"]);
            $consulta->execute();

            header("location: index.php");
        }

        ?>

        <h1>Sistema Estudantil - IFTO</h1>
        <h3>Editar aluno</h3>
        <div class="cadastro_section">
            <form action="" method="POST" class="formulario_cadastro">
                <div>
                    <label for="nomeAluno">Nome do aluno:</label>
                    <input type="text" id="nomeAluno" name="nomeAluno" value="<?php echo $resulConsulta["nome"] ?>" placeholder="digite o nome" required />
                </div>
                <div>
                    <label for="notaAluno">Nota do aluno:</label>
                    <input type="number" id="notaAluno" name="notaAluno" placeholder="digite a nota" required max="10" min="0" step="0.1" value="<?php echo $resulConsulta["nota"]?>" />
                </div>
                <input type="hidden" name=idAluno value="<?php echo $resulConsulta["id_aluno"]?>" />
                <button type="submit">Editar</button>
                <button type="Reset">Cancelar</button>
            </form>
        </div>
   </main>

   <footer>
        <div>
            <p>© Todos os direitos reservado</p>
        </div>
   </footer>
</body>
</html>