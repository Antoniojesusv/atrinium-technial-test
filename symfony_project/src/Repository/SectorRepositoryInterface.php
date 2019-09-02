<?php

namespace App\Repository;

use App\Entity\Sector;

interface SectorRepositoryInterface
{
    public function get(): array;
    public function findById(string $id): ?Sector;
    public function findByName(string $name): ?Sector;
    public function save(Sector $company): void;
    public function update(Sector $company): void;
    public function remove(Sector $company): void;
}
