<?php

namespace GFire\InvoiceBundle\Validator\Constraints;

use GFire\InvoiceBUndle\Validator\Constraints\InvoiceAccountEntryTotalValidator;
use Symfony\Component\Validator\Constraint;

class InvoiceAccountEntryTotal extends Constraint
{
    public $message = '';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}