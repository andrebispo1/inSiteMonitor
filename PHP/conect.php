<?php
    try {
        $dns = "mysql:dbname=insitemonitor;host=localhost";
        $dbUser = "root";
        $dbPass = "";
    
        $pdo = new PDO($dns, $dbUser, $dbPass);
        // echo "<h1> Conectado ao Banco de Dados </h1>";
    } catch (\PDOException $error) {
        echo "<h1> Banco de Dados Indisponivel, Tente Mais Tarde </h1>";
    }
?>