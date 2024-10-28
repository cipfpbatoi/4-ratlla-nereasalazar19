<?php

namespace Joc4enRatlla\Services;

/**
 * Summary of Service
 */
class Service
{    
    /**
     * Summary of loadView
     * @param mixed $view
     * @param mixed $data
     * @throws \Exception
     * @return void
     */
    public static function loadView($view, $data = [])
    {
        // Construir la ruta correcta para la vista
        $viewPath = $_SERVER['DOCUMENT_ROOT'] . '/../Views/' . $view . '.php';

        // Comprobar si la vista existe
        if (file_exists($viewPath)) {
            // Extraer los datos para que sean accesibles en la vista
            extract($data);
            include $viewPath;
        } else {
            throw new \Exception("Vista no encontrada: $view");
        }
    }
}
