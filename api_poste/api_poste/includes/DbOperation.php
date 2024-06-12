<?php
require_once 'DbConnect.php';

class DbOperation {
    private $con;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';

        $db = new DbConnect();
        $this->con = $db->connect();
    }

    // Método para criar um novo usuário
    function createUser($login, $senha) {
        $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->con->prepare("INSERT INTO Usuarios (login, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $login, $hashedPassword);
        if ($stmt->execute())
            return true; 
        return false; 
    }

    // Método para verificar as credenciais do usuário
    function userLogin($login, $senha) {
        $stmt = $this->con->prepare("SELECT senha FROM Usuarios WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();
            if (password_verify($senha, $hashedPassword)) {
                return true;
            }
        }
        return false;
    }

    // Method to create a new poste
    function createPoste($localizacao, $status, $ultima_manutencao, $distrito, $zona) {
        $stmt = $this->con->prepare("INSERT INTO Postes (localizacao, status, ultima_manutencao, distrito, zona) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $localizacao, $status, $ultima_manutencao, $distrito, $zona);
        if ($stmt->execute())
            return true; 
        return false; 
    }

    // Method to get all postes
    function getPostes() {
        $stmt = $this->con->prepare("SELECT id, localizacao, status, ultima_manutencao, distrito, zona FROM Postes");
        $stmt->execute();
        $stmt->bind_result($id, $localizacao, $status, $ultima_manutencao, $distrito, $zona);

        $postes = array(); 

        while($stmt->fetch()){
            $poste  = array();
            $poste['id'] = $id; 
            $poste['localizacao'] = $localizacao; 
            $poste['status'] = $status; 
            $poste['ultima_manutencao'] = $ultima_manutencao; 
            $poste['distrito'] = $distrito; 
            $poste['zona'] = $zona; 

            array_push($postes, $poste); 
        }

        return $postes; 
    }
}
?>


