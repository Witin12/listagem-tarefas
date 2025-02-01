<?php
include 'database.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $sql = "INSERT INTO colaboradores (nome, cpf, email) VALUES ('$nome', '$cpf', '$email')";
    if ($conn->query($sql) === TRUE) {
        $mensagem = '<div class="alert alert-success w-50 mx-auto text-center mt-3">Colaborador cadastrado com sucesso!</div>';
    } else {
        $mensagem = '<div class="alert alert-danger w-50 mx-auto text-center mt-3">Erro ao cadastrar:  ' . $conn->error . '</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Colaboradores</title>

    <!--* Links  -->
    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="listagemTarefas.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastroColaboradores.php">Cadastro de Colaboradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastroTarefas.php">Cadastro de Tarefas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Cadastro de Colaboradores</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $mensagem ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>

</html>