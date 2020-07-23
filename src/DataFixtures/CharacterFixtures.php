<?php


namespace App\DataFixtures;


use App\Entity\Character;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterFixtures extends Fixture
{
    const CHARACTERS = [
        'Firebrand',
        'Spellbreaker',
        'Herald',
        'Renegade',
        'Daredevil',
        'Berserker',
        'Soulbeast',
        'Scrapper',
        'Chronomancer',
        'Mirage',
        'Necromancer',
        'Reaper',
        'Scourge',
        'Elementalist',
        'Tempest',
        'Weaver',
        'Scrapper Dps',
    ];
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 17; $i++) {
            $character = new Character();
            $character->setName(self::CHARACTERS[$i]);
            $manager->persist($character);
            $this->addReference('character-' . $i, $character);
        }

        $manager->flush();
    }
}
