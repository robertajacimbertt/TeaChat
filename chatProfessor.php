<?php
    include "bancoDeDados.php";
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

    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();

            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            
            req.open('GET', 'chat.php', true);
            req.send();
        }

        //linha que faz a atualização da página para cada segundo
        setInterval(function(){ajax();}, 1000);    

    </script>

</head>
<body onload="ajax();">

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

        $idProfessor = $_GET["id"];
        $nomeProfessor = $_GET["nome"];
        $aux = [];
        $msg = [];

        $connection = mysqli_connect($hostname, $dbuser, $dbpass, $db);

        if($connection){
            $sql = "SELECT * FROM chat where nomeProfessor = '$nomeProfessor';";
            $resultados = mysqli_query($connection, $sql);
            $resultadoAux = $resultados;
            $i = 0;
            while ($row = $resultados->fetch_assoc()) {
                $aux[$i] = $row["nomeAluno"];
                $msg[$i]["nome"] = $row["nomeAluno"];
                $msg[$i]["mensagem"] = $row["mensagem"];
                $i++;
            }
            $alunos = array_unique($aux);
            
            //foreach ($alunos as &$chat) {
            //    echo "<div class='toggle-box'><h3 class='toggle header'><a  href='#'>$chat</a></h3><div class='content'><strong>Product Features:</strong><br /> <ul><li>Feature 1</li><li>Feature 1</li><li>Feature 1</li></ul></div></div>";
                
            //}
            

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

    <?php foreach ($alunos as &$chat){ ?>
        <div class="toggle-box">
            <h3 class="toggle header"><a  href="#">Chat com <?=$chat?></a></h3>
            <div class="content">
                <ul>
                    <?php foreach ($msg as $item) {
                        if ($chat === $item["nome"]){?>
                            <li><?=$item["mensagem"]?></li>
                    <?php } }?>
                </ul>
                <input type="text" name="" id="">
            </div>
        </div> 
    <?php } ?>
    <div id="contenedor">
        <div id="caja-chat">
            <div id="chat"></div>
        </div>
                            <?php $string = "chatProfessor.php?id=".$idProfessor."&nome=".$nomeProfessor ?>
        <form method="POST" action=<?=$string?>>
            <input type="text" name="nombre" placeholder="Ingresa tu nombre">
            <textarea name="mensaje" placeholder="Ingresa tu mensaje"></textarea>
            <input type="submit" name="enviar" placeholder="Enviar">
        </form>
        <?php
            if(isset($_POST['enviar'])){
                $nome = $_POST['nombre'];
                $mensagem = $_POST['mensaje'];

                $consulta = "INSERT INTO chat(id_de, mensagem, nomeProfessor) VALUES ('$idProfessor', '$mensagem', '$nomeProfessor')";
                
                $executar = $conection->query($consulta);
                
                if($executar){
                    echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
                }
            }
        ?>
    </div>

</body>
</html>

<!--if( $row["nomeAluno"] === $chat){-->