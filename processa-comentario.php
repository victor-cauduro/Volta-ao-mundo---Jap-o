<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    // Redirecionar para a página de login se não estiver logado
    header('Location: login.php');
    exit;
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario'])) {
    // Conectar ao banco de dados
    $pdo = new PDO('mysql:host=localhost;dbname=volta-ao-mundo', 'root', '');

    // Preparar e executar a declaração para inserir o novo comentário
    $stmt = $pdo->prepare('INSERT INTO comentarios (usuario_id, comentario, aprovado) VALUES (?, ?, ?)');
    $stmt->execute([$_SESSION['usuario_id'], $_POST['comentario'], 'pendente']);

    // Redirecionar para uma página de confirmação ou exibir uma mensagem de sucesso
    echo "<script>alert('Comentário postado com sucesso e aguardando aprovação');</script>";
    echo "<script>window.location = 'index.php';</script>";    
    exit;
} else {
    echo 'Erro no envio do comentário.';
}
?>
