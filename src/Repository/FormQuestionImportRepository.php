<?php

namespace App\Repository;

use App\Entity\FormImport;
use App\Entity\FormQuestionImport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @method FormQuestionImport|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormQuestionImport|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormQuestionImport[]    findAll()
 * @method FormQuestionImport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormQuestionImportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormQuestionImport::class);
    }

    public function insertFormQuestions($data,$shopId)
    {
        $em = $this->getEntityManager();
        $time = new \DateTimeImmutable();
        foreach ($data as $d)
        {
            $formQuestion = new FormQuestionImport();
            $formQuestion->setQuestionId($d['question_id']);
            $formQuestion->setQuestionLabel($d['question_label']);
            $formQuestion->setParentId($d['parent_id']);
            $formQuestion->setIsRequired($d['is_required']);
            $formQuestion->setStatus($d['status']);
            $formQuestion->setQuestionType($d['question_type']);
            $formQuestion->setIsConditionalQuestion($d['is_conditional_question']);
            $formQuestion->setAccountId($shopId);
            $formQuestion->setDownloadedAt($time);
            ( !empty($d['min_range'])) ? $formQuestion->setMinRange($d['min_range']):"";
            ( !empty($d['max_range'])) ? $formQuestion->setMaxRange($d['max_range']):"";

            $em->persist($formQuestion);
        }

        $em->flush();
        $em->clear();


    }

}
