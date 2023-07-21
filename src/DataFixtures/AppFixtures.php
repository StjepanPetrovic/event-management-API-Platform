<?php

namespace App\DataFixtures;

use App\Factory\SportEventFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SportEventFactory::createMany(40);
        UserFactory::createMany(10);
    }
}
