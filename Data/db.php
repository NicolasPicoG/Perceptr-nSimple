<?php

class Database{

    protected $url;
    protected $user;
    protected $password;
    protected $db;
    protected $connection = null;

    public function __construct($url, $user, $password, $db)
    {
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }

    public function __destruct()
    {
        if($this->connection != null){
            $this->closeConnection();
        }
    }

    public function fetchArray($query){
        return $query->fetch_array();
    }

    protected function makeConnection(){

        $this->connection = new mysqli($this->url, $this->user, $this->password, $this->db);
        if($this->connection->connect_error){
            echo "Fail" . $this->connection->connect_error;
        }
    }

    protected function closeConnection(){
        if($this->connection != null){
            $this->connection->close();
            $this->connection = null;
        }
    }

    public function executeQuery($query, $params = null){
        // Existe una conexión de base de datos?
        $this->makeConnection();
        // Ajustar la consulta con parámetros si está disponible
        if($params != null){
            // Cambio ? a los valores de la matriz de parámetros
            $queryParts = preg_split("/\?/", $query);
            // si cantidad de? no es igual a la cantidad de valores => error
            if(count($queryParts) != count($params) + 1){
                return false;
            }
            // Agregar la primera parte
            $finalQuery = $queryParts[0];
            // Bucle sobre todos los parámetros
            for($i = 0; $i < count($params); $i++){
                // Agregar parámetro limpio a la consulta
               /* echo $params[$i];*/
                $finalQuery = $finalQuery . $this->cleanParameters($params[$i]) . $queryParts[$i + 1];
            }
            $query = $finalQuery;
            echo $finalQuery;
        }
        // Compruebe la inyección de SQL
        $result = $this->connection->query($query);
        return $result;
    }
    
    protected function cleanParameters($parameters){
        // prevenir la inyección de SQL
        $result = $this->connection->real_escape_string($parameters);
        return $result;
    }
}

?>