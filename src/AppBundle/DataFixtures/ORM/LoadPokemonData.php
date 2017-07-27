<?php
Namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Pokemon;

class LoadPokemonData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $pokemon = new Pokemon();
        $pokemon->setName("Bulbizarre");
        $pokemon->setDescription("La graine sur le dos de Bulbizarre est une réserve de nutriments. Il la fait doucement pousser en absorbant les rayons du soleil, et emmagasine de l\'énergie dedans en vue de son évolution. S\'il dépense trop souvent son énergie, il n\'évoluera pas car l\'ouverture de son bulbe dépend de ses réserves de nutriments.");
        $pokemon->setNumber(1);
        $manager->persist($pokemon);

        $pokemon = new Pokemon();
        $pokemon->setName("Herbizarre");
        $pokemon->setDescription("Le bulbe sur le dos de Herbizarre a éclos, dévoilant ainsi une fleur fermée. Plus il passe de temps au soleil, plus sa fleur se prépare à s\'ouvrir, et quelques temps avant son évolution, il dégage une douce odeur fruitée. Attention à ses Tranch\'herbes et à ses Fouets lianes.");
        $pokemon->setNumber(2);
        $manager->persist($pokemon);
	    $manager->flush();
  	}

    public function getOrder()
    {
        return 1;
    }
}