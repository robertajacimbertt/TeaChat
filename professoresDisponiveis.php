<?php
    include "bancoDeDados.php";
    $idAluno = $_GET["ia"];
    $idMateria = $_GET["id"];
    $nomeAluno = $_GET["na"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <link rel="stylesheet" href="./style/bulma-timeline.min.css">
    <link rel="stylesheet" href="./style/estilo.css">
    <link rel="stylesheet" href="./style/chatProfessor.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <script src="./scripts/jquery-3.3.1.min.js"></script>
    <script src="./scripts/index.js"></script>
    <title>Chat</title>
    <link href="https://fonts.googleapis.com/css?family-Mukta+Vaani" rel="stylesheet">
</head>
<body>

<nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="">
                <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu navbar-end">
            <div class="navbar-item">
                <a class="navbar-item">Sair</a>
            </div>
        </div>
    </nav>
    <?php
    
        ini_set('display_errors',1);
        ini_set('display_startup_erros',1);
        error_reporting(E_ALL);

        $hostname = 'localhost';
        $dbuser = 'root';
        $dbpass = '123';
        $db = 'teachat';

        $professores = [];

        $connection = mysqli_connect($hostname, $dbuser, $dbpass, $db);

        if($connection){
            $sql = "SELECT * FROM professores inner join materiaProfessor on professores.idProfessor = materiaProfessor.idProfessor where materiaProfessor.idMateria = '$idMateria';";
            $resultadosProfessores = mysqli_query($connection, $sql);
            $i = 0;
            while ($row = $resultadosProfessores->fetch_assoc()) {
                $professores[$i]["nome"] = $row["nome"];
                $professores[$i]["idProfessor"] = $row["idProfessor"];
                $i++;
            }
            if(sizeof($professores) <= 0){
                echo "Voce ainda nao possui mensagens";
            } 
        } else {
            echo "Nao foi possivel acessar o banco";
        }
    ?>   

    <script>
        (function($) {
            $(function() {
            $("html").toggleClass("no-js js");
            $(".toggle-box .toggle").click(function(e) {
                e.preventDefault();
                $(this)
                    .next(".content")
                    .slideToggle();
                });
            });
        })(jQuery);
    </script>

    <?php foreach ($professores as &$chat){ ?>
        <div class="toggle-box">
            <h3 class="toggle header"><a  href="#">Chat com <?=$chat['nome']?></a></h3>
            <div class="content">
                <ul>
                    <?php 
                        $nomeProfessor = $chat['nome'];
                        $idProfessor = $chat['idProfessor'];
                        $stringGet = "chatAluno.php?ia=".$idAluno."&na=".$nomeAluno."&ip=".$idProfessor."&np=".$nomeProfessor;
                         ?>
                </ul>
                <form name="formConversa" action=<?=$stringGet?> method="POST">
                    <input type="submit" name=<?=$idAluno?> />
                </form>
            </div>
        </div> 
    <?php } ?>
</body>
</html>
