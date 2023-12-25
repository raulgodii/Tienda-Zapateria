<?php
namespace Models;

use Lib\BaseDatos;
use PDO;
use PDOException;

class Usuario{
    private string|null $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $password;
    private string $rol;

    private BaseDatos $db;

    public function __construct(string|null $id, string $nombre, string $apellidos, string $email, string $password, string $rol){
        $this->db = new BaseDatos();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getId(): string|null {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    public static function fromArray(array $data): Usuario {
        return new Usuario(
            $data['id'] ?? null,
            $data['nombre'] ?? '',
            $data['apellidos'] ?? '',
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['rol'] ?? ''
        );
    }

    public function validar(){

    }

    public function sanititizar(){

    }

    public function save(){
        if($this->getId()){
            return $this->update();
        } else {
            return $this->create();
        }
    }

    public function create(): bool {
        
        $id = NULL;
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $rol = 'user';
        
        try{
            $ins = $this->db->prepara("INSERT INTO usuarios (id, nombre, apellidos, email, password, rol) values (:id, :nombre, :apellidos, :email, :password, :rol)");

            $ins->bindValue(':id', $id);
            $ins->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $ins->bindValue(':apellidos', $apellidos, PDO::PARAM_STR);
            $ins->bindValue(':email', $email, PDO::PARAM_STR);
            $ins->bindValue(':password', $password, PDO::PARAM_STR);
            $ins->bindValue(':rol', $rol, PDO::PARAM_STR);

            $ins->execute();
            
            $result = true;
            
        } catch(PDOException $err){
            
            $result = false;
        }
        
        return $result;
    }

    public function buscaMail($email): bool|object{
        
        try{
            $cons = $this->db->prepara("SELECT * FROM usuarios WHERE email = :email");
            $cons->bindValue(':email', $email, PDO::PARAM_STR);
            $cons->execute();
            if($cons && $cons->rowCount() == 1){
                
                $result = $cons->fetch(PDO::FETCH_OBJ);
            }else{
                $result = false;
            }
            
        } catch(PDOException $err){
            $result = false;
        }

        return $result;
    }

    public function login(): bool|object {
        $result = false;
        $email = $this->email;
        $password = $this->password;

        $usuario = $this->buscaMail($email);

        if($usuario !== false){
            $verify = password_verify($password, $usuario->password);

            if($verify){
                $result = $usuario;

                $this->nombre = $usuario->nombre;
                //etc
            }else{
                $result = false;
                echo "contraseña incorrecta del usuario: ", $usuario->nombre;
            }
        }else{
            echo "usuario no registrado";
            $result = false;
        }
        return $result;
    }

    public function desconecta():void{
        $this->db->cierraConexion();
    }
}