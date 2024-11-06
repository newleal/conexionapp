<?php
/**
 * Clase que gestiona la conexion y scripts SQL a la base de datos
 */

 class Database {

    private $host = HOST;
    private $dbuser = DBUSER;
    private $password = PASSWORD;
    private $dbname = DBNAME;
    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {

        //crear cadena de conexion
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //opciones para agregar al PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        //crear la conexion a la base de datos
        try{

            $this->dbh = new PDO($dns, $this->dbuser, $this->password, $options);

        }catch(PDOException $e ){
            //si hay error
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }

    //preparar el script SQL
    public function query($SQL)
    {
        $this->stmt = $this->dbh->prepare($SQL);
    }

    //funcion para orgamizar el binparam o gesto nde parametros
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

        $this->stmt->bindValue($param, $value, $type);
    }

    //funcion de ejecucion de script SQL
    public function execute()
    {
        $this->stmt->execute();
    }

    //consulta de registros
    public function resulSet()
    {
        $this->stmt->execute();

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //consulta por un registro
    public function single()
    {
        $this->execute();

        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //contrar todos los registros
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }


 }

