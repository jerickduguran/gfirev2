<?php

namespace GFire\InvoiceBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InvoiceAccountEntryTotalValidator extends ConstraintValidator
{
    public function validate($invoice, Constraint $constraint)
    {
        $totals = $invoice->getTotalAccountDebitCredit();

        if ($totals['debit'] != $totals['credit'] ) {
            $this->context->buildViolation("Account Entries is not Balance.")
                ->atPath('totalAccountEntry')
                ->addViolation();
        }
    }
}