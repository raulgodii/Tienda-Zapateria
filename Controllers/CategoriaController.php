<?php
namespace Controllers;
use Models\Categoria;
use Lib\Pages;
use Utils\Utils;

class CategoriaController{
    private Pages $pages;

    public function __construct(){
        $this->pages = new Pages();
    }

    public static function obtenerCategorias(): ?array{
        return Categoria::getAll();
    }

    public function gestionarCategorias():void{
        $this->pages->render("categoria/gestionarCategorias");
    }

    public function crearCategoria():void{
        $this->pages->render("categoria/crearCategoria");
    }

    public function guardarCategoria():void {
        $nuevaCategoria = $_POST['categoria'];
        Categoria::guardarCategoria($nuevaCategoria);
        $this->pages->render("categoria/crearCategoria");
    }
}
