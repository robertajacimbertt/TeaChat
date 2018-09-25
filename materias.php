<?php
    $id = $_GET["id"];
    $nome = $_GET["nome"];
    $aux = [];
    $msg = [];
    $materia=0;
    
?>

<html>
    <head>
        <title> Disciplinas </title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
        <link rel="stylesheet" href="./style/bulma-timeline.min.css">
        <link rel="stylesheet" href="./style/estilo.css">
    </header>

    <body>
    <div class="cabecalho">
        <h1 class="h1"> Estas são as disciplinas disponíveis! </h1>
        <h2 class="h2"> Por favor, escolha uma disciplina para ver os professores disponíveis... </h2>
    </div>
    <section class="disciplinas-aluno">
        <div class="columns is-space is-space-lateral">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/matematica.png"> Matemática
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Matemática!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                            <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=1&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/portugues.png"> Português
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Português!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=2&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/history.png"> História
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de <br> História!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=3&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/geografia.png"> Geografia
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Geografia!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=4&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
        </div>

        <div class="columns is-space is-space-lateral">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/fisica.jpg"> Física
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de <br> Física!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=5&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/quimica.png"> Química
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Química!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=6&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/biologia.png"> Biologia
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Biologia!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=7&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/literatura.png"> Literatura
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Literatura!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=8&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
        </div>

        <div class="columns is-space is-space-lateral">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/filosofia.png"> Filosofia
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Filosofia!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=9&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/sociologia.png"> Sociologia
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Sociologia!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=10&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/ingles.gif"> Inglês
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de <br> Inglês!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=11&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <img src="./imagens/espanhol.png"> Espanhol
                        </p>
                        <p class="subtitle">
                            Tire suas dúvidas de Espanhol!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                        <span>
                                <?php $stringRedirect = "professoresDisponiveis.php?id=12&ia=".$id."&na=".$nome; ?>
                                <form action=<?=$stringRedirect?> method="POST">
                                    <input type="submit" name="acesar" value="Acessar">
                                </form>
                          	</span>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
