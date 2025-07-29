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
        if (!is_dir($pasta))
            mkdir($pasta);
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
    <link rel="stylesheet" href="cadastrar.css">

</head>

<body>
    <img src="uploads/bg-cadastro.jpg" class="bg-cadastro-img" alt="Cubone de fundo"/>
    <h2 class="title">Cadastrar Pokémon</h2>
    
    <form action="" method="POST" enctype="multipart/form-data" class="glass-card">
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