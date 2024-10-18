<?php
/**
 * conectatnos a la base de datos
 * con la clase Database
 */

 class Database {

    //Definicion de atributos
    private $host = HOST;
    private $userdb = USER;
    private $dbname = DBNAME;
    private $password = PASSWORD;
    private $stmt;
    private $dbh;
    private $error;


    public function __construct()
    {
        //definir el dns
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        //Opciones de PDO

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        //iniciar la conexion

        try{

            $this->dbh = new PDO($dns, $this->userdb, $this->password, $options);

        }catch(PDOException $e){

            //si hay error de conexion
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Metodo para recibir la consulta
    public function query($SQL)
    {
        $this->stmt = $this->dbh->prepare($SQL);
    }

    //metodo para enlaza valores
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
                case is_null($value);
                    break;
                    $type = PDO::PARAM_NULL;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
    }

    //Metodo para ejecutar la sentencia
    public function execute()
    {
        $this->stmt->execute();
    }

    //Metodo para obtener el conjuto de datos
    public function resulSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Devolver un dato
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Metod par aobtener el recuento de datos
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }


 }