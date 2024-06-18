<?php
session_start();

// Verificar se o formulário de registro foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'], $_POST['senha'])) {
    // Conectar ao banco de dados
    $pdo = new PDO('mysql:host=localhost;dbname=volta-ao-mundo', 'root', '');

    // Verificar se o nome de usuário já existe
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE nome = ?');
    $stmt->execute([$_POST['nome']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        echo 'Nome de usuário já existe. Escolha outro nome.';
    } else {
        // Criptografar a senha
        $senhaCriptografada = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Preparar e executar a declaração para inserir o novo usuário
        $stmt = $pdo->prepare('INSERT INTO usuarios (nome,email, senha) VALUES (?, ?, ?)');
        $stmt->execute([$_POST['nome'], $_POST['email'], $senhaCriptografada]);

        // Redirecionar para a página de login ou exibir uma mensagem de sucesso
    echo "<script>alert('usuario registrado com sucesso');</script>";
    echo "<script>window.location = 'login.php';</script>";    
        exit;
    }
} else {
    echo 'Erro no envio do formulário.';
}
?>
