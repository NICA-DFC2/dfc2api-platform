<?php

namespace App\DataFixtures;


use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Faker;

class LoadArticles extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 50; $i++){
            $category = new Categorie();
            $childrenCategory = new Categorie();
            $childrenCategory->setName ($faker->text (10));
            $childrenCategory->setIcon($faker->imageUrl(100, 100));
            $category->addChildren ($childrenCategory);
            $category->setName ($faker->text (10));
            $category->setIcon($faker->imageUrl(100, 100));
            $article = new Article();
            $article->setIdArtEvoAD(271507); // IdArt qui existe
            $article->setDesiAD($faker->text(50));
            $article->setDesiPrincAD($faker->text(50));
            $article->setDescriWebAD($faker->text(200));
            $article->setDescriCatalogAD($faker->text(200));
            $article->setMediasAD($faker->imageUrl(640,480, 'cats', true, 'DFC2', false));
            $article->setPlusAD($faker->text(200));
            $article->setMotsClesAD($faker->sentence(6));
            $article->setOrdreAD($faker->numberBetween(0,5));
            $article->setNumDecliAD($faker->numberBetween(1,200));
            $article->setFlgAncAD($faker->boolean());
            $article->setFlgCatalogAD($faker->boolean());
            $article->setFlgPrincAD($faker->boolean());
            $article->setFlgDestockAD($faker->boolean());
            $article->setFlgHorsMarqueAD($faker->boolean());
            $article->setFlgNouvAD($faker->boolean());
            $article->setFlgPromoAD($faker->boolean());
            $article->setFlgVisibleAD($faker->boolean());
            $article->setFlgEclBleuAD($faker->boolean());
            $article->setFlgEclOrangeAD($faker->boolean());
            $article->setFlgEclRoseAD($faker->boolean());
            $article->setFlgEclVertAD($faker->boolean());
            $article->setDateCreAD($faker->dateTimeBetween('-5 years','-2 years'));
            $article->setDateModAD($faker->dateTimeBetween('-2 years', 'now'));
            $article->addCategory ($childrenCategory);
            $manager->persist($article);
            $manager->flush();
            $manager->clear();

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
