<?php
// Conexão com o banco de dados
include_once('conexao.php');

// Consulta para obter os dados das máquinas
$sql = "SELECT * FROM machines";
$result = $conn->query($sql);

// Função para obter o caminho da imagem com base no status
function getImagePath($status) {
    switch ($status) {
        case 'running':
            return 'images/running.png';
        case 'stopped':
            return 'images/stopped.png';
        case 'maintenance':
            return 'images/maintenance.png';
        default:
            return 'images/unknown.png';
    }
}

// Exibir os resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2>Máquina: " . $row["name"] . "</h2>";
        echo "<p>Status: " . $row["status"] . "</p>";
        echo "<img src='" . getImagePath($row["status"]) . "' alt='" . $row["status"] . "' width='100'>";
        echo "<hr>";
    }
} else {
    echo "Nenhuma máquina encontrada.";
}

$conn->close();
?>