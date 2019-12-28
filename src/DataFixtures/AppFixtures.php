<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use DateTimeInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // lets create 100 students
        for ($i = 0; $i < 100; $i++) {
            $student = new Student();
            $student->setName($faker->firstName);
            $student->setSurname($faker->lastName);
            $student->setGender($faker->title('male'|'female'));
            $student->setMatricule($faker->numberBetween(1111111, 999999));

            $student->setNationality($faker->country);
            $student->setAddress($faker->streetAddress);

            $student->setProfile($faker->paragraphs(3, true));

            $student->setTelephone($faker->phoneNumber);
            $student->setEmail($faker->email);
            $student->setBirthdate($faker->dateTime);
            $student->setPostalcode($faker->postcode);
            /*$student->setCreatedAt($faker->dateTime);

            */


            $manager->persist($student);
        }

        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

    }
}
