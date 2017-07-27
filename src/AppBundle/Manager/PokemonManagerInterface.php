<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Pokemon;
/**
 * Toutes les modifications apportées aux pokemons doivent se faire via cette interface.
 *
 */
interface PokemonManagerInterface
{
    /**
     * Create an empty Pokemon instance.
     *
     * @return Pokemon
     */
    public function createPokemon();

    /**
     * Save a pokemon.
     *
     * @param Pokemon $pokemon
     */
    public function savePokemon(Pokemon $pokemon);

    /**
     * Get the repository.
     * @return EntityManager
     */
    public function getRepository();
}
