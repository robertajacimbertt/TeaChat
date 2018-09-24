<?php
    include "bancoDeDados.php";
    $consulta = "SELECT * FROM chat ORDER BY id ASC";
    $executar = $conection->query($consulta);
    while($fila = $executar->fetch_array()):
?>
    <div id="datos-chat">
        <span style="color: #1c62c4;"><?php echo $fila['nome']; ?>: </span>
        <span style="color: #848484;"> <?php echo $fila['mensagem']; ?></span>
        <span style="float: right;"><?php echo $fila['data']; ?></span>
    </div>
<?php endwhile; ?>
