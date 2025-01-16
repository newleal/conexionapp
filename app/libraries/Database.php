<?php
/**
 * clase que gestiona la conexion y consultas a la base de datos
 */

 class Database{

    private $host = HOST;
    private $userdb = USER_DB;
    private $password = PASS_DB;
    private $db = NAME_DB;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){

        //string de conexion
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->db;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            //instanciar a PDO
            $this->dbh = new PDO($dns, $this->userdb, $this->password, $options);
        } catch (PDOException $e){
            $this->error = $e->getMessage();
            
            echo $this->error;
        }

    }

    //metodo para obtener la cosulta SQL
    public function query($SQL)
    {
        $this->stmt = $this->dbh->prepare($SQL);
    }

    //metodo para enlazar valores
    public function bind($param, $value, $type=null)
    {
        //validar el tipo de datos
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

    //metodo para ejecutar la consulta
    public function execute()
    {
        return $this->stmt->execute();
    }

    //metod par aobtener todos los registros
    public function resulSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //metodo para obtener un registro
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //metodo para el conteo de filas
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }


 }