<?php

namespace Joc4enRatlla\Models;

/**
 * Summary of Player
 */
class Player
{
    private string $name;
    private string $color;
    private bool $isAutomatic;
    
    /**
     * Summary of __construct
     * @param string $name
     * @param string $color
     * @param bool $isAutomatic
     */
    public function __construct(string $name, string $color, bool $isAutomatic = false)
    {
        $this->name = $name;
        $this->color = $color;
        $this->isAutomatic = $isAutomatic;
    }
    
    /**
     * Summary of getName
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Summary of getColor
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
    
    /**
     * Summary of isAutomatic
     * @return bool
     */
    public function isAutomatic(): bool
    {
        return $this->isAutomatic;
    }
}
