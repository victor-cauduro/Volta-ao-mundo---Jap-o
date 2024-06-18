<!DOCTYPE html>
<html lang="en">
<?php
session_start()
?>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pratos Típicos</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/estilo.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="index.php">Volta ao Mundo - Japão</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="index.php">Volta ao Mundo - Japão</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="inforgerais.php">Informações Gerais</a></li>
                        <li class="nav-item"><a class="nav-link" href="cultura.php">Cultura</a></li>
                        <li class="nav-item"><a class="nav-link" href="pratos.php">Pratos Típicos</a></li>
                        <li class="nav-item"><a class="nav-link" href="Pturisticos.php">Pontos Turísticos</a></li>
                        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == true): ?>
                            <li class="nav-item"><a class="nav-link" href="pagina-admin.php">Administração</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                            <li class="nav-item"><a class="nav-link" href="novo-comentario.php">Comentar</a></li>

                <?php elseif(isset($_SESSION['nome']) && $_SESSION['nome'] == true): ?>
                    <li class="nav-item"><a class="nav-link" href="novo-comentario.php">Comentar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    </nav>
        <style>
    .bg-image {
        background: 
            linear-gradient(
                rgba(0, 0, 0, 0.5), 
                rgba(0, 0, 0, 0.5)
            ),
            url('img/pratos1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
        </style>
        <header class="bg-image">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">PRATOS TÍPICOS</h1>
                <a class="btn btn-lg btn-light" href="#about">CONHECER!</a>
            </div>
        </header>
        <style>
            .img-fluid {
                width: 100%;
                height: auto;
            }
        </style>
        
        <section id="about">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Sushi</h2>
                        <p class="lead">Feito a partir de alga marinha desidratada (nori), arroz temperado levemente com vinagre, que é recheado com ingredientes variados, como pedacinhos de peixe cru, omelete, cenoura, entre outros.</p>
                        <img src="img/pratos2.jpg" class="img-fluid" alt="Descrição da imagem">
                    </div>
                </div>
            </div>
        </section>
        
        <section class="bg-light" id="services">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Ramen</h2>
                        <p class="lead">Um prato de macarrão servido em caldo de carne ou peixe, frequentemente temperado com molho de soja ou miso, e usa vários tipos de ingredientes, como carne de porco fatiada, nori (algas marinhas) e cebolinha.</p>
                                                <img src="img/japao3.png" class="img-fluid" alt="Descrição da imagem">

                    </div>
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Takoyaki</h2>
                        <p class="lead"> É um prato popular de rua no Japão, conhecido por suas bolas de massa recheadas com polvo. É servido com uma variedade de coberturas, que podem incluir molho de takoyaki, maionese, flocos de bonito (raspas de peixe seco), e aonori (alga marinha seca)</p>
                                                <img src="img/japao4.jpg" class="img-fluid" alt="Descrição da imagem">

                    </div>
                </div>
            </div>
        </section>
        <div class="container px-4 text-center">
    <?php if(isset($_SESSION['nome']) && $_SESSION['nome'] == true): ?>
        <a href="novo-comentario.php" class="btn btn-primary btn-lg" role="button">Quer comentar? Clique aqui e comente já!</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-primary btn-lg" role="button">Quer comentar? Clique aqui e comente já!</a>
    <?php endif; ?>
</div>

        <div class="container px-4 text-center">
    <h2>Comentários</h2>
    <div class="row">
    <?php
// Parâmetros de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "volta-ao-mundo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inicialize a variável de pesquisa
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Prepare a consulta SQL com uma condição opcional de pesquisa
    $sql = "
        SELECT u.nome, c.comentario
        FROM comentarios c
        INNER JOIN usuarios u ON c.usuario_id = u.id
        WHERE c.aprovado = 'aprovado'
    ";

    // Se houver um termo de pesquisa, adicione uma cláusula WHERE para filtrar pelo nome
    if ($search !== '') {
        $sql .= " AND u.nome LIKE :search";
    }

    $sql .= " ORDER BY c.data_comentario DESC";

    $stmt = $conn->prepare($sql);

    // Se houver um termo de pesquisa, vincule o parâmetro à consulta
    if ($search !== '') {
        $stmt->bindValue(':search', '%' . $search . '%');
    }

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $comentarios = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Comentários Centralizados</title>

    <style>
        body{
            margin-top:20px;
            background:#eee;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .media-comment {
            margin-top:30px
        }
        .g-mb-30 {
            margin-bottom: 30px;
        }
        .g-pa-30 {
            padding: 25px 290px;
        }
        .g-bg-secondary {
            background-color: #fafafa;
        }
        .u-shadow-v18 {
            box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

<div id="comentarios" class="container">
<form action="#comentarios" method="get">
    <input type="text" name="search" placeholder="Procurar por nome">
    <button type="submit">Procurar</button>
</form>
    <?php
    if(count($comentarios) > 0) {
        foreach ($comentarios as $row) {
            echo "<div class='media g-mb-30 media-comment'>";
            echo "<div class='media-body u-shadow-v18 g-bg-secondary g-pa-30'>";
            echo "<div class='g-mb-15'>";
            echo "<h5 class='h5 g-color-gray-dark-v1 mb-0'>" . htmlspecialchars($row["nome"]) . "</h5>";
            echo "</div>";
            echo "<p>" . htmlspecialchars($row["comentario"]) . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Ainda não há comentários.</p>";
    }
    ?>
</div>
</body>
</div>
</div>
<footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Victor Chagas 2024</p></div>
        </footer>

</html>
