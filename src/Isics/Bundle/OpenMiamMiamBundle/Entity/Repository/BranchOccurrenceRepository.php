<?php

/*
 * This file is part of the OpenMiamMiam project.
 *
 * (c) Isics <contact@isics.fr>
 *
 * This source file is subject to the AGPL v3 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Isics\Bundle\OpenMiamMiamBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Isics\Bundle\OpenMiamMiamBundle\Entity\Branch;

class BranchOccurrenceRepository extends EntityRepository
{
    /**
     * Finds next occurrennce for a branch
     *
     * @param Branch  $branch Branch
     * @param boolean $open   Open
     *
     * @return BranchOccurrence|null
     */
    public function findOneNextForBranch(Branch $branch, $open = true)
    {
        $date = new \DateTime();

        if ($open) {
            $date->add(new \DateInterval(
                sprintf('PT%sS', $branch->getAssociation()->getClosingDelay())
            ));
        }

        return $this->createQueryBuilder('bo')
            ->where('bo.branch = :branch')
            ->andWhere('bo.begin >= :date')
            ->orderBy('bo.begin')
            ->setMaxResults(1)
            ->setParameter('branch', $branch)
            ->setParameter('date', $date)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Finds next occurrences for a branch
     *
     * @param Branch  $branch Branch
     * @param boolean $open   Open
     * @param integer $limit  Limit
     *
     * @return array
     */
    public function findAllNextForBranch(Branch $branch, $open = true, $limit = 5)
    {
        $date = new \DateTime();

        if ($open) {
            $date->add(new \DateInterval(
                sprintf('PT%sS', $branch->getAssociation()->getClosingDelay())
            ));
        }

        return $this->createQueryBuilder('bo')
            ->where('bo.branch = :branch')
            ->andWhere('bo.begin >= :date')
            ->orderBy('bo.begin')
            ->setMaxResults($limit)
            ->setParameter('branch', $branch)
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds in progress for a branch (if exists)
     *
     * @param Branch $branch Branch
     *
     * @return BranchOccurrence|null
     */
    public function findOneInProgressForBranch(Branch $branch)
    {
        $date1 = new \DateTime();
        $date1->add(new \DateInterval(
            sprintf('PT%sS', $branch->getAssociation()->getClosingDelay())
        ));

        $date2 = new \DateTime();
        $date2->sub(new \DateInterval(
            sprintf('PT%sS', $branch->getAssociation()->getOpeningDelay())
        ));

        return $this->createQueryBuilder('bo')
            ->where('bo.branch = :branch')
            ->andWhere('bo.begin < :date1')
            ->andWhere('bo.end >= :date2')
            ->orderBy('bo.begin')
            ->setMaxResults(1)
            ->setParameter('branch', $branch)
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2)
            ->getQuery()
            ->getOneOrNullResult();
    }
}