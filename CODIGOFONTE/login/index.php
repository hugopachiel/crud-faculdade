<?php

include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail.";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha.";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha ='$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    
        $quantidade = $sql_query->num_rows;

        if($quantidade ==1) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: crud/index.php");


        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}


?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN CADASTRO</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    
    <section class="hero is-success is-fullheight ">
        <div class="hero-body ">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4 ">
                    <h3 class="title has-text-grey">Acesso</h3>
                    <h3 class="title has-text-grey">Cadastro Colaboradores</h3>
                    
                    
                    
                    <div class="box">
                        <form action="login.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <label>E-MAIL</label>
                                    <input name="email" name="text" class="input is-large" placeholder="Seu email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                     <label>SENHA</label>
                                    <input name="senha" class="input is-large" type="password" placeholder="Sua senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>