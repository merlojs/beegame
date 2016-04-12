<?php

namespace controllers;

use businessEntities\QueenBee;
use businessEntities\DroneBee;
use businessEntities\WorkerBee;


class Game 
{
    private $bees = array();
    private $round = 1;

    /**
     * @var array
     */
    private $hitLogs = array(); 


    /**
     * max number of QueenBee objects
     * @ar int
     */
    private $maxQueens;

    /**
     * @var int
     */
    private $maxWorkers;

    /**
     * @var int
     */
    private $maxDrones;

    /**
     * @param int $maxWorkers
     * @param int $maxDrones
     * @param int $maxQueens
     */
    public function __construct($maxWorkers = 5, $maxDrones = 8, $maxQueens = 1)
    {
        
        if (!is_null($maxWorkers)) $this->maxWorkers = $maxWorkers;
        if (!is_null($maxDrones))  $this->maxDrones  = $maxDrones;
        if (!is_null($maxQueens))  $this->maxQueens  = $maxQueens;


        for ($i = 0; $i < $this->maxQueens;$i++) {
            array_push($this->bees, new QueenBee());
        }
        for ($i = 0; $i < $this->maxWorkers;$i++) {
            array_push($this->bees, new WorkerBee());
        }
        for ($i = 0; $i < $this->maxDrones;$i++) {
            array_push($this->bees, new DroneBee());
        }
    }

    /**
     * @param int $position - if null, random bee hit
     * @return string
     */
    public function play($position)
    {
        $story = '';
       
        if (is_null($position)) {
            $position = rand(0, $this->getCountBees()-1);
        }

        if (!isset($this->bees[$position])) {
            throw new Exception("Bee position $position undefined");
        }
        

        /** @var \businessEntities\Bee $bee */
        $bee = $this->bees[$position];         

        if ($bee->hit()) {

            $comboPosition = $position;
            $comboPosition++;

            $story.= $bee->getClass(1).' #'.$comboPosition.' hit! '
                . $bee::$damagePerHit.' damage points taken. Current HP : '
                . $bee->getCurrentLifespan().' / '
                . $bee::$lifespan
                . '.'.PHP_EOL;            

            if ($bee->isKilled()) {                
                if ($bee instanceof QueenBee) {                    
                    $this->bees = array();
                    echo "<script type='text/javascript'>alert('Queen bee was killed! All other bees will die!');</script>";
                    
                } else {
                    unset($this->bees[$position]);
                    $this->bees = array_values(array_filter($this->bees));

                    $story.= $bee->getClass(1).' #'.$position.' killed ! Bees remaining : '
                        . $this->getCountBees()
                        . '.'.PHP_EOL;
                }
            }
        }

        $this->round++;
        $this->hitLogs[] = $story;
        return $story;
    }


    /**
     * @return bool
     */
    public function isDead()
    {
        return !(bool)$this->getCountBees();
    }

    /**
     * @return int
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @return array
     */
    public function getHitLogs()
    {
        return $this->hitLogs;
    }

    /**
     * @return array
     */
    public function getBees()
    {
        return $this->bees;
    }

    /**
     * @return int
     */
    public function getCountBees()
    {
        return count($this->bees);
    }

}