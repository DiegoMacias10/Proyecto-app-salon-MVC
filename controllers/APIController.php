<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){
       
        //Almacena la Cita y devuelve el Id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar(); //Insertar el objeto de cita en la BD
        $id = $resultado['id'];

        //Almacena la o las citas y el o los servicios

        //Almacena los servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);

        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //Retronamos una respuesta
        $respuesta = [
            'resultado' => $resultado
        ];
        echo json_encode($respuesta);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $cita = Cita::find($id); //Encontar los datos de la cita por medio del id
            $cita->eliminar(); //Eliminar la cita

            header('Location:' . $_SERVER['HTTP_REFERER']);

        }
    }
} 