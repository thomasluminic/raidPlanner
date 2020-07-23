<?php


namespace App\DataFixtures;


use App\Entity\Raid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RaidFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $raid = new Raid();
            $raid->setUser($this->getReference('user_'. $i))
                ->setUserCharacter($this->getReference('character-'. rand(0,16)))
                ->setDayOne((bool)random_int(0, 1))
                ->setDayTwo((bool)random_int(0, 1))
                ->setDayThree((bool)random_int(0, 1));
            $manager->persist($raid);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
