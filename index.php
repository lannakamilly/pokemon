<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pokémons Perdidos</title>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: url('https://wallpapers.com/images/hd/blue-gradient-background-07xqmk2r9n9vmxli.jpg') no-repeat center center/cover;
      position: relative;
      color: #fff;
      overflow-x: hidden;
    }

    /* Overlay escuro */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(3px);
      z-index: 0;
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

    /* CONTEÚDO CENTRAL */
    .container {
      text-align: center;
      position: relative;
      z-index: 1;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    /* Pokébola animada */
    .pokeball {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      border: 5px solid #fff;
      background: linear-gradient(to bottom, #ff1c1c 50%, #ffffff 50%);
      position: relative;
      margin: 0 auto 20px;
      box-shadow: 0 0 25px rgba(255,255,255,0.9);
      animation: spin 3s linear infinite;
    }
    .pokeball::after {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background: #fff;
      border: 5px solid #000;
      z-index: 2;
    }
    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* Título com brilho */
    h1 {
      font-size: 3rem;
      color:#feca02;
      text-shadow: 3px 3px 0 #000, 6px 6px 0 rgba(0,0,0,0.3);
      margin-bottom: 15px;
      animation: glow 2s infinite alternate;
    }
    @keyframes glow {
      from { text-shadow: 3px 3px 0 #000, 6px 6px 15px #3498db; }
      to { text-shadow: 3px 3px 0 #000, 6px 6px 30px #3498db; }
    }

    p {
      font-size: 1.3rem;
      color: #eee;
      margin-bottom: 30px;
      max-width: 600px;
    }

    /* Responsivo */
    @media (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }
      p {
        font-size: 1rem;
      }
      .pokeball {
        width: 100px;
        height: 100px;
      }
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

<!-- CONTEÚDO CENTRAL -->
<div class="container">
  <div class="pokeball"></div>
  <h1>Bem-vindo, Treinador!</h1>
  <p>Registre e encontre Pokémons perdidos na cidade de Caçapava com um sistema rápido e prático.</p>
</div>

<script>
  function toggleMenu() {
    document.getElementById('nav-links').classList.toggle('active');
  }
</script>

</body>
</html>
