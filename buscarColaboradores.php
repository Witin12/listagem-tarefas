<?php
include 'database.php';

$busca = $_GET['term'] ?? '';

$sql = "SELECT id, nome FROM colaboradores WHERE nome LIKE '%$busca%'";
$resultado = $conn->query($sql);

$colaboradores = [];
while ($row = $resultado->fetch_assoc()) {
    $colaboradores[] = [
        "label" => $row['nome'],
        "value" => $row['id']
    ];
}

echo json_encode($colaboradores);
