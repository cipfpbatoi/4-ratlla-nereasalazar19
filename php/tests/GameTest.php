<?php

use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private Game $game;
    private Player $player1;
    private Player $player2;

    protected function setUp(): void
    {
        $this->player1 = new Player('Jugador 1', 'red');
        $this->player2 = new Player('Jugador 2', 'yellow');
        $this->game = new Game($this->player1, $this->player2);
    }

    public function testInitialBoardSetup()
    {
        $board = $this->game->getBoard();
        $this->assertIsArray($board, 'El tablero debe ser un array.');
        foreach ($board as $row) {
            $this->assertEquals(array_fill(0, Board::COLUMNS, 0), $row, 'Todas las posiciones deben estar vacías inicialmente.');
        }
    }

    public function testValidMove()
    {
        $this->game->play(3);
        $board = $this->game->getBoard();
        $this->assertEquals(1, $board[Board::FILES - 1][3], 'El primer movimiento debería aplicarse en la posición más baja de la columna.');
    }

    public function testWinningMove()
    {
        // Realiza una serie de movimientos que generen una victoria para el jugador 1.
        $this->game->play(0); // Jugador 1
        $this->game->play(1); // Jugador 2
        $this->game->play(0); // Jugador 1
        $this->game->play(1); // Jugador 2
        $this->game->play(0); // Jugador 1
        $this->game->play(1); // Jugador 2
        $this->game->play(0); // Jugador 1 gana

        $winner = $this->game->getWinner();
        $this->assertEquals($this->player1, $winner, 'El jugador 1 debería ser el ganador.');
    }

    public function testTieGame()
    {
        $board = $this->game->getBoard();
        // Llena el tablero sin que haya ganadores, alternando jugadores.
        for ($col = 0; $col < Board::COLUMNS; $col++) {
            for ($row = 0; $row < Board::FILES; $row++) {
                $this->game->play($col);
            }
        }
        $this->assertNull($this->game->getWinner(), 'No debe haber ganador en un empate.');
    }

    public function testSessionStatePersistence()
    {
        // Simula guardar y restaurar el estado de la sesión
        $this->game->play(0); // Jugador 1 hace un movimiento
        $this->game->save(); // Guarda el estado del juego en la sesión

        // Restaura el juego desde la sesión
        $restoredGame = Game::restore($this->player1, $this->player2);
        $this->assertEquals($this->game->getBoard(), $restoredGame->getBoard(), 'El tablero debería restaurarse correctamente.');
        $this->assertEquals($this->game->getNextPlayer(), $restoredGame->getNextPlayer(), 'El turno del jugador debería mantenerse en la sesión.');
    }
}
