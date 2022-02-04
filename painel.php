<?php
    require "resources/php/__config.php";
    require "resources/php/db/database.php";

    session_start();

    if(!isset($_SESSION['nome']))
    {
        header("Location:index.php");
        die();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Painel | Estoque Doméstico</title>
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
    <header style="height: 90px"><h1>Painel <?php echo "exibido para " . $_SESSION['nome']; ?></h1></header>

    <ul>
        <li>Cadastrar</li>
        <ul>
            <li>Usuário</li>
            <li>Local</li>
            <li>Item</li>
            <li>ItemLocal</li>
        </ul>
        <li>Consultar</li>
        <ul>
            <li>Itens</li>
            <ul>
                <li>Quantidade</li>
                <li>Vencimento</li>
                <li>Localização</li>
                <li>Categoria</li>
            </ul>
        </ul>
    </ul>

    <p>Buscar por: barcode, nome, categoria ou local</p>
    <p>Ver: quantidade, dia da compra, vencimento</p>

    <!-- Formulário de Login -->
    <section class="sec-panel sec-form">
        <h2>Busca</h2>
        <hr>
        <form name="formulario-login" action="index.php" method="POST">
            <p class="form-input"><input type="text" name="username" placeholder="Usuário" size="20" maxlength="20" required></p>
            <p class="form-input"><input type="password" name="password" placeholder="Senha" size="20"  minlength="8" maxlength="20" required></p>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Buscar"></p>
        </form>

        <!-- Link para cadastro -->
        <p><a href="cadastro.php"></a></p>

        <div style = "font-size:12px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>
    </section>

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