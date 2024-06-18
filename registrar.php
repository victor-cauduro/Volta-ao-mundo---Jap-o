<?php
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    // Conectar ao banco de dados
    $pdo = new PDO('mysql:host=localhost;dbname=volta-ao-mundo', 'root', '');

    // Criptografar a senha
    $senhaCriptografada = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Preparar e executar a declaração para inserir o novo usuário
    $stmt = $pdo->prepare('INSERT INTO usuarios (nome,email, senha) VALUES (?, ?, ?)');
    $stmt->execute([$_POST['nome'], $_POST['email'], $senhaCriptografada]);
    
    // Redirecionar para a página de login ou exibir uma mensagem de sucesso
    echo 'Usuário registrado com sucesso!';
    // header('Location: login.php'); // Descomente esta linha para redirecionar
    exit;
}
?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<body class="d-flex justify-content-center align-items-center vh-100">
    <aside class="col-sm-4">
        <div class="card">
            <article class="card-body">
                <a href="login.php" class="float-right btn btn-outline-primary">Entrar</a>
                <h4 class="card-title mb-4 mt-1">Registrar</h4>
                <form action="registrar-entrar.php" method="post">
                    <div class="form-group">
                        <label>Novo Nome:</label>
                        <input name="nome" class="form-control" placeholder="Nome" type="text" required>
                    </div>
                    <div class="form-group">
                <label>E-mail:</label>
            <input name="email" class="form-control" placeholder="aaaa@aaaa.aa" type="email" required>

                    </div>

                    <div class="form-group">
                        <label>Nova Senha:</label>
                        <input name="senha" class="form-control" placeholder="******" type="password" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="registrar" class="btn btn-primary btn-block"> Registrar </button>
                    </div>
                </form>
            </article>
        </div>
    </aside>
</body>
