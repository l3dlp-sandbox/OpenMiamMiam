<?php

/*
 * This file is part of the OpenMiamMiam project.
 *
 * (c) Isics <contact@isics.fr>
 *
 * This source file is subject to the AGPL v3 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Isics\Bundle\OpenMiamMiamBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Product extends Constraint
{
    public $requiredMessage = 'This value should not be null.';

    public $invalidBranchesMessage = 'At least one branch is invalid.';

    public $invalidCategoryMessage = 'The category must be a final node.';

    /**
     * {@inheritDoc}
     *
     * @return array|string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function validatedBy()
    {
        return 'open_miam_miam.product_validator';
    }
}
