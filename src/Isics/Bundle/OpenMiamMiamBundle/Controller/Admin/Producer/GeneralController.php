<?php

/*
 * This file is part of the OpenMiamMiam project.
 *
 * (c) Isics <contact@isics.fr>
 *
 * This source file is subject to the AGPL v3 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Isics\Bundle\OpenMiamMiamBundle\Controller\Admin\Producer;

use Isics\Bundle\OpenMiamMiamBundle\Controller\Admin\Producer\BaseController;
use Isics\Bundle\OpenMiamMiamBundle\Entity\Producer;

class GeneralController extends BaseController
{
    /**
     * Show Dashboard
     *
     * @param Producer $producer
     *
     * @return Response
     */
    public function showDashboardAction(Producer $producer)
    {
        $this->secure($producer);

        return $this->render('IsicsOpenMiamMiamBundle:Admin\Producer:showDashboard.html.twig', array(
            'producer' => $producer,
        ));
    }
}