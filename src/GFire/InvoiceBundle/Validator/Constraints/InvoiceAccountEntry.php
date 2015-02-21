<?php

namespace GFire\InvoiceBundle\Validator\Constraints;

use GFire\InvoiceBUndle\Validator\Constraints\InvoiceAccountEntryValidator;
use Symfony\Component\Validator\Constraint;

class InvoiceAccountEntry extends Constraint
{
    public $message = '';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}