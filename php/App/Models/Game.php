<?php

namespace Joc4enRatlla\Models;

/**
 * Summary of Game
 */
class Game
{
    private Board $board;
    private array $players;
    private int $nextPlayer;
    private ?Player $winner = null;
    
    /**
     * Summary of __construct
     * @param \Joc4enRatlla\Models\Player $player1
     * @param \Joc4enRatlla\Models\Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->board = new Board();
        $this->players = [1 => $player1, 2 => $player2];
        $this->nextPlayer = 1;
    }
    
    /**
     * Summary of play
     * @param int $column
     * @throws \Exception
     * @return void
     */
    public function play(int $column)
    {
        if (!$this->board->isValidMove($column)) {
            throw new \Exception("Movimiento inválido");
        }

        $coord = $this->board->setMovementOnBoard($column, $this->nextPlayer);
        if ($this->board->checkWin($coord, $this->nextPlayer)) {
            $this->winner = $this->players[$this->nextPlayer];
        }

        $this->nextPlayer = $this->nextPlayer === 1 ? 2 : 1;
    }
    
    /**
     * Summary of getBoard
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board->getBoard();
    }
    
    /**
     * Summary of getWinner
     * @return Player|null
     */
    public function getWinner(): ?Player
    {
        return $this->winner;
    }
    
    /**
     * Summary of getPlayers
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }
    
    /**
     * Summary of getNextPlayer
     * @return \Joc4enRatlla\Models\Player
     */
    public function getNextPlayer(): Player
    {
        return $this->players[$this->nextPlayer];
    }
    
    /**
     * Summary of reset
     * @return void
     */
    public function reset()
    {
        $this->board = new Board();
        $this->nextPlayer = 1;
        $this->winner = null;
    }
    
    /**
     * Summary of restore
     * @param \Joc4enRatlla\Models\Player $player1
     * @param \Joc4enRatlla\Models\Player $player2
     * @return Game|null
     */
    public static function restore(Player $player1, Player $player2) {
        if (isset($_SESSION['game_state'])) {
            $gameState = $_SESSION['game_state'];

            // Crear una nueva instancia de Game y restaurar su estado
            $game = new self($player1, $player2);
            $game->board = $gameState['board'];
            $game->players = $gameState['players'];

            return $game; // Devolver la instancia restaurada del juego
        } else {
            return null; // No se encontró estado del juego en la sesión
        }
    }

    // Método para guardar el estado del juego en la sesión    
    /**
     * Summary of save
     * @return void
     */
    public function save() {
        // Guardar el estado actual del juego (tablero y jugadores) en la sesión
        $_SESSION['game_state'] = [
            'board' => $this->board,
            'players' => $this->players
        ];

        echo "Estado del juego guardado.";
    }
}
