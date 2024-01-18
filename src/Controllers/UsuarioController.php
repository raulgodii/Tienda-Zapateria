<?php
namespace Controllers;
use Models\Usuario;
use Lib\Pages;
use Utils\Utils;

class UsuarioController{
    private Pages $pages;

    public function __construct(){
        $this->pages = new Pages();
    }

    public function registro(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['data']){
                $registrado = $_POST['data'];

                // Podemos validar aqui si los metodos validar y sanitizar son estaticos

                $registrado['password'] = password_hash($registrado['password'], PASSWORD_BCRYPT, ['cost'=>4]);

                $usuario = Usuario::fromArray($registrado);

                // Validar
                // $errores = $usuario->validar()
                // if(empty($errores)){
                    //$atributos = $usuario->sanititizar();
                //}

                // Sanear

                $save = $usuario->save();

                if($save){
                    $_SESSION['register'] = "complete";
                } else{
                    $_SESSION['register'] = "failed";
                }
            }else {
                $_SESSION['register'] = "failed";
            }
        } 

        $this->pages->render('Usuario/registro');
    }

    public function login(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if($_POST['data']){
                
                $login = $_POST['data'];
                

                // Podemos validar aqui si los metodos validar y sanitizar son estaticos

                //$login['password'] = password_hash($login['password'], PASSWORD_BCRYPT, ['cost'=>4]);

                $usuario = Usuario::fromArray($login);

                $identity = $usuario->login();

                //$verify = password_verify($password, $usuario->password);

                // Validar
                // $errores = $usuario->validar()
                // if(empty($errores)){
                    //$atributos = $usuario->sanititizar();
                //}

                // Sanear

                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;
                } else {
                    $_SESSION['error_login'] = 'Identificacion fallida.';
                }
                $usuario->desconecta();
            }
            else {
                
                $_SESSION['identity'] ="failed";
            }
            
        } 
        $this->pages->render('Usuario/login');
    }

    public function logout(){
        Utils::deleteSession('identity');

        header("Location:".BASE_URL);
    }

    public function prueba($id){
        $this->pages->render('Usuario/prueba', ["id" => $id]);
    }

    public function registrarUsuario(){
        $this->pages->render('Usuario/registrarUsuario');
    }
}