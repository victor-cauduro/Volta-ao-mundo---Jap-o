<?php
session_start();

// Verificar se o usuário é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['admin'] != 1) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['jsonFile'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=volta-ao-mundo', 'root', '');

    // Ler o arquivo JSON
    $jsonContent = file_get_contents($_FILES['jsonFile']['tmp_name']);
    $comentarios = json_decode($jsonContent, true);

    if ($comentarios) {
        foreach ($comentarios as $comentario) {
            // Verificar se o usuário já existe
            $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE nome = ? AND email = ?');
            $stmt->execute([$comentario['nome'], $comentario['email']]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Se o usuário não existir, criar um novo
            if (!$usuario) {
                $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email) VALUES (?, ?)');
                $stmt->execute([$comentario['nome'], $comentario['email']]);
                $usuario_id = $pdo->lastInsertId();
            } else {
                $usuario_id = $usuario['id'];
            }

            // Inserir o comentário na tabela de comentários
            $stmt = $pdo->prepare('INSERT INTO comentarios (usuario_id, comentario, aprovado) VALUES (?, ?, "pendente")');
            $stmt->execute([$usuario_id, $comentario['comentario']]);
        }
    echo "<script>alert('Comentários importados com sucesso');</script>";
    echo "<script>window.location = 'pagina-admin.php';</script>";    
    } else {
        echo 'Erro ao decodificar o arquivo JSON.';
    }
} else {
    echo 'Erro no envio do arquivo.';
}
?>
