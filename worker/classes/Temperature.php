<?php

abstract class Temperature {


	public function __construct()
	{
	}

	abstract function getTemperature();
    abstract function getPowerDrain();

}