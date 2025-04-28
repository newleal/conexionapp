<?php

//Clase que gestiona la conexion y consultas a la base de datos

class Database{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $dbnbame = DB_NAME;

    private $dbh;//database handler
    private $stmt; //sentencia
    private $error;


    public function __construct()
    {
        //setear lo origenes de datos
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbnbame;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_PERSISTENT => PDO::ERRMODE_EXCEPTION
        ];

        //creamos una istancia de PDO
        try{

            $this->dbh = new PDO($dns, $this->user, $this->pass, $options);

        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    
    }

    // Consultas SQL
    public function query($SQL)
    {
        $this->stmt = $this->dbh->prepare($SQL);
    }

    //funcion para enlazar valores
    public function bind($param, $value, $type=null)
    {
        if(is_null($type))
        {
            switch(true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;            
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    //para ejecutar las senetencias
    public function execute()
    {
        return $this->stmt->execute();
    }

    //Obtener el conjunto de datos 
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Obtener un resultado
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Obtener recuento de filas
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    
}