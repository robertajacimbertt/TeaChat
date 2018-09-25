<?php
    include "bancoDeDados.php";
    $idAluno = $_GET["ia"];
    $nomeAluno = $_GET["na"];
    $idProfessor = $_GET["ip"];
    $nomeProfessor = $_GET["np"];
    $consulta = "SELECT * FROM chat where idAluno = '$idAluno' and nomeProfessor = '$nomeProfessor' ORDER BY id ASC";
    $executar = $conection->query($consulta);
    while($fila = $executar->fetch_array()):
?>
    <div id="datos-chat">
        <span style="color: #848484;"> <?php echo $fila['mensagem']; ?></span>
        <span style="float: right;"><?php echo $fila['data']; ?></span>
    </div>
<?php endwhile; ?>
