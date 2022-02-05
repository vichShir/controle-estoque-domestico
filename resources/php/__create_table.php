<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Campo Minado Online - Criação das Tabelas</title>
    <link href="../css/main-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/footer-style.css" rel="stylesheet" type="text/css"/>
    <!-- Importando fontes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/icons/iconweb-bomb.ico"/>
  </head>

  <body>

   <!-- Cabeçalho -->
   <header style="height: 90px"><h1>Campo Minado Online</h1></header>

   <!-- Criando tabelas no SGBD -->
   <section>
   	<h3>Criando Tabela</h3>
      <?php
        require "database.php";

        echo "<h4>Criando tabelas no banco de dados...</h4>";
        $sql_usuario = SQL_CMD_CREATE_USER;
        $sql_partida = SQL_CMD_CREATE_GAMEMATCH;
        try
        {
            $db = new Database();
            $db->executeCommand($sql_usuario);
            $db->executeCommand($sql_partida);
            $db->close();
            echo "<h4>Tabelas criadas com sucesso!</h4>";
        }
        catch(DatabaseConnectionException $e)
        {
            echo "<h4>" . $e->errorMessage() . "</h4>";
        }
        catch(DatabaseExecuteException $e)
        {
            echo "<h4>" . $e->errorMessage() . "</h4>";
        }
        catch(Exception $e)
        {
            echo "<h4>Ocorreu um erro inesperado. " . $e->getMessage() . "</h4>";
        }
		?>
		<h4><a href="../../index.php" style="color: #000;">Tela de login</a></h4>
	</section>

	<!-- Rodapé -->
    <footer>
        <!-- Rodapé principal -->
        <div class="ft-topics">
            <!-- About -->
            <section class="ft-about">
                <h3>SOBRE</h3>
                <p>Website do jogo Campo Minado desenvolvido na disciplina de Programação para a Web na FT - Unicamp.</p>
            </section>
            <!-- Devs -->
            <section class="ft-devs">
                <h3>DESENVOLVEDORES</h3>
                <ul>
                    <li>Caio Masseu</li>
                    <li>Jonatas Goes</li>
                    <li>Matheus Silva</li>
                    <li>Victor Shirasuna</li>
                </ul>
            </section>
        </div>
      
        <!-- Rodapé inferior -->
        <div class="ft-info">
            <p>SI401 - Programação Web 2021 - Grupo 8</p>
        </div>
    </footer>
      
   </body>
</html>
