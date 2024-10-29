<?php
/**
 * Clase modelo Post que realiza cosultas a la base de datos
 */

 class Post{

    private $db;

    public function __construct(){
        //instanciamos a la calse Database
        $this->db = new Database();
    }

    //consultamos la db
    public function getPosts($idUser)
    {
        //realizamos la consulta
        $this->db->query('SELECT*,posts.id as postId,posts.create_at as postsCreateAt,users.id as userId,users.create_at as userCreateAt FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.id=:idUser ORDER BY posts.create_at DESC');
        $this->db->bind(':idUser', $idUser, null);
        //retornamos la respuesta
        $results = $this->db->resulSet();
        return $results;
    }

    //agregamos el posts
    public function addPosts($data)
    {
        //alistamos el script
        $this->db->query('INSERT INTO posts (user_id, title, body ) VALUES (:user_id, :title, :body)');
        //enlazamos parametros
        $this->db->bind(':user_id', $data['user_id'], 1);
        $this->db->bind(':title', $data['title'], null);
        $this->db->bind(':body', $data['body'], null);
        $this->db->execute();
        //ejecucion
        $result = $this->db->lastInsertId();
        if(!empty($result))
        {
            return true;
        }else {
            return false;
        }
    }
 }