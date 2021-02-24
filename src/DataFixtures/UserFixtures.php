<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER = 'User';
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5 ; $i++) { 
            $user = new User();
            $user->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName())
                 ->setEmail($faker->email())
                 ->setPassword($this->encoder->encodePassword($user, "passer123"))
            ;
            $manager->persist($user);
            $this->addReference(self::USER.$i,$user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProfilFixtures::class
        ];
    }
}
