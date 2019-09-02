<?php

namespace App\Factories;

interface FactoryInterface
{
    public function getInstance(string $instanceName): object;
}
