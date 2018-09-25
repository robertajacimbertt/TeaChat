<?php
    include "bancoDeDados.php";
    $idAluno = $_GET["ia"];
    $nomeAluno = $_GET["na"];
    $idProfessor = $_GET["ip"];
    $nomeProfessor = $_GET["np"];
    $stringGet = "chatParte2Aluno.php?ia=".$idAluno."&na=".$nomeAluno."&ip=".$idProfessor."&np=".$nomeProfessor;
    $stringGetChat = "chatAluno.php?ia=".$idAluno."&na=".$nomeAluno."&ip=".$idProfessor."&np=".$nomeProfessor;
?>

<!DOCTYPE html>
<html>
<head>
    <title> CHAT TEACHAT </title>
    <link rel="stylesheet" type="text/css" href="style/styleChat.css">
    <link href="https://fonts.googleapis.com/css?family-Mukta+Vaani" rel="stylesheet">
    <script type="text/javascript">
        function ajax(){
            console.log("<?=$nomeAluno?>");
            var req = new XMLHttpRequest();
            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET', "<?=$stringGet?>", true);
            req.send();
        }
        //linha que faz a atualização da página para cada segundo
        setInterval(function(){ajax();}, 1000);    
    </script>
</head>
<body onload="ajax();">

    <div id="contenedor">
        <div id="caja-chat">
            <div id="chat"></div>
        </div>

        <form method="POST" action=<?=$stringGetChat?>>
            <textarea name="mensaje" placeholder="Digite sua mensagem..."></textarea>
            <input type="submit" name="enviar" placeholder="Enviar">
        </form>
        <?php
            $idAluno = $_GET["ia"];
            $nomeAluno = $_GET["na"];
            $idProfessor = $_GET["ip"];
            $nomeProfessor = $_GET["np"];
            if(isset($_POST['enviar'])){
                $mensagem = $_POST['mensaje'];
                $consulta = "INSERT INTO chat (id_de, id_para, mensagem, nomeAluno, nomeProfessor, idAluno) VALUES ('$idAluno', '$idProfessor', '$mensagem', '$nomeAluno', '$nomeProfessor', '$idAluno');";
                $executar = $conection->query($consulta);
                if($executar){
                    echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
                }
            }
        ?>
    </div>

</body>
</html>
