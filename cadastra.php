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
        if($_POST){
            $conexao = new PDO('mysql:dbname=ifto;host=127.0.0.1', 'root', '');
            $consulta = $conexao->prepare("INSERT INTO alunos(nome, nota) VALUES(:nome,:nota)");
            $consulta->bindValue(":nome", $_POST["nomeAluno"]);
            $consulta->bindValue(":nota", $_POST["notaAluno"]);
            $consulta->execute();

        ?>

        <div class="popup_message">
            <div class="popup_img">
                <img src="./images/success-green-check-mark.svg" alt="">
            </div>
            <p>Cadastrado com sucesso</p>
        </div>
        <?php }?>

        <h1>Sistema Estudantil - IFTO</h1>
        <h3>Cadastra novo aluno</h3>
        <div class="cadastro_section">
            <form action="" method="POST" class="formulario_cadastro">
                <div>
                    <label for="nomeAluno">Nome do aluno:</label>
                    <input type="text" id="nomeAluno" name="nomeAluno" placeholder="digite o nome" required />
                </div>
                <div>
                    <label for="notaAluno">Nota do aluno:</label>
                    <input type="number" id="notaAluno" name="notaAluno" placeholder="digite a nota" required max="10" min="0" step="0.1" />
                </div>
                <button type="submit">Cadastrar</button>
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