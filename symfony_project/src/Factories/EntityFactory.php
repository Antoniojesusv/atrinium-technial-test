<?php

namespace App\Factories;

use App\Entity\Company;
use App\Entity\Sector;

class EntityFactory implements FactoryInterface
{
    public function __construct(string $message = '')
    {
        $this->instancesArray = $this->loadInstancesArray();
    }

    private function loadInstancesArray(): array
    {
        return ['company' => new Company(),
                'sector' => new Sector()];
    }

    public function getInstance(string $instanceName): object
    {
        return $this->instancesArray[$instanceName];
    }
}
