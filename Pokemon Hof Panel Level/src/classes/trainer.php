<?php 

class Trainer {
    public $name;
    public $starter;
    public $isChampion;

    public function __construct($name, $starter) {
        $this->name = $name;
        $this->starter = $starter;
        $this->isChampion = false;
    }
    public function getname() {
        return $this->name;
    }
    public function getChampion() {
        return $this->isChampion;
    }
    public function setname($name) {
        $this->name = $name;
    }
}

?>