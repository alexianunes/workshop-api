<?php
namespace Controllers;

use \Core\Controller;
use \Models\Usuarios;
use \Models\Jwt;

class UsuariosController extends Controller
{

    public function index()
    {}

    public function login(){
        $array = array('error' => '');
        $method = $this->getMethod();
        $data   = $this->getRequestData();

        if ($method == 'POST') {

            if (!empty($data['email']) && !empty($data['senha'])) {
                $jwt = new Jwt();
                $users = new Usuarios();

                if ($users->checarUsuario($data['email'], $data['senha'])) {
                    $array['jwt'] = $jwt->createJWT();
                } else {
                    $array['error'] = 'Acesso Negado';
                }
            } else {
                $array['error'] = 'Login e/ou senha incorretos';
            }
        } else {
            $array['error'] = 'Método de requisição incompatível';
        }

        $this->returnJson($array);
    }

    public function listar(){
    	$array = array('error' => '', 'logged' => false);

    	$method = $this->getMethod();
    	$data = $this->getRequestData();

    	$usuarios = new Usuarios();
        $jwt = new Jwt();

    	// if(!empty($data['jwt']) && $jwt->validateJWT($data['jwt'])){
    		$array['logged'] = true;

     		switch ($method) {
     			case 'GET':
     				$array['data'] = $usuarios->listarTodos();
     				break;
     			case 'POST':
     				$array['error'] = 'Método '.$method.' não disponível';
     				break;
     			case 'PUT':
     				$array['error'] = 'Método '.$method.' não disponível';
     				break;
     			case 'DELETE':
     				$array['error'] = 'Método '.$method.' não disponível';
     				break;
     			default:
     				$array['error'] = 'Método '.$method.' não disponível';
     				break;
     		}

    	// }else{
    	// 	$array['error'] = 'Acesso negado';
    	// }

    	$this->returnJson($array);
    }

    public function cadastrar()
    {
        $array = array('error' => '', 'logged' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        $usuarios = new Usuarios();
        $jwt = new Jwt();

        // if(!empty($data['jwt']) && $jwt->validateJWT($data['jwt'])){
            $array['logged'] = true;

            switch ($method) {
                case 'POST':
                    $array['data'] = $usuarios->cadastrarUsuario($data['nome'], $data['email'], $data['senha']);
                    break;
                case 'PUT':
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
                case 'PUT':
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
                case 'DELETE':
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
                default:
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
            }

        // }else{
        //     $array['error'] = 'Acesso negado';
        // }

        $this->returnJson($array);
    }

    public function retornar($id)
    {
        $array = array('error' => '', 'logged' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        $usuarios = new Usuarios();
        $jwt = new Jwt();

        if(!empty($data['jwt']) && $jwt->validateJWT($data['jwt'])){
            $array['logged'] = true;

            switch ($method) {
                case 'GET':
                    $array['data'] = $usuarios->retornarUsuario($id);
                    if(count($array['data']) === 0){
                        $array['error'] = 'Usuário não existe';
                    }
                    break;
                case 'POST':
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
                case 'PUT':
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
                case 'DELETE':
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
                default:
                    $array['error'] = 'Método '.$method.' não disponível';
                    break;
            }

        }else{
            $array['error'] = 'Acesso negado';
        }

        $this->returnJson($array);
    }

}
