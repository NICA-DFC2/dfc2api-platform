<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Faker;

class LoadUsers extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
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

    public function load(ObjectManager $manager)
    {
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
        $this->addReference('user.super_admin', $superAdmin);
        unset($superAdmin);

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
        $this->addReference('user.admin', $admin);
        unset($admin);

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
        $this->addReference('user.demo_0', $user);
        unset($user);


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
            $this->addReference('user.demo_'.$i, $user);
            unset($user);
        }
    }
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }

}
