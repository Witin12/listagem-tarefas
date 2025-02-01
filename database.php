<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "listagem-tarefas";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexão deu erro: " . $conn->connect_error);
}
