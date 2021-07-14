<?php

namespace App\DataFixtures;

use App\Entity\WeatherCheckpoint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i <= 1001; $i++) {
            $point = new WeatherCheckpoint();
            $point->setTemperature(rand(0, 100) / 10);
            $point->setSpeedWind(rand(0, 100) / 10);
            $point->setCheckDate(new \DateTime(date('Y-m-d H:i:s')));

            $manager->persist($point);

        }
        $manager->flush();

    }

}
