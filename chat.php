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
    <title>Document</title>
</head>
<body>
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

        $connection = mysqli_connect($hostname, $dbuser, $dbpass, $db);

        if($connection){
            $sql = "SELECT * FROM chat where nomeProfessor = '$nomeProfessor';";
            $resultados = mysqli_query($connection, $sql);
            $i = 0;
            while ($row = $resultados->fetch_assoc()) {
                $aux[$i] = $row["nomeAluno"];
                $i++;
            }
            $alunos = array_unique($aux);
            //var_dump($alunos);
  
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
            <div class="content"><br />
                <ul>
                    <?php foreach ($alunos as &$chat){ ?>
                        <li>Feature 1</li>
                        <li>Feature 1</li>
                        <li>Feature 1</li>
                    <?php } ?>
                </ul>
            </div>
        </div> 
    <?php } ?>

</body>
</html>