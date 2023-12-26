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

        // Obtener información detallada de los productos en el carrito (puedes adaptarlo según tu implementación)
        $productos = $this->obtenerInformacionProductos($carrito);

        // Calcular el importe total del pedido
        $importeTotal = $this->calcularImporteTotal($productos);

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

    private function obtenerInformacionProductos($carrito) {
        // Implementa la lógica para obtener información detallada de los productos según tus necesidades
        // Esto podría implicar consultar una base de datos o utilizar un servicio externo

        // Ejemplo: Obtener información de productos desde un servicio de productos
        $productos = [];

        foreach ($carrito as $codigoProducto => $cantidad) {
            // Aquí podrías realizar consultas a tu base de datos para obtener información detallada del producto
            // y construir un array con los detalles de cada producto en el carrito.
            // La estructura del array dependerá de cómo tengas almacenada la información de los productos.
            // Ejemplo: $productoDetalle = $this->consultaBaseDeDatos($codigoProducto);
            // $productos[] = ['codigo' => $codigoProducto, 'nombre' => $productoDetalle['nombre'], 'precio' => $productoDetalle['precio'], 'cantidad' => $cantidad];
        }

        return $productos;
    }

    private function calcularImporteTotal($productos) {
        // Implementa la lógica para calcular el importe total del pedido según los productos en el carrito
        // Esto dependerá de la estructura de tu array de productos y de cómo calculas el importe total.

        $importeTotal = 0;

        foreach ($productos as $producto) {
            // Calcula el subtotal de cada producto y suma al importe total
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $importeTotal += $subtotal;
        }

        return $importeTotal;
    }
}