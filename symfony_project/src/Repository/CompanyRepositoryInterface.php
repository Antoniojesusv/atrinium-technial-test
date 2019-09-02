<?php

namespace App\Repository;

use App\Entity\Company;

interface CompanyRepositoryInterface
{
    public function get(): array;
    public function findById(string $id): ?Company;
    public function findByName(string $name): ?Company;
    public function save(Company $company): void;
    public function update(Company $company): void;
    public function remove(Company $company): void;
}
