<?php
    $usuario = 'root';
    $senha = '';
    $database = 'inSiteMonitor';
    $host = 'localhost';

    $mysqli = new mysqli($host,$usuario,$senha,$database);
    if($mysqli->error){
        echo 'erro';
        die('Erro na conexão'.$mysqli->error);
    }
?>