<?php
include 'conexao.php';

$pesquisa = "";
if (!empty($_GET['pesquisa'])) {
    $pesquisa = $_GET['pesquisa'];
    $sql = "SELECT * FROM pokemons WHERE nome LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%$pesquisa%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conn->query("SELECT * FROM pokemons ORDER BY data_registro DESC");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pokémons Encontrados</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef; padding: 20px; }
        .pokemon { background: #fff; margin-bottom: 10px; padding: 10px; border-radius: 8px; display: flex; align-items: center; }
        img { width: 80px; height: 80px; border-radius: 50%; margin-right: 15px; }
        a.botao { text-decoration: none; padding: 5px 10px; border-radius: 5px; color: #fff; }
        .editar { background: #3498db; }
        .excluir { background: #e74c3c; }
        form { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h2>Pokémons Encontrados</h2>
    <form method="GET" action="">
        <input type="text" name="pesquisa" placeholder="Pesquisar por nome" value="<?= htmlspecialchars($pesquisa) ?>">
        <button type="submit">Pesquisar</button>
    </form>
    <a href="cadastrar.php">+ Cadastrar Novo</a> | <a href="index.php">Início</a>
    <hr>

    <?php while ($row = $resultado->fetch_assoc()): ?>
        <div class="pokemon">
            <?php if ($row['foto']): ?>
                <img src="<?= $row['foto'] ?>" alt="<?= $row['nome'] ?>">
            <?php endif; ?>
            <div>
                <strong><?= $row['nome'] ?></strong> - <?= $row['tipo'] ?><br>
                Local: <?= $row['localizacao'] ?> | Data: <?= $row['data_registro'] ?><br>
                <a class="botao editar" href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                <a class="botao excluir" href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </div>
        </div>
    <?php endwhile; ?>
</body>
</html>
