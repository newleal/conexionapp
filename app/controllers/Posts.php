<?php
/**
 * clase Posts del controlador
 */

 class Posts extends Controller{

    private $postsmodel;

    public function __construct(){

        if(!isLoggedIn())
        {
            redirect('users/login');
        }

        $this->postsmodel = $this->model('Post');
    }

    //Muestra los postas creado por el usuario loggeado, si los tiene
    public function index()
    {
        //consulto por usuario loggeado
        $idUser = $_SESSION['user_id'];
        //se obtiene los posts que creo el usuario, si los tiene 
        $posts = $this->postsmodel->getPosts($idUser);
        $data = ['posts' => $posts, 'userId' => $idUser];

        $this->views('posts/index', $data);
    }

    // metodo que agrega nuevos posts
    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_URL);

            $data = [
                'title' =>$_POST['title'],
                'body' =>$_POST['body'],
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //validar el titulo
            if(empty($data['title']))
            {
                $data['title_err'] = 'Por favor ingresar el titulo del post';
            }

            //validar el body
            if(empty($data['body']))
            {
                $data['body_err'] = 'Por favor ingresar el contenido del post';
            }

            //validar que no haya errores
            if(empty($data['title_err']) && empty($data['body_err']))
            {
                if($this->postsmodel->addPosts($data))
                {

                    flash('posts_success', 'Se creo el post correctamente');
                    redirect('posts');
                
                } else {
                    flash('posts_error', 'Hubo un error al crear el post', 'alert alert-danger');
                    $this->views('posts/add', $data);
                }
            }else {
                flash('posts_error', 'Hubo un error al crear el post', 'alert alert-danger');
                $this->views('posts/add', $data);
            }

    
        } else {
            
            $data = [
                'title' =>'',
                'body' =>'',
                'user_id' => '',
                'title_err' => '',
                'body_err' => ''
            ];

            $this->views('posts/add', $data);
        }
    }

 }