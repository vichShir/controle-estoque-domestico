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
    <title>Cadastros | Estoque Doméstico</title>
    <link href="resources/css/main-style.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/form-style.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/footer-style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Importando fontes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/icons/iconweb-bomb.ico"/>
  </head>

  <body>

    <!-- Cabeçalho -->
    <header style="height: 90px"><h1>Painel <?php echo "exibido para " . $_SESSION['nome']; ?></h1></header>

    <a href="painel.php">Home</a>
    <a href="cadastro.php">Cadastrar</a>

    <!-- Formulário de Login -->
    <section class="sec-panel sec-form">
        <h2>Produto</h2>
        <hr>
        <form name="formulario-login" action="cadastro.php" method="POST">
            <p class="form-input">Código de barras<input type="text" name="barcode" placeholder="(Opcional)" size="13" maxlength="13"></p>
            <p class="form-input">Nome<input type="text" name="nome" placeholder="(Obrigatório)" size="50" maxlength="50" required></p>
            <p class="form-input">Categoria<input type="text" name="categoria" placeholder="(Opcional)" size="30" maxlength="30"></p>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Cadastrar"></p>
        </form>
        <div style = "font-size:12px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>
    </section>

    <section class="sec-panel sec-form">
        <h2>Registro de Compra</h2>
        <hr>
        <form name="formulario-login" action="cadastro.php" method="POST">
            <p class="form-input">Unidade de medida *<input type="text" name="unidademedida" placeholder="(Obrigatório)" size="10" maxlength="10" required></p>
            <p class="form-input">Quantidade *<input type="number" name="quantidade" placeholder="(Obrigatório)" max="9999.99" step="0.01" required></p>
            <p class="form-input">Data de compra<input type="date" name="dtcompra"></p>
            <p class="form-input">Data de vencimento<input type="date" name="dtvencimento"></p>
            <p class="form-input">Código do item *<input type="number" name="coditem" placeholder="(Teste)" required></p>
            <p class="form-input">Código do local *<input type="number" name="codlocal" placeholder="(Teste)" required></p>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Cadastrar"></p>
        </form>
        <div style = "font-size:12px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>
    </section>

    <?php
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'] ?? '';
            $barcode = $_POST['barcode'] ?? '';
            $categoria = $_POST['categoria'] ?? '';

            # Preprocessamento
            $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
            $nome = strtr($nome, $unwanted_array);
            $categoria = strtr($categoria, $unwanted_array);

            $nome = strtoupper($nome);
            $categoria = strtoupper($categoria);

            # Cadastrar
            $sql_login = "INSERT INTO item(barcode, nome, categoria) VALUES(NULLIF('$barcode', ''), '$nome', NULLIF('$categoria', ''))";
            $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $db->executeCommand($sql_login);
            $db->close();
        }
        else if(isset($_POST['unidademedida']))
        {
            $unidademedida = $_POST['unidademedida'] ?? '';
            $quantidade = $_POST['quantidade'] ?? '';
            $dtcompra = $_POST['dtcompra'] ?? '';
            $dtvencimento = $_POST['dtvencimento'] ?? '';
            $coditem = $_POST['coditem'] ?? '';
            $codlocal = $_POST['codlocal'] ?? '';

            # Cadastrar
            $sql_login = "INSERT INTO compra(unidademedida, quantidade, dtcompra, dtvencimento, coditem, codlocal) 
                            VALUES(NULLIF('$unidademedida', ''), NULLIF('$quantidade', ''), NULLIF('$dtcompra', ''), NULLIF('$dtvencimento', ''), NULLIF('$coditem', ''), NULLIF('$codlocal', ''))";
            $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $db->executeCommand($sql_login);
            $db->close();
        }
    ?>

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