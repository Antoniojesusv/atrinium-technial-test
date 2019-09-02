<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository implements CompanyRepositoryInterface
{
    private $repository;

    public function __construct(ManagerRegistry $em)
    {
        parent::__construct($em, Company::class);
      
        $this->managerRegistry = $em;
    }

    public function get(): array
    {
        return $this->findAll();
    }

    public function findById(string $id): ?Company
    {
        return $this->find($id);
    }

    public function findByName(string $name): ?Company
    {
        return $this->findOneBy([
            'name' => $name
        ]);
    }

    public function save(Company $company): void
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($company));
        $entityManager->persist($company);
        $entityManager->flush();
    }

    public function update(Company $company): void
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($company));
        $entityManager->flush();
    }

    public function remove(Company $company): void
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($company));
        $entityManager->remove($company);
        $entityManager->flush();
    }

    // /**
    //  * @return Company[] Returns an array of Company objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Company
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
