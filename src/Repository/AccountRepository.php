<?php

namespace App\Repository;

use App\Entity\Account;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository
{
    private $entityManger;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManager)
    {
        $this->entityManger=$entityManager;
        parent::__construct($registry, Account::class);
    }
    public function getUserObject($id)
    {
        $qb = $this->entityManger->createQueryBuilder();

        $qb->select('account')
            ->from('App:Account', 'account')
            ->where('account.id = :accountId')
            ->setParameter('accountId',$id);

        return $qb->getQuery()->getResult();
    }
    public function createNewAccount($data)
    {
        $time = new \DateTimeImmutable();
        $em=$this->getEntityManager();
        $account= new Account();
        $account->setAccountId($data->getAccountId());
        $account->setName($data->getName());
        $account->setPassword($data->getPassword());
        $account->setCreatedAt($time);
        $em->persist($account);
        $em->flush();
    }
    public function removeAccount($id)
    {
        $account=$this->getUserObject($id);
        $this->entityManger->remove($account[0]);
        $this->entityManger->flush();


    }
}
