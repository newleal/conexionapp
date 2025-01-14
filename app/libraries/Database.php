<?php

/**
 * Clase base de datos PDO
 * Conectar a la base de datos
 * crear sentencias preparadas
 * Bind Values (valores enlazados)
 * Retorno de resultados
 */

 class Database {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;

    private $dbh; //database handler
    private $stmt; //sentencia
    private $error; //error

    public function __construct(){

        //seteamos el nombre del origen de datos
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        //creamos una instacia de PDO
        try{

            $this->dbh = new PDO ($dns, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();

            echo $this->error;
        }

    }

    //para usar las setencias SQL
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
                    break;

            }
        }

        $this->stmt->bindValue($param, $value, $type);

    }

    //funcion para ejecutar las sentencia
    public function execute()
    {
        return $this->stmt->execute();
    }

    //obtener el conjunto de resultados com una matriz de objetos
    public function resulSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Obtener un solo registro como objeto
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //obtener recuento de filas
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}

