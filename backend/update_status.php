<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
include_once('conexao.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['machine_id']) && isset($data['status'])) {
    $machine_id = $conn->real_escape_string($data['machine_id']);
    $status = $conn->real_escape_string($data['status']);

    // Atualizar o status da máquina
    $sql = "UPDATE machines SET status = '$status' WHERE id = $machine_id";
    if ($conn->query($sql) === TRUE) {
        // Registrar a mudança no histórico
        $sql = "INSERT INTO status_history (machine_id, status) VALUES ($machine_id, '$status')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao registrar histórico: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar status: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
}

$conn->close();
?>