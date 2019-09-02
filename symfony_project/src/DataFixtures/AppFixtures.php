<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Sector;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sectorIntances = [];
        $sectorCollection = $this->loadSectors();
        $companyCollection = $this->loadCompanies();

        foreach ($sectorCollection as $sector) {
            $sectorEntity = new Sector();
            $sectorEntity->setName($sector['name']);
            $manager->persist($sectorEntity);
            $sectorIntances[] = $sectorEntity;
        }

        foreach ($companyCollection as $key => $company) {
            $companyEntity = new Company();
            $companyEntity->setName($company['name']);
            $companyEntity->setPhone($company['phone']);
            $companyEntity->setEmail($company['email']);
            
            ($key <= 7)
            ? $companyEntity->setSector($sectorIntances[0])
            : $companyEntity->setSector($sectorIntances[1]);

            $manager->persist($companyEntity);
        }


        $manager->flush();
    }

    private function loadSectors()
    {
        return [
            ['name' => 'IT'],
            ['name' => 'Marketing']
        ];
    }

    private function loadCompanies()
    {
        return [
            ['name' => 'Atrinium', 'phone' => '951204565','email' => 'info@atriniuim.com '],
            ['name' => 'OnePlus', 'phone' => '951235665','email' => 'info@oneplus.com '],
            ['name' => 'Oracle', 'phone' => '958364565','email' => 'info@oracle.com '],
            ['name' => 'VoiceWork', 'phone' => '951672139','email' => 'info@voicework.com '],
            ['name' => 'Accenture', 'phone' => '951612565','email' => 'info@acenture.com '],
            ['name' => 'Pramerica', 'phone' => '953454895','email' => 'info@pramerica.com '],
            ['name' => 'Indra', 'phone' => '951223565','email' => 'info@indra.com '],
            ['name' => 'Archer', 'phone' => '953878265','email' => 'info@archer.com '],
            ['name' => 'Deloitte', 'phone' => '951567124','email' => 'info@deloitte.com '],
            ['name' => 'RealWorld', 'phone' => '954564565','email' => 'info@realworld.com '],
            ['name' => 'Osborne', 'phone' => '954564892','email' => 'info@osborne.com '],
            ['name' => 'Glandore', 'phone' => '953124765','email' => 'info@glandore.com '],
            ['name' => 'Prosperiry', 'phone' => '957844325','email' => 'info@prosperity.com '],
            ['name' => 'Pharma', 'phone' => '955874249','email' => 'info@pharma.com '],
            ['name' => 'PeGlobal', 'phone' => '956734823','email' => 'info@peglobal.com '],
        ];
    }
}
