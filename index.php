<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TeaChat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <link rel="stylesheet" href="./style/bulma-timeline.min.css">
    <link rel="stylesheet" href="./style/estilo.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <script src="./scripts/jquery-3.3.1.min.js"></script>
    <script src="./scripts/index.js"></script>
</head>

<body>

    <?php
        ini_set('display_errors',1);
        ini_set('display_startup_erros',1);
        error_reporting(E_ALL);
        $nomeErr = $emailErr = $senhaErr = $confirmaSenhaErr = $nisErr = $materiaErr = "";
        $isActiveAluno = $isActiveProfessor = "";
        $nome = $email = $senha = $confirmaSenha = $nis = "";
        $materiasDoProfessor = [];
        $classErrorInput = "erroInativo";

        $hostname = 'localhost';
        $dbuser = 'root';
        $dbpass = '123';
        $db = 'teachat';

        if(isset($_POST['cadastrar-aluno']) or isset($_POST['cadastrar-professor'])){    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["nome"])) {
                    $nomeErr = "Nome é obrigatório";
                } else {
                    $nome = test_input($_POST["nome"]);
                    if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
                    $nomeErr = "Somente letras e espaços em branco são permitidos";
                    } 
                }
            
                if (empty($_POST["email"])) {
                    $emailErr = "Email é obrigatório";
                } else {
                    $email = test_input($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Formato de email inválido";
                    }
                }
                
                if (empty($_POST["senha"])) {
                    $senhaErr = "Senha é obrigatório";
                } else {
                    $senha = test_input($_POST["senha"]);
                    if (preg_match("/^[a-zA-Z ]*$/",$senha)) {
                        $senhaErr = "É necessário adicionar letras, caracteres e números";
                    }
                }

                if(empty($_POST["confirmaSenha"])){
                    $confirmaSenhaErr = "Ẽ necessário repetir a senha";
                } else {
                    $senha = test_input($_POST["senha"]);
                    if (preg_match("/^[a-zA-Z ]*$/",$senha)) {
                        $senhaErr = "É necessário adicionar letras, caracteres e números";
                    }
                    $confirmaSenha = test_input($_POST["confirmaSenha"]);
                    if($senha !== $confirmaSenha){
                        $confirmaSenhaErr = "As senhas devem ser iguais";
                    }
                }

                if(isset($_POST['cadastrar-aluno'])){
                    if(empty($_POST["nis"])){
                        $nisErr = "Ẽ necessário incluir o seu número do NIS";
                    } else {
                        $nis = test_input($_POST["nis"]);
                    }
                    if($nomeErr or $emailErr or $senhaErr or $confirmaSenhaErr or $nisErr){
                        $isActiveAluno = 'is-active';
                        $classErrorInput = "erroAtivo";
                    } else {
                        $connection = mysqli_connect($hostname, $dbuser, $dbpass, $db);
                        
                        if ($connection) {
                            $sqlBuscaAluno = "SELECT * FROM alunos where nome = '$nome' and email = '$email' and nis = '$nis' and senha = '$senha' ;";
                            $selectAlunos = mysqli_query($connection, $sqlBuscaAluno);
                            $row = mysqli_fetch_row($selectAlunos);
                            if(sizeof($row) <= 0){
                                $sql = "INSERT INTO alunos(nome, email, nis, senha) VALUES('$nome', '$email', '$nis', '$senha')";
                                $resultados = mysqli_query($connection, $sql);
                                if($resultados){
                                    header('Location: ./chat.php');
                                } else {
                                    //mostrar erro geral
                                    echo "Falhou na inclusao";
                                }
                            } else {
                                echo "Já existe alguem cadastrado com esse nome";
                            }
                        } else {
                            //mostrar erro geral
                            echo "<br/>não conectou no banco";
                        }   
                        mysqli_close($connection);
                    }

                } else if(isset($_POST['cadastrar-professor'])){

                    for($i=0;$i<sizeof($_POST["materia"]);$i++){
                        $materiasDoProfessor[$i] = $_POST["materia"][$i];
                    }

                    if(sizeof($materiasDoProfessor) <= 0){
                        $materiaErr = "Ao menos uma matéria deve ser selecionada";
                    } 

                    if($nomeErr or $emailErr or $senhaErr or $confirmaSenhaErr or $materiaErr){
                        $isActiveProfessor = 'is-active';
                        $classErrorInput = "erroAtivo";
                    } else {
                        $connection = mysqli_connect($hostname, $dbuser, $dbpass, $db);
                        if ($connection) {
                            $buscaProfessor = "SELECT * FROM professores where nome = '$nome' and email = '$email' and senha = '$senha' ;";
                            //mostrar erro geral
                            $results = mysqli_query($connection, $buscaProfessor);
                            $row = mysqli_fetch_row($results);
                            if(sizeof($row) <= 0){
                                $insereProfessor = "INSERT INTO professores(nome, email, senha) VALUES('$nome', '$email', '$senha');";
                                $resultadosP = mysqli_query($connection, $insereProfessor);
                                if($resultadosP){
                                    $buscaId = "SELECT id FROM professores where nome = '$nome' and email = '$email' and senha = '$senha' ;";
                                    $resultadoId = mysqli_query($connection, $buscaId);
                                    //falta buscar o ID do professor

                                    $sqlM = "INSERT INTO materiaProfessor(idProfessor, idMateria) VALUES";
                                    for($i=0;$i<sizeof($materiasDoProfessor);$i++){
                                        $sqlM = $sqlM."('3', '$materiasDoProfessor[$i]'),";
                                    }
                                    $size = strlen($sqlM);
                                    $sqlM = substr_replace($sqlM, ';', -1);
                                    $resultadosM = mysqli_query($connection, $sqlM);
                                    header('Location: ./chat.php');
                                } else {
                                    //mostrar erro geral
                                    echo "Falhou na inclusao";
                                }     
                            } else {
                                //mostrar erro geral
                                echo "já existe alguem cadastrado com esses dados";
                            }
                            
                        } else {
                            //mostrar erro geral
                            echo "<br/>não conectou no banco";
                        }   
                        mysqli_close($connection);
                    }
                }
            }

        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    ?>

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
        <div class="navbar-menu">
            <div class="navbar-item">
                <a class="navbar-item" id="botao-aluno">Aluno</a>
            </div>
            <div class="navbar-item">
                <a class="navbar-item" id="botao-professor">Professor</a>
            </div>
            <div class="navbar-item">
                <a class="navbar-item">Contato</a>
            </div>
        </div>
    </nav>

    <section class="hero is-primary is-medium is-space">
        <img class="imagemCapa" src="./imagens/capa4.png">
    </section>

    <div class="hero-foot">
        <nav class="tabs is-boxed is-fullwidth">
            <div class="container">
                <ul>
                    <li>
                        <a>Ver disciplinas disponíveis</a>
                    </li>
                    <li>
                        <a>Sobre</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="timeline is-centered is-space">
        <header class="timeline-header">
            <span class="tag is-medium is-primary">Bem Vindo!</span>
        </header>
        <div class="timeline-item is-warning">
            <div class="timeline-marker is-warning is-image is-32x32">
                <img src="http://bulma.io/images/placeholders/32x32.png">
            </div>
            <div class="timeline-content">
                <p class="heading heading-bigger">O que é o TeaChat?</p>
                <p>O Teacher Chat é um projeto voluntário onde os professores doam seu tempo para ajudar alunos de baixa renda na hora de estudar.</p>
                <p>Com ele é possivel tirar dúvidas e ensinar utilizando os recursos disponiveis na plataforma.</p>
            </div>
        </div>
        <div class="timeline-item is-warning">
            <div class="timeline-marker is-warning is-image is-32x32">
                <img src="http://bulma.io/images/placeholders/32x32.png">
            </div>
            <div class="timeline-content">
                <p class="heading heading-bigger">Para os alunos</p>
                <p>Escolha uma disciplina e um professor online para tirar dúvidas através de chats e video chamadas.</p>
            </div>
        </div>
        <div class="timeline-item is-primary">
            <div class="timeline-marker is-primary is-image is-32x32">
                <img src="http://bulma.io/images/placeholders/32x32.png">
            </div>
            <div class="timeline-content">
                <p class="heading heading-bigger">Para os professores</p>
                <p>Doe tempo para ensinar quem precisa.</p>
                <p> Existem muitos jovens que precisam do seu apoio.</p>
                <p>Seja ativo nesta causa: Educação muda o mundo!</p>
            </div>
        </div>
        <div class="timeline-item is-danger">
            <div class="timeline-marker is-danger is-image is-32x32">
                <img src="http://bulma.io/images/placeholders/32x32.png">
            </div>
            <div class="timeline-content">
                <p class="heading heading-bigger">Como usar?</p>
                <p>O acesso pode ser realizado atraves de qualquer dispositivo com acesso a internet.</p>
                <p>* Basta escolher entre Ensinar ou Aprender.</p>
                <p>* Fazer um cadastro e pronto! Já pode conversar.</p>
            </div>
        </div>
        <div class="timeline-item is-danger">
            <div class="timeline-marker is-danger is-image is-32x32">
                <img src="http://bulma.io/images/placeholders/32x32.png">
            </div>
            <div class="timeline-content">
                <p class="heading heading-bigger">Não pague nada ;)</p>
                <p>Este projeto não possui fins lucrativos</p>
                <p>Portanto todo o trabalho realizado pelos professores são voluntários</p>
            </div>
        </div>
        <header class="timeline-header">
            <span class="tag is-medium is-primary">Aproveite!</span>
        </header>
    </div>
    <section class="disciplinas">
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
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
										  <a href="https://twitter.com/codinghorror/status/506010907021828096">Ir!</a>
										</span>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                <strong>Trabalho Web - 6º Semestre</strong> <br>Por Evelyn Fernandes e Roberta Jacimbertt de Jesus. <br>

            </p>
        </div>
    </footer>
    <div class="modal <?=$isActiveAluno?>" id="modal-aluno">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="columns">
                <div class="column">
                    <p class="heading heading-bigger">Login</p>
                    <div class="field">
                        <div class="control">
                            <input class="input  is-login" type="text" placeholder="Email">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input   is-login" type="password" placeholder="Senha">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <a class="input  button is-small is-fullwidth  is-botao-modal">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <p class="heading heading-bigger">Cadastro</p>
                        <div class="field">
                            <div class="control">
                                <input class="input  is-cadastro " type="text" name="nome" placeholder="Nome">
                                <small class="<?=$classErrorInput?>"><?=$nomeErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="text" name="email" placeholder="Email">
                                <small class="<?=$classErrorInput?>"><?=$emailErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="text" name="nis" placeholder="Número do NIS">
                                <small class="<?=$classErrorInput?>"><?=$nisErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="password" name="senha" placeholder="Senha">
                                <small class="<?=$classErrorInput?>"><?=$senhaErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="password" name="confirmaSenha" placeholder="Confirmar Senha">
                                <small class="<?=$classErrorInput?>"><?=$confirmaSenhaErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input  button is-small is-fullwidth is-botao-modal" type="submit" name="cadastrar-aluno" value="Cadastrar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <button class="modal-close is-large" id="close-modal-aluno" aria-label="close"></button>
    </div>

    <div class="modal <?=$isActiveProfessor?>" id="modal-professor">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="columns">
                <div class="column">
                    <p class="heading heading-bigger">Login</p>
                    <div class="field">
                        <div class="control">
                            <input class="input  is-login" type="text" placeholder="Email">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input   is-login" type="password" placeholder="Senha">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <a class="input  button is-small is-fullwidth  is-botao-modal">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="column">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <p class="heading heading-bigger">Cadastro</p>
                        <div class="field">
                            <div class="control">
                                <input class="input  is-cadastro " type="text" name="nome" placeholder="Nome" value="<?=$nome?>">
                                <small class="<?=$classErrorInput?>"><?=$nomeErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="text" name="email" placeholder="Email">
                                <small class="<?=$classErrorInput?>"><?=$emailErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="1">Matemática</label>  
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="2">Português</label>
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="3">História</label>  
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="4">Geografia</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="5">Física</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="6">Química</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="7">Biologia</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="8">Literatura</label>  
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="9">Filosofia</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="10">Sociologia</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="11">Inglês</label> 
                                <label class="checkbox"><input type="checkbox" name="materia[]" value="12">Espanhol</label> 
                                <small class="<?=$classErrorInput?>"><?=$materiaErr?></small>
                            </div>
                        </div>                        
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="password" name="senha" placeholder="Senha">
                                <small class="<?=$classErrorInput?>"><?=$senhaErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input   is-cadastro" type="password" name="confirmaSenha" placeholder="Confirmar Senha">
                                <small class="<?=$classErrorInput?>"><?=$confirmaSenhaErr?></small>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input  button is-small is-fullwidth is-botao-modal" type="submit" name="cadastrar-professor" value="Cadastrar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <button class="modal-close is-large" id="close-modal-professor" aria-label="close"></button>
    </div>
</body>

</html>