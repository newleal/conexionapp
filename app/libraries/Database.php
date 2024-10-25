<?php
/**
 * Clase database para gestionar la conexion a la base de datos
 * gestionar conexiones
 */

 class Database {

    private $host = HOST;
    private $userdb = USERDB;
    private $password = PASSWORD;
    private $dbname = DBNAME;
    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){

        //configurar string de conexion
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //opciones de PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        //instancia de PDO

        try{
            $this->dbh = new PDO($dns, $this->userdb, $this->password, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        } 
    }

    //function para recibir la consultaSQL
    public function query($SQL)
    {
        $this->stmt = $this->dbh->prepare($SQL);
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

        $this->stmt->bindParam($param, $value, $type);
    }

    //funcion para ejecutar la consulta
    public function execute()
    {
        $this->stmt->execute();
    }

    //funcion para obteenr el resultado de datos
    public function resulSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //function para traer un resultado
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //function para traer el recuento de registros
    public function rowCount()
    {
       return $this->stmt->rowCount();
    }

    //funcion que vlaidar si se agrego un registro
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }



 }

