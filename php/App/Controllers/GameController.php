<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Services\Service;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Services\GameLogger;
/**
 * Summary of GameController
 */
class GameController
{
    private Game $game;
    private GameLogger $logger;
    /**
     * Summary of __construct
     * @param \Joc4enRatlla\Models\Player $player1
     * @param \Joc4enRatlla\Models\Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->logger = new GameLogger();
        $this->game = Game::restore($player1, $player2) ?? new Game($player1, $player2);

        $this->logger->logGameEvent("Nueva partida iniciada", [
            'player1' => $player1->getName(),
            'player2' => $player2->getName()
        ]);
    }
    /**
     * Summary of play
     * @param array $request
     * @return void
     */
    public function play(array $request)
    {
        try {
            if (isset($request['columna'])) {
                $this->game->play((int)$request['columna']);
                $this->logger->logGameEvent("Movimiento realizado", [
                    'player' => $this->game->getNextPlayer()->getName(),
                    'column' => $request['columna']
                ]);
            }

            if (isset($request['reiniciar'])) {
                $this->game->reset();
                $this->logger->logGameEvent("El juego ha sido reiniciado");
            }

            $this->game->save();
            Service::loadView('index', [
                'board' => $this->game->getBoard(),
                'players' => $this->game->getPlayers(),
                'winner' => $this->game->getWinner(),
                'nextPlayer' => $this->game->getNextPlayer()
            ]);
        } catch (\Exception $e) {
            $this->logger->logError("Error en el juego", ['message' => $e->getMessage()]);
            echo $e->getMessage();
        }
    }
}
