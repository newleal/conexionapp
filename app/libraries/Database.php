<?php

/**
 * clase poara realizar la conexion con al base de datos de
 * 
 */

 class Database{

    private $host = HOST;
    private $userdb = USERDB;
    private $dbname = DBNAME;
    private $password = PASSWORD;
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        //setear elorigen de datos
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = [
            PDO::ATTR_PERSISTENT  => true,
            PDO::ATTR_ERRMODE     => PDO::ERRMODE_EXCEPTION
        ];

        //creamos una instancia de PDO
        try{
            $this->dbh = new PDO($dns, $this->userdb,$this->password, $options);
        } catch (PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //prepara la consulta el query

    public function query($SQL)
    {
        $this->stmt = $this->dbh->prepare($SQL);
    }

    //Enlazar valores
    public function bin($param, $value, $type)
    {
        if(is_null($type))
        {
            switch(true){

                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;        
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_string($value):
                    $type = PDO::PARAM_STR;
                    break;    
            }
        }

        $this->stmt->bin($param, $value, $type);
    }

    //Ejecutar la sentencia
    public function execute()
    {
        $this->stmt->execute();
    }

    //Obtener resultados de consulta
    public function resulSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Obtener un resultado
    public function sigle()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Obtener recuento de filas
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
 }