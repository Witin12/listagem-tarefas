<?php
date_default_timezone_set('America/Sao_Paulo');
include 'database.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $prazo = $_POST['prazo'];
    $colaborador = $_POST['colaboradorId'];
    $prioridade = $_POST['prioridade'];
    $dataExecucao = $_POST['dataExecucao'];

    $prazo_datetime = DateTime::createFromFormat('Y-m-d\TH:i', $prazo);
    $prazo_minimo = (new DateTime())->modify('+24 hours')->setTime(date('H'), date('i'), 0);

    if (!$prazo_datetime || $prazo_datetime < $prazo_minimo) {
        die("Erro: O prazo deve ser pelo menos 24 horas à frente.");
    }

    $sql = "INSERT INTO tarefas (descricao, prazo, colaborador_id, prioridade, data_execucao) 
            VALUES ('$descricao', '$prazo', '$colaborador', '$prioridade', '$dataExecucao')";

    if ($conn->query($sql) === TRUE) {
        $mensagem = '<div class="alert alert-success w-50 mx-auto text-center mt-3">Tarefa cadastrada com sucesso!</div>';
    } else {
        $mensagem = '<div class="alert alert-danger w-50 mx-auto text-center mt-3">Erro ao cadastrar:  ' . $conn->error . '</div>';
    }
}

$colaboradores = $conn->query("SELECT id, nome FROM colaboradores");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefas</title>

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
                    <h2 class="text-center mb-4">Cadastro de Tarefa</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prazo</label>
                            <input type="datetime-local" class="form-control" name="prazo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data de Execução</label>
                            <input type="datetime-local" class="form-control" name="dataExecucao" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Responsável</label>
                            <select class="form-select" name="colaboradorId" required>
                                <?php while ($colab = $colaboradores->fetch_assoc()) { ?>
                                    <option value="<?= $colab['id'] ?>"><?= $colab['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prioridade</label>
                            <select class="form-select" name="prioridade" required>
                                <option value="baixa">Baixa</option>
                                <option value="media">Média</option>
                                <option value="alta">Alta</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Cadastrar Tarefa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $mensagem ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>