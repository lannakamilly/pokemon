<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID não fornecido.");
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM pokemons WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar.php");
    exit;
} else {
    echo "Erro ao excluir: " . $stmt->error;
}
?>
