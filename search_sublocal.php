<?php
    require "resources/php/__config.php";
    require "resources/php/db/database.php";

    $local = $_POST['local'] ?? '';

    if(isset($_POST['local']))
    {
        $db = new Database(DB_SERVER, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $sql_command = "SELECT DISTINCT sublocal FROM local WHERE nome = '$local'";
        $sublocais = $db->getAllRowsFromQuery($sql_command);
        $db->close();
    }

    $result = [
        'sublocais'    =>  $sublocais
    ];
    echo json_encode($result);
?>