<?php
require_once 'DbOperation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    $login = $data->login;
    $senha = $data->senha;

    $db = new DbOperation();
    $response = array();

    if ($db->userLogin($login, $senha)) {
        session_start();
        $_SESSION['login'] = $login;

        $response['error'] = false;
        $response['message'] = 'Login successful';
    } else {
        $response['error'] = true;
        $response['message'] = 'Invalid login or password';
    }

    echo json_encode($response);
}
?>
