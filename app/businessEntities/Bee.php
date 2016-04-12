<?php

namespace businessEntities;


abstract class Bee
{
    /**
     * Max Hit Points
     * @var int
     */
    public static $lifespan = 75;

    /**
     * Damage per Hit taken
     * @var int
     */
    public static $damagePerHit = 10;

    /**
     * Current Hit points
     * @var int
     */
    protected $currentLifespan;


    public function __construct()
    {
        $this->currentLifespan = static::$lifespan;
    }

    public function getCurrentLifespan()
    {
        return $this->currentLifespan;
    }

    /**
     * return child class
     *
     * @param bool $short
     * @return string
     */
    public function getClass($short = false)
    {
        if ($short) {
            $className = explode('\\', get_class($this));
            return end($className);
        } else {
            return get_class($this);
        }
    }

    /**
     *
     * @return bool if hit point lowered
     */
    public function hit()
    {
        if (!$this->isKilled()) {
            $this->currentLifespan = max(0, $this->currentLifespan - static::$damagePerHit);
            return true;
        } else {
            return false;
        }
    }

    public function isKilled()
    {
        if (!$this->currentLifespan) {
            return true;
        } else {
            return false;
        }
    }

}