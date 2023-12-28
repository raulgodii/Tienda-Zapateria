<?php

namespace Controllers;
use Lib\Pages;
    
class CarritoController {

    private Pages $pages;

    public function __construct(){
        $this->pages = new Pages();
    }

    public function verCarrito() {
        // Obtener el contenido del carrito desde la variable de sesión
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        // Incluir la vista del carrito
        $this->pages->render("carrito/verCarrito");
    }

    public function agregar($codigoProducto) {
        // Obtener el contenido actual del carrito desde la variable de sesión
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        // Verificar si el producto ya está en el carrito
        if (isset($carrito[$codigoProducto])) {
            // Si ya está en el carrito, sumar la cantidad
            $carrito[$codigoProducto] ++;
        } else {
            // Si no está en el carrito, añadirlo con la cantidad 1
            $carrito[$codigoProducto] = 1;
        }

        // Actualizar la variable de sesión con el nuevo contenido del carrito
        $_SESSION['carrito'] = $carrito;

        $this->pages->render("carrito/verCarrito");
    }

    public function quitar($codigoProducto) {
        // Obtener el contenido actual del carrito desde la variable de sesión
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        // Verificar si el producto está en el carrito
        if (isset($carrito[$codigoProducto])) {
            // Restar la cantidad especificada
            $carrito[$codigoProducto] --;

            // Eliminar el elemento del carrito si la cantidad es menor o igual a cero
            if ($carrito[$codigoProducto] <= 0) {
                unset($carrito[$codigoProducto]);
            }

            // Actualizar la variable de sesión con el nuevo contenido del carrito
            $_SESSION['carrito'] = $carrito;
        }
        $this->pages->render("carrito/verCarrito");
    }

    public function vaciar() {
        // Vaciar el carrito eliminando la variable de sesión
        unset($_SESSION['carrito']);
    }


}