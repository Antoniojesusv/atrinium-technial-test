<?php

namespace App\Repository;

use App\Entity\Sector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sector|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sector|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sector[]    findAll()
 * @method Sector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SectorRepository extends ServiceEntityRepository implements SectorRepositoryInterface
{
    public function __construct(ManagerRegistry $em)
    {
        parent::__construct($em, Sector::class);

        $this->managerRegistry = $em;
    }

    public function get(): array
    {
        return $this->findAll();
    }

    public function findById(string $id): ?Sector
    {
        return $this->find($id);
    }

    public function findByName(string $name): ?Sector
    {
        return $this->findOneBy([
            'name' => $name
        ]);
    }

    public function save(Sector $sector): void
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($sector));
        $entityManager->persist($sector);
        $entityManager->flush();
    }

    public function update(Sector $sector): void
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($sector));
        $entityManager->flush();
    }

    public function remove(Sector $sector): void
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($sector));
        $entityManager->remove($sector);
        $entityManager->flush();
    }
}
