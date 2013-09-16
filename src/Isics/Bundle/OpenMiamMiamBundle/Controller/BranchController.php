<?php

/*
 * This file is part of the OpenMiamMiam project.
 *
 * (c) Isics <contact@isics.fr>
 *
 * This source file is subject to the AGPL v3 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Isics\Bundle\OpenMiamMiamBundle\Controller;

use Isics\Bundle\OpenMiamMiamBundle\Entity\Branch;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BranchController extends Controller
{
    /**
     * Shows Branch header
     *
     * @param Branch $branch
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showHeaderAction(Branch $branch)
    {
        return $this->render('IsicsOpenMiamMiamBundle:Branch:showHeader.html.twig', array(
            'branch' => $branch,
        ));
    }

    /**
     * Shows branch homepage
     *
     * @ParamConverter("branch", class="IsicsOpenMiamMiamBundle:Branch", options={"mapping": {"branch_slug": "slug"}})
     *
     * @param Branch $branch
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showHomepageAction(Branch $branch)
    {
        return $this->render('IsicsOpenMiamMiamBundle:Branch:showHomepage.html.twig', array(
            'branch' => $branch,
        ));
    }

    /**
     * Shows next occurrences
     *
     * @param Branch  $branch
     * @param integer $limit
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showNextOccurrencesAction(Branch $branch, $limit = 5)
    {
        $branchOccurrences = $this->getDoctrine()->getRepository('IsicsOpenMiamMiamBundle:BranchOccurrence')
            ->findAllNextForBranch($branch, false, $limit);

        return $this->render('IsicsOpenMiamMiamBundle:Branch:showNextOccurrences.html.twig', array(
            'branchOccurrences' => $branchOccurrences,
        ));
    }

    /**
     * Shows random producers
     *
     * @param Branch  $branch
     * @param integer $limit
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showRandomProducersAction(Branch $branch, $limit = 5)
    {
        $producers = $this->getDoctrine()->getRepository('IsicsOpenMiamMiamBundle:Producer')
            ->findAllRandomForBranch($branch, $limit);

        return $this->render('IsicsOpenMiamMiamBundle:Branch:showRandomProducers.html.twig', array(
            'producers' => $producers,
        ));
    }
}