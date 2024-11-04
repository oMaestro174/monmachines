<?php
$host = 'easy.taguardado.net';  // Nome do serviço do MySQL no docker-compose.yml
$user = 'root';
$password = 'Mudar@123!';
$database = 'machine_monitoring';

// Tenta se conectar ao banco de dados
$conn = mysqli_connect($host, $user, $password, $database);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    echo "Error Conection: " . mysqli_connect_error();
} 
