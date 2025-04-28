<?php

//Contrlador Posts
class Posts extends Controller{

    private $postModel;
    public function __construct()
    {
        if(!isLoggedIn())
        {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $posts_user = $this->postModel->getPosts();

        $data = [
            'posts' => $posts_user
        ];
        $this->view('posts/index', $data);
    }

}