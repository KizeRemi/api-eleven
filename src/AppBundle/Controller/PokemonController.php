<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use AppBundle\Entity\Pokemon;

class PokemonController extends Controller
{
    /**
     * 200 si la requête s'est bien effectuée
     * 
     * @ApiDoc(
     *  section="Pokemon",
     *  description="Get all pokemon",
     *  resource = true,
     *  statusCodes = {
     *     200 = "Successful"
     *   }
     * )
     * @FOSRest\Get("/pokemon")
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pokemons = $em->getRepository('AppBundle:Pokemon')->findAll();
        return $pokemons;
    }

    /**
     * 200 si la requête s'est bien effectuée
     * 404 si la ressource n'existe pas
     * @ApiDoc(
     *  section="Pokemon",
     *  description="Get a pokemon",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Successful",
     *     404 = "Not found"
     *   }
     * )
     * @FOSRest\Get("/pokemon/{pokemon}")
     */
    public function getAction(Pokemon $pokemon)
    {
        return $pokemon;
    }

    /**
     * 201 si la ressource a bien été créée.
     * 400 si les données envoyées ne sont pas complètes
     * @ApiDoc(
     *  section="Pokemon",
     *  description="Create a new pokemon",
     *  resource = true,
     *  statusCodes = {
     *     201 = "Created",
     *     400 = "Bad request"
     *   }
     * )
     *
     * @RequestParam(name="number", nullable=false, description="Pokemon number in pokedex")
     * @RequestParam(name="name", nullable=false, description="Pokemon name")
     * @RequestParam(name="description", nullable=false, description="Description of the pokemon")
     * @FOSRest\Post("/pokemon")
     */
    public function postAction(ParamFetcherInterface $paramFetcher)
    {
        // penser a rendre le service public depuis Symfony 3.3
        $pokeManager= $this->container->get('app.poke_manager');

        $pokemon = $pokeManager->createPokemon();
        $pokemon->setNumber($paramFetcher->get('number'));
        $pokemon->setName(ucfirst($paramFetcher->get('name')));
        $pokemon->setDescription($paramFetcher->get('description'));

        $pokeManager->savePokemon($pokemon);

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
