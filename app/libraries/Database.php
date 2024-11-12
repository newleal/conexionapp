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
 }