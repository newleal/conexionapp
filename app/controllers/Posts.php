<?php

//Contrlador Posts
class Posts extends Controller{

    private $postModel;
    private $userModel;
    public function __construct()
    {
        if(!isLoggedIn())
        {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $posts_user = $this->postModel->getPosts();

        $data = [
            'posts' => $posts_user
        ];
        
        $this->view('posts/index', $data);
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($POST['title']),
                'body' => trim($POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''

            ];

            //validar el titulo del post
            if(empty($data['title']))
            {
                $data['title_err'] = 'Por favor ingrese el titulo del Post';
            }

            //validar el cotenido del post
            if(empty($data['body']))
            {
                $data['body_err'] = 'Por favor ingrese el contenido del Post';
            }

            //valdiar si no tiene errores
            if(empty($data['title_err']) && empty($data['body_err']))
            {
                //valdiado
                if($this->postModel->addPost($data))
                {
                    flash('post_mensaje', '¡¡¡Publicacion realizada!!!');
                    redirect('posts');
                }else {
                    die('Algo salio mal.');
                }
            } else {
                $this->view('posts/add', $data);
            }



        }else {

            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];
    
            $this->view('posts/add',$data);
        }
    }

    //enviar datos del post a la visa individual
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post['user_id']);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    //Editar el post creado por el usuario
    public function edit($id) {
        // Obtener el post existente
        $post = $this->postModel->getPostById($id);
        
        // Verificar que el post exista
        if (!$post) {
            redirect('posts');
        }
        
        // Verificar si el usuario es el propietario
        // Nota: Asegúrate de usar array o objeto consistentemente
        // según lo que devuelva getPostById()
        if ($post['user_id'] != $_SESSION['user_id']) {
            redirect('posts');
        }
        
        // Procesar el formulario si es POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitizar entrada
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Preparar datos
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            
            // Validar
            if (empty($data['title'])) {
                $data['title_err'] = 'Por favor ingrese el título del Post';
            }
            
            if (empty($data['body'])) {
                $data['body_err'] = 'Por favor ingrese el contenido del Post';
            }
            
            // Si no hay errores, actualizar
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->updatePost($data)) {
                    flash('post_mensaje', '¡Publicación actualizada!');
                    redirect('posts');
                } else {
                    die('Algo salió mal');
                }
            } else {
                // Cargar vista con errores
                $this->view('posts/edit', $data);
            }
        } else {
            // Para petición GET, mostrar formulario
            // Nota: Usa [] o -> consistentemente según el formato de $post
            $data = [
                'id' => $id,
                'title' => $post['title'],  
                'body' => $post['body']
            ];
            
            // Cargar vista con datos del post
            $this->view('posts/edit', $data);
        }
    }

}