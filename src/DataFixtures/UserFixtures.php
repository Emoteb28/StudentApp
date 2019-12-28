<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // lets create 100 students
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword(
            $user,'the_new_password'
            ));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
