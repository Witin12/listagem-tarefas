<?php
include 'database.php';

$filtroColaborador = $_GET['colaboradorId'] ?? "";
$filtroPrioridade = $_GET['prioridade'] ?? "";
$filtroDataInicio = $_GET['data_inicio'] ?? "";
$filtroDataFim = $_GET['data_fim'] ?? "";
$ordenacao = $_GET['ordenacao'] ?? "prazo";

$sql = "SELECT t.*, c.nome as colaborador FROM tarefas t
        JOIN colaboradores c ON t.colaborador_id = c.id
        WHERE 1=1";

if (!empty($filtroColaborador)) {
    $sql .= " AND c.id = " . intval($filtroColaborador);
}
if (!empty($filtroPrioridade)) {
    $sql .= " AND t.prioridade = '$filtroPrioridade'";
}
if (!empty($filtroDataInicio) && !empty($filtroDataFim)) {
    $sql .= " AND t.prazo BETWEEN '$filtroDataInicio' AND '$filtroDataFim'";
}

$sql .= " ORDER BY $ordenacao ASC";

$tarefas = $conn->query($sql);
$colaboradores = $conn->query("SELECT id, nome FROM colaboradores");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>

    <!--* Links -->
    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Jquery Autocomplete -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

    <!-- Tabela com os filtros -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lista de Tarefas</h2>
        <div class="card p-4 mb-4">
            <form method="get">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Filtrar por Colaborador</label>
                        <input type="text" class="form-control" id="colaboradorAutoComplete" placeholder="Digite o nome do colaborador">
                        <input type="hidden" name="colaboradorId" id="colaboradorId">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filtrar por Prioridade</label>
                        <select class="form-select" id="prioridade" name="prioridade">
                            <option value="">Todas</option>
                            <option value="Baixa" <?= $filtroPrioridade == "Baixa" ? 'selected' : '' ?>>Baixa</option>
                            <option value="Média" <?= $filtroPrioridade == "Média" ? 'selected' : '' ?>>Média</option>
                            <option value="Alta" <?= $filtroPrioridade == "Alta" ? 'selected' : '' ?>>Alta</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filtrar por Data</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="data_inicio" value="<?= $filtroDataInicio ?>">
                            <span class="input-group-text">até</span>
                            <input type="date" class="form-control" name="data_fim" value="<?= $filtroDataFim ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ordenar por</label>
                        <select class="form-select" id="ordenacao" name="ordenacao">
                            <option value="prazo" <?= $ordenacao == "prazo" ? 'selected' : '' ?>>Prazo</option>
                            <option value="prioridade" <?= $ordenacao == "prioridade" ? 'selected' : '' ?>>Prioridade</option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Filtrar</button>
                </div>
            </form>
        </div>

        <div class="card p-4">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Descrição</th>
                        <th>Prazo</th>
                        <th>Responsável</th>
                        <th>Prioridade</th>
                        <th>Cadastro</th>
                        <th>Executado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($tarefa = $tarefas->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $tarefa['descricao'] ?></td>
                            <td><?= date('d/m/y H:i', strtotime($tarefa['prazo'])) ?></td>
                            <td><?= $tarefa['colaborador'] ?></td>
                            <td><?= $tarefa['prioridade'] ?></td>
                            <td><?= date('d/m/y H:i', strtotime($tarefa['data_cadastro'])) ?></td>
                            <td><?= date('d/m/y H:i', strtotime($tarefa['data_execucao'])) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Autocomplete -->
     <script src="js/script.js"></script>
</body>

</html>