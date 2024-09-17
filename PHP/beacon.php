<?php
    // Validar o Login

session_start();
require 'conect.php';

if(isset($_SESSION['banco'])){

    $id = $_SESSION['banco'];

    if($_SESSION['permissao'] == 0){
        $sql = "SELECT * FROM usuarios WHERE user_id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        
    }else if($_SESSION['permissao'] == 1){
        $sql = "SELECT * FROM masters WHERE master_id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        
    }

    $sql->execute();

    if($sql->rowCount() > 0){
        $dados = $sql->fetch();

        if($_SESSION['permissao'] == 0){
            $nome = $dados['user_name'];
        }else if($_SESSION['permissao'] == 1){
            $nome = $dados['master_name'];
        }
    }

}else{
    header("Location:login.php");
    exit;
}

if(isset($_POST['sair'])) {
    // Limpa a sessão
    session_unset();
    session_destroy();
    // Redireciona para a página de login
    header("Location:login.php");
    exit;
}

?>

<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="../CSS/beaconcss.css">
    <link rel="stylesheet" type="text/css" href="../CSS/allcss.css">
   
    <title>SLA</title>
</head>

<body>

<main>
        <nav>

            <ul class="menu-ul">

                <div id="logo-img"><img src="/css/imagens/logo.png" alt=""></div>
                <li><a class="menu-ancora" href="#">Sair</a></li>
                <li><a class="menu-ancora" href="#">Gateway</a></li>
                <li><a class="menu-ancora" href="#">Beacon</a></li>
                <li><a class="menu-ancora" href="#">Adicionar</a></li>
            </ul>
        </nav>
    </main>


        <div id="sairLogin">
            <form action="" method="POST">
                <h1>Deseja realmente desconectar?</h1>
                <button name="sair">SIM</button>
                <button onclick="naoSair()">NÃO</button>
            </form>
        </div>

    <div class="fundoBeacons" id="idBeacs">
        
    </div>

    <footer class="rodape">
        <p>&#169 Cooperation &nbsp | &nbsp 2024 &nbsp </p>
        <img src="/css/imagens/logo.png" alt="">
    </footer>


    <script>
          document.addEventListener("DOMContentLoaded", function() {
                // Função para carregar as informações das áreas
                function loadBeacs() {
                    var beac = document.getElementById('idBeacs');
                    var xhr = new XMLHttpRequest();
                    
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            beac.innerHTML = xhr.responseText;
                        }
                    };
                    
                    xhr.open("GET", "dashBeac.php", true); // Substitua "dashGate.php" pelo URL do seu script PHP que retorna o conteúdo desejado
                    xhr.send();
                }

                // Chama a função para carregar as áreas quando a página é carregada
                loadBeacs();

                // Configura o intervalo de atualização automática a cada 1 segundo
                setInterval(loadBeacs, 7000);
            });

            var confirma = document.getElementById("sairLogin");
            confirma.style.display = "none";

            var beacs = document.getElementById("idBeacs");

            function sair(){
                beacs.style.display = "none";
                confirma.style.display = "table";
            }   
                function naoSair(){
                    beacs.style.display = "table";
                    confirma.style.display = "none";
                }

        </script>
</body>
</html>