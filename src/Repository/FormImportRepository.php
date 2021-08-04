<?php

namespace App\Repository;

use App\Entity\FormImport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormImport|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormImport|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormImport[]    findAll()
 * @method FormImport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormImportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormImport::class);
    }
    public function insertForms($data,$shopId)
    {
        $em = $this->getEntityManager();
      $time = new \DateTimeImmutable();
        foreach ($data as $d)
        {
            $form = new FormImport();
            $form->setName($d['name']);
            $form->setType($d['type']);
            $form->setFormId($d['form_id']);
            $form->setAccountId($shopId);
            $form->setCompletionRate($d['completion_rate']);
            $form->setOpenRate($d['open_rate']);
            $form->setDownloadedAt($time);
            $form->setIsDefault($d['is_default']);
            $form->setIsDefaultFormOfDefaultSurvey($d['is_default_form_of_default_survey']);
            $em->persist($form);
        }

        $em->flush();
        $em->clear();


    }

}
