<?php

namespace App\Command;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\ArticleDeclinaisonGroupe;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use PDO;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class UpdateArticlesCommand extends ContainerAwareCommand
{
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpassword;


    protected function configure()
    {
        $this
            ->setName ( 'app:article-update' )
            ->setDescription ( 'Update article table.' )
            ->setHelp ( 'This command update articles from the old database...' );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper ( 'question' );
        $question1 = new Question( 'Entrez le nom d\'hote de l\'ancien serveur mysql [192.168.46.8]: ', '192.168.46.8' );
        $question2 = new Question( 'Entrez le nom de l\'ancienne base mysql [dfc2]: ', 'dfc2' );
        $question3 = new Question( 'Nom d\'utilisateur mysql [root]: ', 'root' );
        $question4 = new Question( 'mot de passe mysql [badblock]: ', 'badblock' );
        $this->dbhost = $helper->ask ( $input, $output, $question1 );
        $this->dbname = $helper->ask ( $input, $output, $question2 );
        $this->dbuser = $helper->ask ( $input, $output, $question3 );
        $this->dbpassword = $helper->ask ( $input, $output, $question4 );

        $output->writeln(['Importation des catégories... ','']);
        $this->createCategories ($output);
        $output->writeln(['','Organisation des catégories... ','']);
        $this->organizeCategorie ($output);
        $output->writeln(['','Importation des articles... ','']);
        $this->createArticles ($output);
        $output->writeln(['','Organisation des déclinaisons... ','']);
        $this->createDeclinaisonGroupe($this->dbhost, $this->dbname, $this->dbuser, $this->dbpassword);
        $output->writeln(['','Organisation des Assignation des catégories... ','']);
        $this->assignCategorie ($this->dbhost, $this->dbname, $this->dbuser, $this->dbpassword);

    }


    private function dumpArticles($dbhost, $dbname, $dbuser, $dbpassword)
    {
        try {
            $bdd = new PDO( 'mysql:host=' . $dbhost . ';port=3306;dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );

        } catch (Exception $e) {
            die( 'Erreur : ' . $e->getMessage () );
        }
        $reponseArticles = $bdd->query ( 'SELECT * FROM ArtDet' );
        $articles = [];
        while($dumpedArticle = $reponseArticles->fetch ())
        {
            $article = new Article();
            $article->setOldId ($dumpedArticle['IdAD']);
            $article->setIdArtEvoAD ($dumpedArticle['IdEvoArtAD']);
            $article->setNoAD($dumpedArticle['NoAD']);
            $article->setCodAD ($dumpedArticle['CodAD']);
            $article->setPrixPubAD($dumpedArticle['PrixPubAD']);
            $article->setDesiAD ($dumpedArticle['DesiWebAD']);
            $article->setDesiPrincAD ($dumpedArticle['DesiWebDecliAD']);
            $article->setDescriWebAD ($dumpedArticle['DescriAD']);
            $article->setDescriCatalogAD ($dumpedArticle['DescriAD']);
            $article->setMediasAD ($dumpedArticle['MediaAD']);
            $article->setPlusAD ($dumpedArticle['PlusAD']);
            $article->setMotsClesAD ($dumpedArticle['MotsClesAD']);
            $article->setOrdreAD ($dumpedArticle['OrderDecliAD']);
            $article->setNumDecliAD ($dumpedArticle['IdDecliAD']);
            $article->setFlgAncAD ($dumpedArticle['FlgAncAD']);
            $article->setFlgCatalogAD ($dumpedArticle['FlgCatalogAD']);
            $article->setFlgPrincAD ($dumpedArticle['FlgDecliPrincAD']);
            $article->setFlgDestockAD ($dumpedArticle['FlgDestockAD']);
            $article->setFlgNouvAD ($dumpedArticle['FlgNouvAD']);
            $article->setFlgPromoAD ($dumpedArticle['FlgPromoAD']);
            $article->setFlgVisibleAD ($dumpedArticle['FlgVisibleAD']);
            $article->setFlgEclVertAD ($dumpedArticle['FlgEclVertAD']);
            $article->setFlgEclBleuAD ($dumpedArticle['FlgEclBleuAD']);
            $article->setFlgEclOrangeAD ($dumpedArticle['FlgEclOrangeAD']);
            $article->setFlgEclRoseAD ($dumpedArticle['FlgEclRoseAD']);
            $article->setIdFourAD ($dumpedArticle['IdFourAD']);
            $article->setDateCreAD (new \DateTime($dumpedArticle['DateCreAD']));
            $article->setDateModAD (new \DateTime($dumpedArticle['DateModAD']));
            $article->setUCreAD ($dumpedArticle['UCreAD']);
            $article->setUModAD ($dumpedArticle['UModAD']);
            $articles[] = $article;
        }

        $reponseArticles->closeCursor ();
        return $articles;
    }

    private function dumpCategories($dbhost, $dbname, $dbuser, $dbpassword)
    {
        try {
            $bdd = new PDO( 'mysql:host=' . $dbhost . ';port=3306;dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );

        } catch (Exception $e) {
            die( 'Erreur : ' . $e->getMessage () );
        }

        $categories = [];

        $reponseMarches = $bdd->query ( 'SELECT * FROM Marche ORDER BY LibM ASC' );
        while ($marches = $reponseMarches->fetch ()) {
            $marche = null;
            if ($marches['IdM'] == 1) {
                $marche = [
                    'id' => 11111,
                    'name' => $marches['LibM'],
                    'idParent' => null
                ];
            }
            if ($marches['IdM'] == 2) {
                $marche = [
                    'id' => 22222,
                    'name' => $marches['LibM'],
                    'idParent' => null
                ];
            }
            if ($marches['IdM'] == 3) {
                $marche = [
                    'id' => 33333,
                    'name' => $marches['LibM'],
                    'idParent' => null
                ];
            }
            if ($marches['IdM'] == 4) {
                $marche = [
                    'id' => 44444,
                    'name' => $marches['LibM'],
                    'idParent' => null
                ];
            }
            if ($marches['IdM'] == 5) {
                $marche = [
                    'id' => 55555,
                    'name' => $marches['LibM'],
                    'idParent' => null
                ];
            }
            $categories[] = $marche;

            $reponseNiv2 = $bdd->query ( 'select B.* from ArboCat as A inner join Cat as B on A.IdC = B.IdC where A.IdM ='.$marches['IdM'].' and A.FlgParente=1' );
            while ($niv2 = $reponseNiv2->fetch ()) {
                $categorie = [
                    'id' => $niv2['IdC'],
                    'name' => $niv2['LibC'],
                    'idParent' => $marche['id']
                ];


                    $categories[] = $categorie;

                $reponseNiv3 = $bdd->query ( 'select B.*, C.IdC as IdSC, C.LibC as LibSC from ArboCat as A inner join Cat as B on A.IdC = B.IdC inner join Cat as C on C.IdC = A.IdSousCatDe where A.IdSousCatDe='.$niv2['IdC'].' and A.IdM='.$marches['IdM'].' and A.FlgParente=0
' );
                while ($niv3 = $reponseNiv3->fetch ()) {
                    $categorie = [
                        'id' => $niv3['IdC'],
                        'name' => $niv3['LibC'],
                        'idParent' => $niv2['IdC']
                    ];

                    $categories[] = $categorie;

                    }
                    $reponseNiv3->closeCursor ();

            }
            $reponseNiv2->closeCursor ();

            }


        return $categories;
    }

    private function createArticles(OutputInterface $output){
        /**
         * @var EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();
        // Turning off doctrine default logs queries for saving memory
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $dumpedArticles  = $this->dumpArticles($this->dbhost, $this->dbname, $this->dbuser, $this->dbpassword);
        $size = count($dumpedArticles);

        // Starting progress
        $progress = new ProgressBar($output, $size);
        $progress->start();


        $loop = 0;

        foreach ($dumpedArticles as $dumpedArticle){



           $em->persist($dumpedArticle);
           if($loop % 100 == 0){
               $em->flush();
               $em->clear();
               $progress->advance(100);
           }
           $loop++;
        }
        $em->flush();
        $em->clear();
        $progress->finish();

    }

    private function createCategories(OutputInterface $output){
        /**
         * @var EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();
        // Turning off doctrine default logs queries for saving memory
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $dumpedCategories = $this->dumpCategories ($this->dbhost, $this->dbname, $this->dbuser, $this->dbpassword);
        $size = count($dumpedCategories);


        // Starting progress
        $progress = new ProgressBar($output, $size);
        $progress->start();

        foreach ($dumpedCategories as $dumpedCategorie){
            $category = new Categorie();
            $category->setOldId ($dumpedCategorie['id']);
            $category->setOldIdParent ($dumpedCategorie['idParent']);
            $category->setName ($dumpedCategorie['name']);
            $em->persist($category);
            $progress->advance(1);
        }
        $em->flush();
        $em->clear();
        $progress->finish();

    }

    private function organizeCategorie(OutputInterface $output){

        /**
         * @var EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();
        /**
         * @var EntityRepository $repository
         */
        $repository = $em->getRepository("App:Categorie");
        $categories = $repository->findAll();
        $size = count($categories);


        // Starting progress
        $progress = new ProgressBar($output, $size);
        $progress->start();



        /**
         * @var Categorie $category
         */
        foreach ($categories as $category){
            $parent = $repository->findOneBy(array('oldId' => $category->getOldIdParent ()));
            if($parent){
                $category->setParent ($parent);
                $em->persist($category);
                $progress->advance(1);
            }

        }
        $em->flush();
        $em->clear();
        $progress->finish();
    }

    private function createDeclinaisonGroupe($dbhost, $dbname, $dbuser, $dbpassword)
    {
        /**
         * @var EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();
        /**
         * @var EntityRepository $repository
         */
        $repository = $em->getRepository("App:Article");

        try {
            $bdd = new PDO( 'mysql:host=' . $dbhost . ';port=3306;dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );

        } catch (Exception $e) {
            die( 'Erreur : ' . $e->getMessage () );
        }


        $results = $bdd->query (
            'SELECT AD.* FROM ArtDet as AD WHERE (SELECT count(*) FROM ArtDet as AD2 WHERE AD2.IdDecliAD=AD.IdDecliAD ) > 1 AND FlgDecliPrincAD=1'
        );

        $batchSize = 25;
        $count = 0;

        while ($result = $results->fetch ()) {

            $groupe = new ArticleDeclinaisonGroupe();
            $groupe->setNom ($result['DesiWebDecliAD']);
            $groupe->setDescription ($result['DescriAD']);
            $em->persist ($groupe);
            /**
             * @var Collection $membres
             */
            $membres = $repository->findBy(array('NumDecliAD' => $result['IdDecliAD'] ));
            /**
             * @var Article $membre
             */
            foreach ($membres as $membre){
                $membre->setDeclinaisonGroupe ($groupe);
                $em->persist ($membre);
            }
            if($count % $batchSize == 0)
            {
                $em->flush ();
                $em->clear ();
            }

            $count++;
        }
        $results->closeCursor ();

        $em->flush ();
        $em->clear ();
    }

    private function assignCategorie($dbhost, $dbname, $dbuser, $dbpassword){
        /**
         * @var EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager();
        /**
         * @var EntityRepository $repository
         */
        $articleRepository = $em->getRepository("App:Article");
        $categoryRepository = $em->getRepository ("App:Categorie");

        $query = 'SELECT DISTINCT AD.IdAD, IF(C1.IdC = M.IdM, \'\', C2.IdC) as IdC FROM CatArt as CA INNER JOIN ArtDet as AD ON AD.IdAD = CA.IdAD INNER JOIN Marche as M ON M.IdM = CA.IdM INNER JOIN Cat as C1 ON C1.IdC = CA.IdCP INNER JOIN Cat as C2 ON C2.IdC = CA.IdC WHERE (IF(C1.IdC = M.IdM, \'\', C2.LibC)<>\'\') ORDER BY AD.IdAD ASC';
        try {
            $bdd = new PDO( 'mysql:host=' . $dbhost . ';port=3306;dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );

        } catch (Exception $e) {
            die( 'Erreur : ' . $e->getMessage () );
        }
        $results = $bdd->query ($query);
        $batchSize = 25;
        $count = 0;
        while ($result = $results->fetch ()) {
            /**
             * @var Article $article
             * @var Categorie $category
             */
            $article = $articleRepository->findOneBy (array('oldId' => $result['IdAD']));
            $category = $categoryRepository->findOneBy (array('oldId' => $result['IdC']));
            $article->addCategorie ($category);
            $em->persist ($article);
            $em->persist ($category);
            if($count % $batchSize == 0)
            {
                $em->flush ();
                $em->clear ();
            }
            $count++;

        }
        $results->closeCursor ();

    }
}
