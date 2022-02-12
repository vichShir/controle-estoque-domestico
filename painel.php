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

    <ul>
        <li>Cadastrar</li>
        <ul>
            <li>Usuário</li>
            <li>Locais</li>
            <li>Categorias</li>
            <li>Unidades de Medida</li>
            <li>Item/Compra</li>
        </ul>
        <li>Atualizar</li>
        <ul>
            <li>Usuário</li>
            <li>Item/Compra</li>
        </ul>
    </ul>

    <a href="painel.php">Home</a>
    <a href="cadastro.php">Cadastrar</a>

    <!-- Formulário de Login -->
    <section class="sec-panel sec-form">
        <h2>Busca</h2>
        <hr>
        <form name="formulario-login" action="painel.php" method="POST">
            <p class="form-input">Nome<input type="text" name="nome" placeholder="(Opcional)" size="50" maxlength="50"></p>
            <p class="form-input">Código de barras<input type="text" name="barcode" placeholder="(Opcional)" size="13" minlength="13" maxlength="13"></p>

            <p class="form-input">Categoria
                <select id="categoria" name='categoria'>
                    <option value="">Selecionar</option>
                    <?php
                        $sql_login = "SELECT DISTINCT nome FROM categoria";
                        $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
                        $result = $db->getAllRowsFromQuery($sql_login);
                        $db->close();

                        foreach ($result as $value)
                        {
                            echo "<option value='" . $value['nome'] . "'>" . $value['nome'] . "</option>";
                        }
                    ?>
                </select>
            </p>

            <p class="form-input">Local
                <select id="local" name='local'>
                    <option value="">Selecionar</option>
                    <?php
                        $sql_login = "SELECT DISTINCT nome FROM local";
                        $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
                        $result = $db->getAllRowsFromQuery($sql_login);
                        $db->close();

                        foreach ($result as $value)
                        {
                            echo "<option value='" . $value['nome'] . "'>" . $value['nome'] . "</option>";
                        }
                    ?>
                </select>
            </p>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Buscar"></p>
        </form>

        <!-- Link para cadastro -->
        <p><a href="cadastro.php"></a></p>

        <div style = "font-size:12px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>
    </section>

    <script src="html5-qrcode.min.js"></script>

    <div style="width: 500px" id="reader"></div>

    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 60, qrbox: 250 });
        //html5QrcodeScanner.render(onScanSuccess);

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

    <?php
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $categoria = $_POST['categoria'];
            $local = $_POST['local'];
            $barcode = $_POST['barcode'];

            function add_filter(&$first_filter, $var, $var_name)
            {
                if(!empty($var) && $first_filter)
                {
                    $first_filter = false;
                    return " WHERE $var_name LIKE '%$var%'";
                }
                else if(!empty($var) && !$first_filter)
                    return " AND $var_name LIKE '%$var%'";
            }

            $sql_login = "SELECT LOCAL, SUBLOCAL, CATEGORIA, NOME, UNIDADE_MEDIDA, QUANTIDADE FROM VW_PRODUTOS";

            $first_filter = true;
            $sql_login .= add_filter($first_filter, $nome, 'NOME');
            $sql_login .= add_filter($first_filter, $categoria, 'CATEGORIA');
            $sql_login .= add_filter($first_filter, $local, 'LOCAL');
            $sql_login .= add_filter($first_filter, $barcode, 'BARCODE');

            $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $result = $db->getAllRowsFromQuery($sql_login);
            $db->close();



            echo "
            <table class='table table-dark table-striped table-hover'>
                <thead>
                    <tr>
                        <th scope='col'>LOCAL</th>
                        <th scope='col'>SUBLOCAL</th>
                        <th scope='col'>CATEGORIA</th>
                        <th scope='col'>NOME</th>
                        <th scope='col'>UNIDADE MEDIDA</th>
                        <th scope='col'>QUANTIDADE</th>
                    </tr>
                </thead>
                <tbody>";
                for($i = 0; $i < sizeof($result); $i++)
                {
                    echo "<tr>";
                    echo "
                    <th scope='row'>" . $result[$i]['LOCAL'] . "</th>
                    <td>" . $result[$i]['SUBLOCAL'] . "</td>
                    <td>" . $result[$i]['CATEGORIA'] . "</td>
                    <td>" . $result[$i]['NOME'] . "</td>
                    <td>" . $result[$i]['UNIDADE_MEDIDA'] . "</td>
                    <td>" . $result[$i]['QUANTIDADE'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>
            </table>";
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