<?php

class Payload {

    /**
     * @var Command
     */
    protected $command;

    /**
     * @var Temperature
     */
    protected $temperature;


    public function __construct()
    {

    }

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function setTemperature(Temperature $temperature) {
        $this->temperature = $temperature;
    }

    public function prepareReport() {

        $temp = $this->temperature->getTemperature();
        $hash = $this->command->getHashRate();
        $power = $this->temperature->getPowerDrain();

        $result = array(
            'report'=>array(
                'temperature'=>$temp,
                'hashrate'=> $hash,
                'power'=>$power,
            ),
            'answer'=>array(),
        );

        return $result;
    }

}