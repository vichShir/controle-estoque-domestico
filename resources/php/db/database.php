<?php
class DatabaseConnectionException extends Exception
{
    public function errorMessage() 
    {
        // Error message
        $errorMsg = 'Erro ao se conectar ao Banco de Dados: '.$this->getFile().': <b>'.$this->getMessage().'</b>';
        return $errorMsg;
    }
}

class DatabaseExecuteException extends Exception
{
    public function errorMessage() 
    {
        // Error message
        $errorMsg = 'Erro ao tentar processar o requerimento: '.$this->getFile().': <b>'.$this->getMessage().'</b>';
        return $errorMsg;
    }
}

class DatabaseQueryException extends Exception
{
    public function errorMessage() 
    {
        // Error message
        $errorMsg = 'Erro ao retornar a consulta: '.$this->getFile().': <b>'.$this->getMessage().'</b>';
        return $errorMsg;
    }
}

class Database
{
    // Connection
    private $conn;

    // Variables to connect to database
    private $HOSTNAME;
    private $PORT;
    private $DATABASE;
    private $USERNAME;
    private $PASSWORD;

    public function __construct($DB_SERVER, $DB_PORT, $DB_DATABASE, $DB_USERNAME, $DB_PASSWORD)
    {
        $this->HOSTNAME = $DB_SERVER;
        $this->PORT = $DB_PORT;
        $this->DATABASE = $DB_DATABASE;
        $this->USERNAME = $DB_USERNAME;
        $this->PASSWORD = $DB_PASSWORD;
        $this->connect();
    }
  
    private function connect()
    {
        try
        {
            $url = "mysql:host=" . $this->HOSTNAME . ";port=" . $this->PORT . ";dbname=" . $this->DATABASE;

            $this->conn = new PDO($url, $this->USERNAME, $this->PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            throw new DatabaseConnectionException($e->getMessage());
        }
    }

    public function executeCommand($command)
    {
        try
        {
            $count = $this->conn->exec($command);
        }
        catch(PDOException $e)
        {
            throw new DatabaseExecuteException("Comando invalidado.");
        }
    }

    public function getRowFromQuery($command)
    {
        try
        {
            $stmt = $this->conn->query($command); // Returns an object from class PDOStatement

            if($this->validateQuery($stmt) === false)
            {
                throw new DatabaseQueryException("Credenciais incorretas.");
            }
        }
        catch(PDOException $e)
        {
            throw new Exception("Ocorreu um erro inesperado: " . $e->getMessage());
        }

        return $this->retrieveNextRow($stmt);
    }

    public function getAllRowsFromQuery($command)
    {
        try
        {
            $stmt = $this->conn->query($command); // Returns an object from class PDOStatement
        }
        catch(PDOException $e)
        {
            throw new DatabaseQueryException($e->getMessage());
        }

        // Return query result
        return $this->retrieveAllRows($stmt);
    }

    private function validateQuery($statement)
    {
        return $statement->rowCount() === 1;
    }

    private function retrieveNextRow($statement)
    {
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    private function retrieveAllRows($statement)
    {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Close the connection
    public function close()
    {
        $this->conn = null;
    }
}
?>