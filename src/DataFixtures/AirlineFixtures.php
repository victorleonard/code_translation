<?php

namespace App\DataFixtures;

use App\Entity\AirlineTranslations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AirlineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $airlineData = [
            ['code' => 'AF', 'category' => 'IATA', 'description' => 'Air France'],
            ['code' => 'BA', 'category' => 'IATA', 'description' => 'British Airways'],
            ['code' => 'LH', 'category' => 'IATA', 'description' => 'Lufthansa'],
            ['code' => 'DL', 'category' => 'IATA', 'description' => 'Delta Air Lines'],
            ['code' => 'UA', 'category' => 'IATA', 'description' => 'United Airlines'],
            ['code' => 'EK', 'category' => 'IATA', 'description' => 'Emirates'],
            ['code' => 'QR', 'category' => 'IATA', 'description' => 'Qatar Airways'],
            ['code' => 'SQ', 'category' => 'IATA', 'description' => 'Singapore Airlines'],
            ['code' => 'AA', 'category' => 'IATA', 'description' => 'American Airlines'],
            ['code' => 'QF', 'category' => 'IATA', 'description' => 'Qantas Airways'],
            ['code' => 'KL', 'category' => 'IATA', 'description' => 'KLM Royal Dutch Airlines'],
            ['code' => 'AC', 'category' => 'IATA', 'description' => 'Air Canada'],
            ['code' => 'CX', 'category' => 'IATA', 'description' => 'Cathay Pacific'],
            ['code' => 'NZ', 'category' => 'IATA', 'description' => 'Air New Zealand'],
            ['code' => 'FR', 'category' => 'IATA', 'description' => 'Ryanair'],
            ['code' => 'U2', 'category' => 'IATA', 'description' => 'easyJet'],
            ['code' => 'ET', 'category' => 'IATA', 'description' => 'Ethiopian Airlines'],
            ['code' => 'TG', 'category' => 'IATA', 'description' => 'Thai Airways'],
            ['code' => 'SK', 'category' => 'IATA', 'description' => 'SAS Scandinavian Airlines'],
            ['code' => 'SA', 'category' => 'IATA', 'description' => 'South African Airways'],
            ['code' => 'Oneworld', 'category' => 'ALLIANCE', 'description' => 'Oneworld Alliance'],
            ['code' => 'SkyTeam', 'category' => 'ALLIANCE', 'description' => 'SkyTeam Alliance'],
            ['code' => 'StarAlliance', 'category' => 'ALLIANCE', 'description' => 'Star Alliance'],
            ['code' => 'AAL', 'category' => 'ICAO', 'description' => 'American Airlines (ICAO)'],
            ['code' => 'BAW', 'category' => 'ICAO', 'description' => 'British Airways (ICAO)'],
            ['code' => 'DLH', 'category' => 'ICAO', 'description' => 'Lufthansa (ICAO)'],
            ['code' => 'UAE', 'category' => 'ICAO', 'description' => 'Emirates (ICAO)'],
            ['code' => 'QTR', 'category' => 'ICAO', 'description' => 'Qatar Airways (ICAO)'],
            ['code' => 'CPA', 'category' => 'ICAO', 'description' => 'Cathay Pacific (ICAO)'],
        ];

        foreach ($airlineData as $data) {
            $airline = new AirlineTranslations();
            $airline->setCode($data['code'])
            ->setCategory($data['category'])
            ->setDescription($data['description'])
            ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            $manager->persist($airline);
        }

        $manager->flush();
    }
}
