<?php

namespace App\DataFixtures;



use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;



class LoadCategory extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //Attention, il faut retirer la première ligne (titre des colonnes) avant de lancer l'import
        if (($file = fopen(dirname(__FILE__).'/Resources/categories.csv', 'r')) !== FALSE) {
            while (($column = fgetcsv($file, 0, ";")) !== FALSE)
            {
                $categorie = new Category();
                $categorie->setId ($column[0])->setName($column[3]);

                $manager->persist($categorie);
                $metadata = $manager->getClassMetaData(get_class($categorie));
                $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());


                $this->addReference('categorie'.$column[0], $categorie);
            }
            fclose($file);
        }





    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2;
    }

}
