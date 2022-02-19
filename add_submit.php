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
    <title>Adicionar Final | Estoque Doméstico</title>
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

    <!-- Formulário de Login -->
    <section class="sec-panel sec-form">
        <h2>Adicionar Quantidade</h2>
        <hr>
        <form name="formulario-login" action="add_submit.php" method="POST">
            <p class="form-input">Quantidade<input type="number" name="quantidade" placeholder="(Obrigatório)" max="9999.99" step="0.01" required></p>
            <input hidden type='text' name='coditem' value=<?php echo isset($_GET['product_id']) ? $_GET['product_id'] : ""; ?>>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Adicionar"></p>
        </form>

        <div style = "font-size:12px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>
    </section>

    <!--QR Code Reader-->
    <script src="html5-qrcode.min.js"></script>
    <div style="width: 500px" id="reader"></div>
    <script>
        "use strict";

        let xhttp;
        function enviarDados(barcode)
        {
            xhttp = new XMLHttpRequest();
            
            if (!xhttp) 
            {
                alert('Não foi possível criar um objeto XMLHttpRequest.');
                return false;
            }
            xhttp.onreadystatechange = mostraResposta;
            xhttp.open('POST', 'barcode_request.php', true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send('barcode=' + encodeURIComponent(barcode));
        }

        function mostraResposta() 
        {
            try
            {
                if (xhttp.readyState === XMLHttpRequest.DONE)
                {
                    if (xhttp.status === 200)
                    {
                        let resposta = JSON.parse(xhttp.responseText);

                        let local = resposta.local;
                        let sublocal = resposta.sublocal;
                        let categoria = resposta.categoria;
                        let nome = resposta.nome;
                        let unidademedida = resposta.unidademedida;
                        let quantidade = resposta.quantidade;

                        alert(nome + "| Qtd: " + quantidade);
                    }
                    else
                    {
                        alert('Um problema ocorreu.');
                    }
                }
            } 
            catch (e)
            {
                alert("Ocorreu uma exceção: " + e.description);
            }
        }

        var html5QrcodeScanner;
        function scanner()
        {
            html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 30, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);
            return false;
        }

        function onScanSuccess(decodedText, decodedResult)
        {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            enviarDados(decodedText);
            // ...
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        //html5QrcodeScanner.render(onScanSuccess);
    </script>

    <?php
        if(isset($_POST['quantidade']))
        {
            $coditem = $_POST['coditem'] ?? '';
            $quantidade = $_POST['quantidade'] ?? '';

            # Adicionar
            $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);

            $sql_login = "UPDATE item SET quantidade = quantidade + $quantidade WHERE coditem = $coditem";
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