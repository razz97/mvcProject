<?php

namespace App\Controllers;

class Controller {
	/* All the other controllers will inherit from this class
	Adds accessibility of DIC to the other controllers by the __get() method
    Adds a constructor setting a container variable equal to application container */
	
	protected $container;
	
	public function __construct($container)  {
		$this->container = $container;
	}
	
	public function __get($property) {
		/* Checks if a dependency is stored in container and returns it,
		so we can use $this->property instead of $this->container->property */
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}
	
}

