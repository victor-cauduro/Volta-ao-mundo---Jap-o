<!DOCTYPE html>
<html lang="en">
<?php
session_start()
?>
<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="d-flex flex-column min-vh-100">
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
                            <li class="nav-item"><a class="nav-link" href="administração.php">Administração</a></li>
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
</html>

<?php

// Ver se o usuário é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['admin'] != 1) {
    echo 'Você não tem permissão para acessar esta página.';
    header('Location: login.php');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=volta-ao-mundo', 'root', '');

// Aprovar ou reprovar comentário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['aprovar'])) {
        $stmt = $pdo->prepare('UPDATE comentarios SET aprovado = "aprovado" WHERE id = ?');
        $stmt->execute([$_POST['comentario_id']]);
    } elseif (isset($_POST['reprovar'])) {
        $stmt = $pdo->prepare('UPDATE comentarios SET aprovado = "reprovado" WHERE id = ?');
        $stmt->execute([$_POST['comentario_id']]);
    }
}

// Buscar comentários pendentes
$stmt = $pdo->prepare('SELECT * FROM comentarios WHERE aprovado = "pendente"');
$stmt->execute();
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administração</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Comentários Pendentes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Comentário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comentarios as $comentario): ?>
            <tr>
                <td><?php echo $comentario['id']; ?></td>
                <td><?php echo $comentario['comentario']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="comentario_id" value="<?php echo $comentario['id']; ?>">
                        <button type="submit" name="aprovar" class="btn btn-success">Aprovar</button>
                        <button type="submit" name="reprovar" class="btn btn-danger">Reprovar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2>Importar Comentários</h2>
    <form action="importar-comentarios.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="jsonFile">Arquivo JSON:</label>
            <input type="file" class="form-control-file" id="jsonFile" name="jsonFile" required>
        </div>
        <button type="submit" class="btn btn-primary">Importar Comentários</button>
    </form>
</div>



</body>
</html>
