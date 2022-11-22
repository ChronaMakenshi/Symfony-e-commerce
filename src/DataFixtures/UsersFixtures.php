<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder, private SluggerInterface $slugger)
    {
        
    }
    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('christophe.mestdagh@sfr.fr');
        $admin->setLastname('Christophe');
        $admin->setFirstname('Mestdagh');
        $admin->setAddress('9 rue Icarie');
        $admin->setZipcode('24000');
        $admin->setCity('Périgueux');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr = 2; $usr <= 6; $usr++){
            $user = new Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipcode(str_replace(' ','', $faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'admin'));
            $user->setRoles(['ROLE_USER']);
    
            $manager->persist($user);
        }

        $manager->flush();

        $manager->flush();
    }
}
