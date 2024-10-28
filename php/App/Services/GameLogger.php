<?php

namespace Joc4enRatlla\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\ErrorLogHandler;
/**
 * Summary of GameLogger
 */
class GameLogger
{
    private Logger $gameLogger;
    private Logger $errorLogger;
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        // Configura el logger de movimientos
        $this->gameLogger = new Logger('game');
        $this->gameLogger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/game.log', Logger::INFO));

        // Configura el logger de errores
        $this->errorLogger = new Logger('error');
        $this->errorLogger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/error.log', Logger::ERROR));
        $this->errorLogger->pushHandler(new ErrorLogHandler());
    }
    /**
     * Summary of logGameEvent
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logGameEvent(string $message, array $context = [])
    {
        $this->gameLogger->info($message, $context);
    }
    /**
     * Summary of logError
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logError(string $message, array $context = [])
    {
        $this->errorLogger->error($message, $context);
    }
}
