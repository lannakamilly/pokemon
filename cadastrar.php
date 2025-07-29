<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data_registro = $_POST['data_registro'];
    $hp = $_POST['hp'];
    $ataque = $_POST['ataque'];
    $defesa = $_POST['defesa'];
    $observacoes = $_POST['observacoes'];

    // Upload da foto (opcional)
    $foto = null;
    if (!empty($_FILES['foto']['name'])) {
        $pasta = "uploads/";
        if (!is_dir($pasta)) mkdir($pasta);
        $foto = $pasta . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    if (!empty($nome)) {
        $stmt = $conn->prepare("INSERT INTO pokemons (nome, tipo, localizacao, data_registro, hp, ataque, defesa, observacoes, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiiss", $nome, $tipo, $localizacao, $data_registro, $hp, $ataque, $defesa, $observacoes, $foto);

        if ($stmt->execute()) {
            echo "<script>alert('Pokémon cadastrado com sucesso!'); window.location='listar.php';</script>";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('O nome é obrigatório!'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pokémon</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, textarea, select { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px; background: #4CAF50; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <h2>Cadastrar Pokémon</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="tipo" placeholder="Tipo" required>
        <input type="text" name="localizacao" placeholder="Localização">
        <input type="date" name="data_registro" required>
        <input type="number" name="hp" placeholder="HP">
        <input type="number" name="ataque" placeholder="Ataque">
        <input type="number" name="defesa" placeholder="Defesa">
        <textarea name="observacoes" placeholder="Observações"></textarea>
        <input type="file" name="foto" accept="image/*">
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
