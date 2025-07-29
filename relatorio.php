<?php
include 'conexao.php';

$sql = "SELECT tipo, COUNT(*) AS total FROM pokemons GROUP BY tipo";
$resultado = $conn->query($sql);

$tipos = [];
$quantidades = [];

while ($row = $resultado->fetch_assoc()) {
    $tipos[] = $row['tipo'];
    $quantidades[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Pokémons</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* NAVBAR */
        .navbar {
            background: #1f4e79;
            padding: 10px 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        /* CONTEÚDO RELATÓRIO */
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            color: #333;
            border-radius: 15px;
            padding: 20px;
        }
        h2 {
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        th {
            background: #2980b9;
            color: #fff;
        }
        canvas {
            max-width: 600px;
            margin: auto;
        }
        a.voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #2980b9;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
        }
        a.voltar:hover {
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

<!-- CONTEÚDO DO RELATÓRIO -->
<div class="container">
    <h2>Quantos Pokémons de cada tipo foram encontrados?</h2>

    <table>
        <tr>
            <th>Tipo</th>
            <th>Quantidade</th>
        </tr>
        <?php foreach ($tipos as $i => $tipo): ?>
            <tr>
                <td><?= $tipo ?></td>
                <td><?= $quantidades[$i] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <canvas id="grafico"></canvas>

    <a href="index.php" class="voltar">Voltar para Início</a>
</div>

<script>
    function toggleMenu() {
        document.getElementById('nav-links').classList.toggle('active');
    }

    const ctx = document.getElementById('grafico').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($tipos) ?>,
            datasets: [{
                data: <?= json_encode($quantidades) ?>,
                backgroundColor: [
                    '#3498db', '#e74c3c', '#2ecc71', '#f1c40f', '#9b59b6', '#1abc9c'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
</body>
</html>
