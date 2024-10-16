<?php

/**
 * Clase que tiene la conexion con la base de datos
 */

 class Database {

    private $host = HOST;
    private $dbname = DBNAME;
    private $userdb = USERDB;
    private $password = PASSWORD;
    private $dbh; //Database Handle
    private $stmt;//Sentencias SQL
    private $error;// presentar errores

    public function __construct()
    {
        //iniciar la conexion con la base de datos

        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        //realizar conexion PDO
        try{
            $this->dbh = new PDO($dns, $this->userdb, $this->password, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //para recibir consultas
    public function query($SQL)
    {
        $this->stmt = $this->dbh->query($SQL);
    }

    //funcion para enlazar valores
    public function bind($param, $value, $type)
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
                    break;                    
            }
        }
    }

    //Funcio para ejecutar las consultas
    public function execute()
    {
        $this->stmt->execute();
    }

    //Obtener el conjuto de datos como una matriz de objetos
    public function resulSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Obtener un registro
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    //Obtener el recuero de filas
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}