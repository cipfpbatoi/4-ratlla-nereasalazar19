<?php

namespace Joc4enRatlla\Models;

/**
 * Summary of Board
 */
class Board
{
    public const FILES = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    private array $slots;
    
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->slots = $this->initializeBoard();
    }
    
    /**
     * Summary of initializeBoard
     * @return array
     */
    private function initializeBoard(): array
    {
        return array_fill(0, self::FILES, array_fill(0, self::COLUMNS, 0));
    }
    
    /**
     * Summary of setMovementOnBoard
     * @param int $column
     * @param int $player
     * @throws \Exception
     * @return array
     */
    public function setMovementOnBoard(int $column, int $player): array
    {
        for ($row = self::FILES - 1; $row >= 0; $row--) {
            if ($this->slots[$row][$column] == 0) {
                $this->slots[$row][$column] = $player;
                return [$column, $row];
            }
        }
        throw new \Exception("Columna llena");
    }
    
    /**
     * Summary of checkWin
     * @param array $coord
     * @param int $player
     * @return bool
     */
    public function checkWin(array $coord, int $player): bool
    {
        [$col, $row] = $coord;

        foreach (self::DIRECTIONS as [$dx, $dy]) {
            $count = 1;
            for ($i = 1; $i <= 3; $i++) {
                if (isset($this->slots[$row + $dy * $i][$col + $dx * $i]) &&
                    $this->slots[$row + $dy * $i][$col + $dx * $i] == $player) {
                    $count++;
                } else {
                    break;
                }
            }

            for ($i = 1; $i <= 3; $i++) {
                if (isset($this->slots[$row - $dy * $i][$col - $dx * $i]) &&
                    $this->slots[$row - $dy * $i][$col - $dx * $i] == $player) {
                    $count++;
                } else {
                    break;
                }
            }

            if ($count >= 4) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Summary of isValidMove
     * @param int $column
     * @return bool
     */
    public function isValidMove(int $column): bool
    {
        return $this->slots[0][$column] == 0;
    }
    
    /**
     * Summary of getBoard
     * @return array
     */
    public function getBoard(): array
    {
        return $this->slots;
    }
}
