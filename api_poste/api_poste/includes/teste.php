<?php
require_once 'DbConnect.php';

$db = new DbConnect();
$connection = $db->connect();

if ($connection) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Falha na conexão!";
}
?>
