<?php

namespace GFire\InvoiceBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InvoiceAccountEntryValidator extends ConstraintValidator
{
    public function validate($invoice_account_entry, Constraint $constraint)
    {
        if ($invoice_account_entry->getDebit() == "" && $invoice_account_entry->getCredit() == "" ) {
            $this->context->buildViolation("Either Debit Or Credit is required.")
                ->atPath('debit')
                ->addViolation();
            $this->context->buildViolation("Either Debit Or Credit is required.")
                ->atPath('credit')
                ->addViolation();
        }
    }
}