<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Faker;

class UserImportCommand extends Command implements ContainerAwareInterface
{
    protected static $defaultName = 'users:import';

    /**
     * @var ContainerInterface
     */
    private $container;


    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    protected function configure()
    {
        $this
            ->setDescription('Fill database with users account.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $test_password = 'test';
        /** @var $manager \FOS\UserBundle\Doctrine\UserManager */
        $manager = $this->container->get('fos_user.user_manager');


        /** @var $superAdmin \App\Entity\User */
        $superAdmin = $manager->createUser();
        $superAdmin->setUsername('superadmin');
        $superAdmin->setRaisonSociale("DFC2");
        $superAdmin->setEmail('superadmin@example.com');
        $superAdmin->setFullname('Super Admin');
        $superAdmin->setRoles(array('ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_USER'));
        $superAdmin->setEnabled(true);
        $superAdmin->setPlainPassword($test_password);
        $superAdmin->setCode("PERSO124");
        $manager->updateUser($superAdmin);
        unset($superAdmin);
        $io->success('SuperAdmin user created!');

        $rep = $manager->createUser();
        $rep->setUsername('DIBL');
        $rep->setRaisonSociale("DFC2");
        $rep->setEmail('d.blanloeil@dfc2.biz');
        $rep->setFullname('Didier Blanloeil');
        $rep->setRoles(array('ROLE_COMMERCIAL'));
        $rep->setEnabled(true);
        $rep->setPlainPassword($test_password);
        $rep->setCode("DIBL");
        $manager->updateUser($rep);
        unset($rep);
        $io->success('Representant user created!');

        /** @var $admin \App\Entity\User */
        $admin = $manager->createUser();
        $admin->setUsername('admin');
        $admin->setEmail('admin@example.com');
        $admin->setFullname('Standard Admin');
        $admin->setRoles(array('ROLE_ADMIN', 'ROLE_USER'));
        $admin->setEnabled(true);
        $admin->setPlainPassword($test_password);
        $admin->setCode("PERSO124");
        $manager->updateUser($admin);
        unset($admin);
        $io->success('Admin user created!');

        $user = $manager->createUser();
        $user->setUsername('user');
        $user->setPlainPassword($test_password);
        $user->setEmail('user@example.com');
        $user->setFullname('Standard User');
        $user->setRaisonSociale("DFC2");
        $user->setRoles(array('ROLE_USER'));
        $user->setEnabled(true);
        $user->setCode("PERSO124");
        $manager->updateUser($user);
        unset($user);
        $io->success('User created!');


        $faker = Faker\Factory::create('fr_FR');
        for($i = 1; $i < 10; $i++){
            $user = $manager->createUser();
            $user->setUsername($faker->userName);
            $user->setPlainPassword($test_password);
            $user->setEmail($faker->safeEmail);
            $user->setFullname($faker->firstName . ' ' . $faker->lastName);
            $user->setRaisonSociale($faker->company);
            $user->setRoles(array('ROLE_USER'));
            $user->setEnabled(true);
            $manager->updateUser($user);
            unset($user);
        }
        $io->success('Users fictifs created!');

    }
}
