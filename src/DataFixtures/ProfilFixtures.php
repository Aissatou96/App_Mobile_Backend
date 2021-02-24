<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfilFixtures extends Fixture
{
    public const PROFIL = 'profil';
    public function load(ObjectManager $manager)
    {
        $profils  = ['AdminSystem', 'AdminAgence', 'Caissier', 'UserAgence'];
        for ($i=0; $i < count($profils) ; $i++) { 
           $profil = new Profil();
           $profil->setLibelle($profils[$i]);
           $manager->persist($profil); 
        $this->addReference(self::PROFIL.$i,$profil);   
        }

        $manager->flush();
    }
}
