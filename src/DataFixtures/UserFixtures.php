<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    const PSEUDO = [
        'Thomss33',
        'Alverein',
        'Edwyna',
        'Reibeyna',
        'Itchys',
        'Fèlin',
        'Isna',
        'Wings',
        'Ras',
        'Mordread',
        'Nico',
        'Frip',
        'Myrms',
        'Grishnack',
        'Nyra',
        'Alwin',
        'TornMetal',
        'Carael',
        'Aroukay',
        'Peteek',
    ];

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setPseudo(self::PSEUDO[$i])
                ->setPassword($this->encoder->encodePassword($user, '123456789'))
                ->setEmail(self::PSEUDO[$i] . '@bidon.fr')
                ->addCharacter($this->getReference('character-'. rand(0, 17)))
                ->setRoles(['ROLE_USER']);
            $manager->persist($user);
            $this->addReference('user_'. $i, $user);
        }

        $manager->flush();
    }
}
