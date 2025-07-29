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
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            background: #1f4e79;
            padding: 10px 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }
        .logo img {
            height: 50px;
        }
        .nav-links {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s;
        }
        .nav-links li a:hover {
            background: #2980b9;
        }
        .menu-toggle {
            background: none;
            border: none;
            color: #fff;
            font-size: 30px;
            cursor: pointer;
            display: none;
        }
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                right: 0;
                background: #1f4e79;
                width: 100%;
                padding: 20px 0;
                box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            }
            .nav-links.active {
                display: flex;
            }
            .menu-toggle {
                display: block;
            }
            .nav-links li {
                text-align: center;
                margin: 10px 0;
            }
        }

        /* CONTAINER DO FORMULÁRIO */
        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2980b9;
        }
        input, textarea, select {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        textarea {
            resize: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #1f4e79;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="nav-container">
    <a href="index.php" class="logo">
      <img src="https://upload.wikimedia.org/wikipedia/commons/9/98/International_Pokémon_logo.svg" alt="Pokémon Logo">
    </a>
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
    <ul class="nav-links" id="nav-links">
      <li><a href="index.php">Início</a></li>
      <li><a href="cadastrar.php">Cadastrar</a></li>
      <li><a href="listar.php">Pokémons</a></li>
      <li><a href="relatorio.php">Relatório</a></li>
    </ul>
  </div>
</nav>

<!-- FORMULÁRIO -->
<div class="form-container">
    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Cadastrar Pokémon</h2>
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
</div>

<script>
  function toggleMenu() {
    document.getElementById('nav-links').classList.toggle('active');
  }
</script>

</body>

</html>