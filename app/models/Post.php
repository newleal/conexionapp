<?php

//conexion con la base de datos
class Post{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT *, posts.id as postsId,
                                 posts.create_at as postCreatedAt, 
                                 users.id as userId, 
                                 users.create_at as userCreatedAt FROM posts
                                 INNER JOIN users ON posts.user_id = users.id
                                 ORDER BY posts.create_at DESC');

        $results = $this->db->resultSet();                         
        return $results;
    }

    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)');
        //en lazar parametros
        $this->db->bind(':title', $data['title'], null);
        $this->db->bind(':body', $data['body'], null);
        $this->db->bind(':user_id', $data['user_id'], null);

        $result = $this->db->execute();

        if($result)
        {
            return true;
        }else {
            return false;
        }


    }

    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id, null);
        $result = $this->db->single();

        if($result){
            return $result;
        
        } else {
            return false;
        }
    }

    //editar el posts creado por el usuario
    public function updatePost($post)
    {
        $this->db->query('UPDATE posts SET title=:title, body=:body WHERE id=:id');
        $this->db->bind(':title', $post['title'], null);
        $this->db->bind(':body', $post['body'], null);
        $this->db->bind(':id', $post['id']);

        $result = $this->db->execute();

        if($result)
        {
            return true;
        } else{
            return false;
        }
    }


}