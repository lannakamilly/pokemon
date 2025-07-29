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
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            color: #fff;
        }
/* Navbar Principal */
.navbar {
  background: #1f4e79;
  padding: 10px 20px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  position: sticky;
  top: 0;
  z-index: 1000;
}

/* Container da Nav */
.nav-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

/* Logo */
.logo img {
  height: 50px;
}

/* Links Desktop */
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

/* Botão Menu Mobile */
.menu-toggle {
  background: none;
  border: none;
  color: #fff;
  font-size: 30px;
  cursor: pointer;
  display: none;
}

/* Responsividade */
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

        header {
            text-align: center;
            padding: 20px;
            background:rgb(64, 131, 193);
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            text-shadow: 2px 2px #000;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        /* Pesquisa */
        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-box input {
            width: 50%;
            padding: 12px;
            border-radius: 30px;
            border: 3px solid #1f4e79;
            font-size: 16px;
            outline: none;
            text-align: center;
        }
        .search-box button {
            padding: 12px 25px;
            margin-left: 10px;
            background: #1f4e79;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .search-box button:hover {
            background: #163955;
        }

        /* Grid fixa para cards */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
        }

        /* Card estilo moderno com toque Pokémon */
        .card {
            background: #fff;
            border: 4px solid #2980b9;
            border-radius: 20px;
            text-align: center;
            padding: 20px;
            transition: 0.3s;
            box-shadow: 0 6px 10px rgba(0,0,0,0.3);
            color: #333;
            height: 350px; /* FIXA altura */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 18px rgba(0,0,0,0.4);
        }

        /* Imagem central fixa */
        .card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #1f4e79;
            margin: 0 auto 10px;
            background: #fff;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 20px;
            color: #2c3e50;
        }

        .card p {
            margin: 3px 0;
            font-size: 14px;
            color: #555;
        }

        /* Botões dentro do card */
        .actions {
            margin-top: 10px;
        }
        .btn {
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            margin: 0 5px;
            font-size: 14px;
            color: #fff;
            transition: 0.3s;
        }
        .btn-editar {
            background: #3498db;
        }
        .btn-excluir {
            background: #e74c3c;
        }
        .btn-editar:hover { background: #2980b9; }
        .btn-excluir:hover { background: #c0392b; }

        /* Links topo */
        .top-links {
            text-align: center;
            margin-bottom: 20px;
        }
        .top-links a {
            color: #fff;
            margin: 0 15px;
            font-weight: bold;
            text-decoration: none;
            font-size: 18px;
        }
        .top-links a:hover {
            text-decoration: underline;
        }

        /* Responsivo */
        @media (max-width: 600px) {
            .search-box input {
                width: 80%;
            }
            .card {
                height: auto;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
  <div class="nav-container">
    <a href="index.php" class="logo">
      <img src="https://upload.wikimedia.org/wikipedia/commons/9/98/International_Pokémon_logo.svg" alt="Pokémon Logo">
    </a>

    <!-- Botão Menu Mobile -->
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>

    <!-- Links de Navegação -->
    <ul class="nav-links" id="nav-links">
      <li><a href="index.php">Início</a></li>
      <li><a href="cadastrar.php">Cadastrar</a></li>
      <li><a href="listar.php">Pokémons</a></li>
      <li><a href="relatorio.php">Relatório</a></li>
    </ul>
  </div>
</nav>

    
    <header>Pokémons Encontrados</header>
    <div class="container">

        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="pesquisa" placeholder="Pesquise por nome do Pokémon..." value="<?= htmlspecialchars($pesquisa) ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>

 
        <div class="grid">
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <div class="card">
                    <?php if ($row['foto']): ?>
                        <img src="<?= $row['foto'] ?>" alt="<?= $row['nome'] ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/120" alt="Sem foto">
                    <?php endif; ?>
                    <h3><?= $row['nome'] ?></h3>
                    <p><strong>Tipo:</strong> <?= $row['tipo'] ?></p>
                    <p><strong>Local:</strong> <?= $row['localizacao'] ?></p>
                    <p><strong>Data:</strong> <?= $row['data_registro'] ?></p>

                    <div class="actions">
                        <a class="btn btn-editar" href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                        <a class="btn btn-excluir" href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script>
  function toggleMenu() {
    document.getElementById('nav-links').classList.toggle('active');
  }
</script>

</body>
</html>
