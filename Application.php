<?php 

namespace app\core;

use app\core\db\Database;

class Application{

    public string $layout = 'main';
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public static $app;
    public Session $session;
    public ?UserModel $user;
    public string $userClass;
    public ?Controller $controller = null;
    public View $view;

    public function __construct($rootPath , array $config) {

        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);
        $this->session = new Session();

        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);            
        } else {
            $this->user = null;
        }

    }

    public function setController(Controller $controller)
    {   
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function run() 
    {
        try {
            echo $this->router->resolve();    
        } catch(\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('error', ['exception' => $e]);
        }
        

    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

}