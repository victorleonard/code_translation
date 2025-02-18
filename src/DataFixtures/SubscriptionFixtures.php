<?php

namespace App\DataFixtures;

use App\Entity\SubscriptionPlan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscriptionData = [
            [
                'code' => 'premium',
                'domain' => 'airline',
                'benefits' => 'Unlimited access, priority support, advanced options.',
                'restrictions' => 'No restrictions.',
            ],
            [
                'code' => 'standard',
                'domain' => 'airline',
                'benefits' => 'Access to most features, standard support.',
                'restrictions' => 'No advanced options, limited to 10 bookings per month.',
            ],
            [
                'code' => 'economy',
                'domain' => 'airline',
                'benefits' => 'Basic access to services.',
                'restrictions' => 'Limited to 5 bookings per month, no support included.',
            ],
            [
                'code' => 'premium',
                'domain' => 'hotel',
                'benefits' => 'Priority booking, exclusive discounts, free cancellations.',
                'restrictions' => 'No restrictions.',
            ],
            [
                'code' => 'standard',
                'domain' => 'hotel',
                'benefits' => 'Standard booking options, some discounts.',
                'restrictions' => 'No free cancellations, limited to 5 stays per month.',
            ],
            [
                'code' => 'economy',
                'domain' => 'hotel',
                'benefits' => 'Basic booking options.',
                'restrictions' => 'Limited discounts, no free cancellations.',
            ],
            [
                'code' => 'business',
                'domain' => 'airline',
                'benefits' => 'Access to business lounges, flexible tickets.',
                'restrictions' => 'Restricted to business routes.',
            ],
            [
                'code' => 'vip',
                'domain' => 'hotel',
                'benefits' => 'Luxury room upgrades, exclusive services, personal concierge.',
                'restrictions' => 'No restrictions.',
            ],
            [
                'code' => 'frequent_traveler',
                'domain' => 'airline',
                'benefits' => 'Extra luggage allowance, fast-track boarding.',
                'restrictions' => 'Only valid on partner airlines.',
            ],
            [
                'code' => 'family',
                'domain' => 'hotel',
                'benefits' => 'Family suites, discounted kids meals.',
                'restrictions' => 'Minimum 2 children per booking.',
            ],
            [
                'code' => 'student',
                'domain' => 'airline',
                'benefits' => 'Special fares, flexible tickets.',
                'restrictions' => 'Valid for students under 25 only.',
            ],
            [
                'code' => 'group',
                'domain' => 'hotel',
                'benefits' => 'Group discounts, reserved meeting spaces.',
                'restrictions' => 'Minimum 5 rooms per booking.',
            ],
            [
                'code' => 'corporate',
                'domain' => 'airline',
                'benefits' => 'Corporate discounts, dedicated account manager.',
                'restrictions' => 'Only for corporate bookings.',
            ],
            [
                'code' => 'corporate',
                'domain' => 'hotel',
                'benefits' => 'Corporate rates, access to meeting rooms.',
                'restrictions' => 'Restricted to corporate bookings only.',
            ],
            [
                'code' => 'luxury',
                'domain' => 'hotel',
                'benefits' => 'Exclusive luxury suites, complimentary services.',
                'restrictions' => 'No restrictions.',
            ],
            [
                'code' => 'holiday',
                'domain' => 'airline',
                'benefits' => 'Discounted fares for holiday destinations.',
                'restrictions' => 'Seasonal offers only.',
            ],
            [
                'code' => 'holiday',
                'domain' => 'hotel',
                'benefits' => 'Discounted holiday packages, resort access.',
                'restrictions' => 'Restricted to specific locations.',
            ],
            [
                'code' => 'senior',
                'domain' => 'airline',
                'benefits' => 'Special fares for seniors.',
                'restrictions' => 'Valid for travelers above 60.',
            ],
            [
                'code' => 'honeymoon',
                'domain' => 'hotel',
                'benefits' => 'Romantic suites, complimentary gifts.',
                'restrictions' => 'Valid only for newlyweds.',
            ],
            [
                'code' => 'weekend',
                'domain' => 'hotel',
                'benefits' => 'Discounted weekend stays.',
                'restrictions' => 'Valid only on weekends.',
            ],
        ];

        foreach ($subscriptionData as $planData) {
            $plan = new SubscriptionPlan();
            $plan
            ->setCode($planData['code'])
            ->setDomain($planData['domain'])
            ->setBenefits($planData['benefits'])
            ->setRestrictions($planData['restrictions']);
            $manager->persist($plan);
        }

        $manager->flush();
    }
}
