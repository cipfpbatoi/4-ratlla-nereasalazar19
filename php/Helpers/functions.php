<?php

/**
 * Summary of loadView
 * @param mixed $view
 * @param mixed $data
 * @return void
 */
function loadView($view, $data = [])
    {
       Joc4enRatlla\Services\Service::loadView($view, $data);
    }

    function dd(...$data )
    {
        echo "<pre>";
        foreach ($data as $d) {
            var_dump($d);
        }

        echo "</pre>";
        die();
    }

    