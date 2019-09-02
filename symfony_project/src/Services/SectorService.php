<?php

namespace App\Services;

use App\Entity\Sector;
use App\Repository\SectorRepositoryInterface;
use App\Factories\FactoryInterface;
use App\Factories\EntityFactory;
use App\Exceptions\SectorException;

class SectorService
{
    public function __construct(
        SectorRepositoryInterface $sectorRepository,
        FactoryInterface $entityFactory
    ) {
        $this->sectorRepository = $sectorRepository;
        $this->entityFactory = $entityFactory;
    }

    public function get(): array
    {
        return $this->sectorRepository->get();
    }

    public function save(string $name)
    {
        $sector = $this->findByName($name);

        if ($sector) {
            $name = $sector->getName();
            throw new SectorException('The entity ' . $name . ' already exists');
        }

        $sector = $this->entityFactory->getInstance('sector');
        $this->sectorRepository->save($sector);
    }

    public function update(Sector $sector): void
    {
        $id = $sector->getId();
        $sectorCollection = $this->getCurrentSector($id);

        if (empty($sectorCollection)) {
            throw new SectorException('The entity ' . $id . ' does not exist');
        }

        $this->sectorRepository->update($sector);
    }

    public function remove(Sector $sector): void
    {
        $id = $sector->getId();
        $sectorCollection = $this->getCurrentsector($id);

        if (empty($sectorCollection)) {
            throw new SectorException('The entity ' . $id . ' does not exist');
        }

        $this->sectorRepository->remove($sector);
    }

    private function getCurrentSector(string $id): ?Sector
    {
        return $this->findById($id);
    }

    private function findById(string $id): ?Sector
    {
        return $this->sectorRepository->findById($id);
    }

    private function findByName(string $name): ?Sector
    {
        return $this->sectorRepository->findByName($name);
    }
}
