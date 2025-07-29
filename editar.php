<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID não fornecido.");
}

$id = $_GET['id'];

// Busca os dados do Pokémon
$stmt = $conn->prepare("SELECT * FROM pokemons WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$pokemon = $resultado->fetch_assoc();

if (!$pokemon) {
    die("Pokémon não encontrado.");
}

// Atualiza se enviar o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data_registro = $_POST['data_registro'];
    $hp = $_POST['hp'];
    $ataque = $_POST['ataque'];
    $defesa = $_POST['defesa'];
    $observacoes = $_POST['observacoes'];

    // Se enviar nova foto
    $foto = $pokemon['foto'];
    if (!empty($_FILES['foto']['name'])) {
        $pasta = "uploads/";
        if (!is_dir($pasta)) mkdir($pasta);
        $foto = $pasta . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    $stmt = $conn->prepare("UPDATE pokemons SET nome=?, tipo=?, localizacao=?, data_registro=?, hp=?, ataque=?, defesa=?, observacoes=?, foto=? WHERE id=?");
    $stmt->bind_param("ssssiiissi", $nome, $tipo, $localizacao, $data_registro, $hp, $ataque, $defesa, $observacoes, $foto, $id);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Pokémon</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px; background: #3498db; color: #fff; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Editar Pokémon</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nome" value="<?= $pokemon['nome'] ?>" required>
        <input type="text" name="tipo" value="<?= $pokemon['tipo'] ?>" required>
        <input type="text" name="localizacao" value="<?= $pokemon['localizacao'] ?>">
        <input type="date" name="data_registro" value="<?= $pokemon['data_registro'] ?>" required>
        <input type="number" name="hp" value="<?= $pokemon['hp'] ?>">
        <input type="number" name="ataque" value="<?= $pokemon['ataque'] ?>">
        <input type="number" name="defesa" value="<?= $pokemon['defesa'] ?>">
        <textarea name="observacoes"><?= $pokemon['observacoes'] ?></textarea>
        <p>Foto atual:</p>
        <?php if ($pokemon['foto']): ?>
            <img src="<?= $pokemon['foto'] ?>" width="80"><br>
        <?php endif; ?>
        <input type="file" name="foto" accept="image/*">
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
