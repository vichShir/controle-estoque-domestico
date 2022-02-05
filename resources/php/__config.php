<?php
//===========================================================================
//============================ Database Settings ============================
//===========================================================================

/**
 * Especifique as configurações do seu banco de dados aqui (MariaDB)
 * 
 * USING_CLOUD_MARIADB = true -> usando MariaDB na nuvem (MariaDB SkySQL)
 * USING_CLOUD_MARIADB = false -> usando MariaDB no localhost
 *
 * USING_SSL_CONNECTION = true -> especifique o caminho da chave p/ conexão SSL
 * USING_SSL_CONNECTION = false -> desabilitar conexão SSL
 */
define("DB_SERVER", "localhost");
define("DB_PORT", "3306");
define("DB_DATABASE", "casa");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
?>