<?php

namespace App\DataFixtures;

use App\Entity\HotelTranslations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HotelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $hotelData = [
            ['code' => 'HILTON', 'category' => 'CHAIN', 'description' => 'Hilton Hotels & Resorts'],
            ['code' => 'MARRIOTT', 'category' => 'CHAIN', 'description' => 'Marriott International'],
            ['code' => 'IBIS', 'category' => 'BUDGET', 'description' => 'Ibis Hotels'],
            ['code' => 'FOUR_SEASONS', 'category' => 'LUXURY', 'description' => 'Four Seasons Hotels & Resorts'],
            ['code' => 'RITZ', 'category' => 'LUXURY', 'description' => 'The Ritz-Carlton Hotel'],
            ['code' => 'HOLIDAY_INN', 'category' => 'CHAIN', 'description' => 'Holiday Inn'],
            ['code' => 'ACCOR', 'category' => 'CHAIN', 'description' => 'Accor Hotels Group'],
            ['code' => 'TRAVELODGE', 'category' => 'BUDGET', 'description' => 'Travelodge Hotels'],
            ['code' => 'MOTEL_6', 'category' => 'BUDGET', 'description' => 'Motel 6'],
            ['code' => 'HYATT', 'category' => 'CHAIN', 'description' => 'Hyatt Hotels Corporation'],
            ['code' => 'WESTIN', 'category' => 'LUXURY', 'description' => 'The Westin Hotels & Resorts'],
            ['code' => 'SHERATON', 'category' => 'CHAIN', 'description' => 'Sheraton Hotels & Resorts'],
            ['code' => 'FAIRMONT', 'category' => 'LUXURY', 'description' => 'Fairmont Hotels & Resorts'],
            ['code' => 'MANDARIN', 'category' => 'LUXURY', 'description' => 'Mandarin Oriental Hotels'],
            ['code' => 'RADISSON', 'category' => 'CHAIN', 'description' => 'Radisson Hotels'],
            ['code' => 'COMFORT_INN', 'category' => 'BUDGET', 'description' => 'Comfort Inn by Choice Hotels'],
            ['code' => 'ALOFT', 'category' => 'BOUTIQUE', 'description' => 'Aloft Hotels by Marriott'],
            ['code' => 'W_HOTELS', 'category' => 'BOUTIQUE', 'description' => 'W Hotels Worldwide'],
            ['code' => 'CITIZENM', 'category' => 'BOUTIQUE', 'description' => 'CitizenM Hotels'],
            ['code' => 'PARK_INN', 'category' => 'BUDGET', 'description' => 'Park Inn by Radisson'],
            ['code' => 'NOVOTEL', 'category' => 'CHAIN', 'description' => 'Novotel by Accor Hotels'],
            ['code' => 'SOFITEL', 'category' => 'LUXURY', 'description' => 'Sofitel Hotels & Resorts'],
        ];

        foreach ($hotelData as $data) {
            $hotel = new HotelTranslations();
            $hotel->setCode($data['code'])
                ->setCategory($data['category'])
                ->setDescription($data['description'])
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            $manager->persist($hotel);
        };

        $manager->flush();
    }
}
