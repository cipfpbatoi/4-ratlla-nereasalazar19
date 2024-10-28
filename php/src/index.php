<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';

use Joc4enRatlla\Controllers\GameController;
use Joc4enRatlla\Models\Player;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear jugadores a partir de los datos del formulario
    $player1 = new Player($_POST['nombre'], $_POST['color']);
    $player2 = new Player('Jugador 2', 'yellow', true);

    // Pasar datos de jugadores al controlador
    $gameController = new GameController($player1, $player2);
    $gameController->play($_POST); 
} else {
    loadView('jugador');
}
