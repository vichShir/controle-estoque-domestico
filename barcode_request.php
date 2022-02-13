<?php
    require "resources/php/__config.php";
    require "resources/php/db/database.php";

    $barcode = $_POST['barcode'] ?? '';

    if(isset($_POST['barcode']))
    {
        // Gravar partida
        $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $sql_command = "SELECT LOCAL, SUBLOCAL, CATEGORIA, NOME, UNIDADE_MEDIDA, QUANTIDADE FROM VW_PRODUTOS WHERE BARCODE = '$barcode'";
        $product = $db->getRowFromQuery($sql_command);
        $db->close();
    }

    $result = [
        'local'    =>  $product['LOCAL'],
        'sublocal'    =>  $product['SUBLOCAL'],
        'categoria'    =>  $product['CATEGORIA'],
        'nome'    =>  $product['NOME'],
        'unidademedida'    =>  $product['UNIDADE_MEDIDA'],
        'quantidade'    =>  $product['QUANTIDADE']
    ];
    echo json_encode($result);
?>