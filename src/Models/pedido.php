<?php

namespace Models;

use Controllers\ProductoController;
use Lib\BaseDatos;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Pedido
{

    private $db;
    public function __construct()
    {
        $this->db = new BaseDatos();
    }

    public static function realizar($usuario_id, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora, $carrito, $nombreUsuario)
    {
        $pedido = new Pedido();
        if ($pedido->compruebaUnidades($carrito)) {


            
            $pedido->db->consulta("INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) VALUES ($usuario_id, \"{$provincia}\", \"{$localidad}\", \"{$direccion}\", $coste, \"{$estado}\", \"{$fecha}\", \"{$hora}\")");
            $pedidoId = $pedido->db->lastInsertId();
            $pedido->db->cierraConexion();
            $pedido->lineaPedido($carrito, $pedidoId, $nombreUsuario, $coste);
            return $pedidoId;
        } else {
            return false;
        }
    }

    private function compruebaUnidades($carrito){
        $producto = new Producto;

        foreach ($carrito as $productoId => $cantidad) {

            if(((Producto::getUnidadesDisponibles($productoId)) - $cantidad)<0){
                return false;
            }
        }

        return true;
    }

    private function lineaPedido($carrito, $pedidoId, $nombreUsuario, $coste)
    {
        $pedido = new Pedido();
        foreach ($carrito as $productoId => $cantidad) {
            $pedido->db->consulta("INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES ($pedidoId, $productoId, $cantidad)");
        }

        $this->actualizarUnidadesProducto($productoId, $cantidad);

        $pedido->db->cierraConexion();

        $pedido->enviarMail($pedidoId, $nombreUsuario, $carrito, $coste);
    }

    private function actualizarUnidadesProducto($productoId, $cantidad)
    {
        $pedido = new Pedido();

        $producto = new Producto;
        $nuevasUnidades = (Producto::getUnidadesDisponibles($productoId)) - $cantidad;

        $pedido->db->consulta("UPDATE productos SET stock = $nuevasUnidades WHERE id = $productoId");

        $pedido->db->cierraConexion();
    }

    private function enviarMail($pedidoId, $nombreUsuario, $carrito, $coste)
    {
        $mail = new PHPMailer(true);

        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'raulgodii13@gmail.com';                     //SMTP username
            $mail->Password   = 'vxgfbwpltnhcgvtz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('raulgodii13@gmail.com', 'Raul');
            $mail->addAddress('raulgodii13@gmail.com', 'Raul');     //Add a recipient
            $mail->addReplyTo('raulgodii13@gmail.com', 'Information');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Pedido {$pedidoId} realizado con exito!";
            $productos = "";
            foreach ($carrito as $productoId => $cantidad) {
                $nombreProducto = ProductoController::getNombre($productoId);
                $precio = ProductoController::getPrecio($productoId);
                $productos .= "<tr><td>$nombreProducto</td><td>$cantidad</td><td>$precio</td></tr>";
            }
            $mail->Body    = "Hola $nombreUsuario! Estos son los detalles de tu pedido:
                <table>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                    $productos
                </table>

                <p>Total: <b>$coste</b></p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }

    public static function getAll($usuario_id): ?array
    {
        $pedido = new Pedido();
        $pedido->db->consulta("SELECT * FROM pedidos WHERE usuario_id = \"{$usuario_id}\"");
        $pedidos = $pedido->db->extraer_todos();
        $pedido->db->cierraConexion();
        return $pedidos;
    }
}
