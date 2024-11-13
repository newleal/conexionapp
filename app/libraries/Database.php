<?php
/**
 * Clase Database que gestiona la conexion y consultas a la base de datos
 */

 class Database {

    private $host = HOST;
    private $dbname = DBNAME;
    private $dbuser = USERDB;
    private $password = PASSWORD;
    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {

        //ruta de conexion
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //opciones de PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        //intentar la conexion a la base de datos
        try{

            $this->dbh = new PDO($dns, $this->dbuser, $this->password, $options);
        }catch(PDOException $e){

            $this->error = $e->getMessage();
            echo $this->error;
        }

    }

    //creacion de la consulta
    public function query($SQL)
    {
        $this->stmt = $this->dbh->query($SQL);
    }

    //validaicon del tipo de dato  enviado por parametro
    public function bind($param, $value, $type)
    {
        //valida el tipo del parametro
        if(is_null($type))
        {
            switch(true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type= PDO::PARAM_BOOL;
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

    //ejecucion de la consulta
    public function execute()
    {
        $this->stmt->execute();
    }

    //consultar todos los registros
    public function resulSet()
    {
        //llamar todos los registros
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //consulta por un registro
    public function single()
    {
        //traer solo un registro
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //conteo de registros
    public function countRow()
    {
        return $this->stmt->rowCount();
    }

    //Validar si se agrego un registro
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    
 }