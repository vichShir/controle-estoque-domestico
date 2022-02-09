<?php
    require "resources/php/__config.php";
    require "resources/php/db/database.php";

    session_start();

    if(isset($_SESSION['nome']))
    {
        header("Location:painel.php");
        die();
    }

    if(isset($_POST["username"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        try
        {
            $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $sql_login = "SELECT codusuario, nome FROM usuario WHERE username = '$username' and senha = '$password'";
            $result = $db->getRowFromQuery($sql_login);
            $db->close();

            $_SESSION["codusuario"] = $result["codusuario"];
            $_SESSION["nome"] = $result["nome"];
            header("Location:painel.php");
            die;
            echo "Bem-vindo! " . $result["nome"];
        }
        catch(DatabaseConnectionException $e)
        {
            $error = "Banco de dados inoperante. Fale com o administrador do site.";
        }
        catch(DatabaseQueryException $e)
        {
            $error = "Usuário ou senha incorretos.<br>Faça seu cadastro ou tente novamente.";
        }
        catch(Exeception $e)
        {
            $error = "Ocorreu um erro inesperado. Contate um administrador ou tente novamente.";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Login | Estoque Doméstico</title>
    <link href="resources/css/main-style.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/form-style.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/footer-style.css" rel="stylesheet" type="text/css"/>
    <!-- Importando fontes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/icons/iconweb-bomb.ico"/>
  </head>

  <body>

    <!-- Cabeçalho -->
    <header style="height: 90px"><h1>Estoque Doméstico</h1></header>

    <!-- Formulário de Login -->
    <section class="sec-panel sec-form">
        <h2>Login</h2>
        <hr>
        <form name="formulario-login" action="index.php" method="POST">
            <p class="form-input"><input type="text" name="username" placeholder="Usuário" size="20" maxlength="20" required></p>
            <p class="form-input"><input type="password" name="password" placeholder="Senha" size="20"  minlength="8" maxlength="20" required></p>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Entrar" ></p>
        </form>

        <!-- Link para cadastro -->
        <p><a href="cadastro.php">Cadastrar</a></p>

        <div style = "font-size:12px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>

    </section>

    <script src="html5-qrcode.min.js"></script>

    <div style="width: 500px" id="reader"></div>

    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 60, qrbox: 250 });

        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            alert(decodedText);
            // ...
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        html5QrcodeScanner.render(onScanSuccess);
    </script>

    <!-- Rodapé -->
    <footer>
        <!-- Rodapé principal -->
        <div class="ft-topics">
            <!-- About -->
            <section class="ft-about">
                <h3>SOBRE</h3>
                <p>Website para controlar o estoque doméstico.</p>
            </section>
            <!-- Devs -->
            <section class="ft-devs">
                <h3>DESENVOLVEDORES</h3>
                <ul>
                    <li>Victor Shirasuna</li>
                </ul>
            </section>
        </div>
      
        <!-- Rodapé inferior -->
        <div class="ft-info">
            <p>Controle Estoque Doméstico v1.0 | 2021 - 2022</p>
        </div>
    </footer>

  </body>
</html>