<?php

namespace AppBundle\Manager;

use AppBundle\Manager\BaseManager;
use AppBundle\Manager\PokemonManagerInterface;
use AppBundle\Entity\Pokemon;
use Doctrine\ORM\EntityManager;

class PokemonManager extends BaseManager implements PokemonManagerInterface
{
	protected $em;

	public function __construct(EntityManager $em){
		$this->em = $em;
	}

	public function createPokemon()
	{
		$pokemon = new Pokemon();
		return $pokemon;
	}

	public function savePokemon(Pokemon $pokemon){
		$this->persistAndFlush($pokemon);
	}
	
	public function getRepository(){
		return $this->em->getRepository('PokeBundle:Pokemon');
	}
}