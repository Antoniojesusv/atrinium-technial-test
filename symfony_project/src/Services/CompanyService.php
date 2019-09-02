<?php

namespace App\Services;

use App\Entity\Company;
use App\Repository\CompanyRepositoryInterface;
use App\Factories\FactoryInterface;
use App\Factories\EntityFactory;
use App\Exceptions\CompanyException;

class CompanyService
{
    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        FactoryInterface $entityFactory
    ) {
        $this->companyRepository = $companyRepository;
        $this->entityFactory = $entityFactory;
    }

    public function get(): array
    {
        return $this->companyRepository->get();
    }

    public function save(string $name)
    {
        $company = $this->findByName($name);

        if ($company) {
            $name = $company->getName();
            throw new CompanyException('The entity ' . $name . ' already exists');
        }

        $company = $this->entityFactory->getInstance('company');
        $this->companyRepository->save($company);
    }

    public function update(Company $company): void
    {
        $id = $company->getId();
        $companyCollection = $this->getCurrentCompany($id);

        if (empty($companyCollection)) {
            throw new CompanyException('The entity ' . $id . ' does not exist');
        }

        $this->companyRepository->update($company);
    }

    public function remove(Company $company): void
    {
        $id = $company->getId();
        $companyCollection = $this->getCurrentCompany($id);

        if (empty($companyCollection)) {
            throw new CompanyException('The entity ' . $id . ' does not exist');
        }

        $this->companyRepository->remove($company);
    }

    private function getCurrentCompany(string $id): ?Company
    {
        return $this->findById($id);
    }

    private function findById(string $id): ?Company
    {
        return $this->companyRepository->findById($id);
    }

    private function findByName(string $name): ?Company
    {
        return $this->companyRepository->findByName($name);
    }
}
