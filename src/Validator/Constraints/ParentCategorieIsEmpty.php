<?php
namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ParentCategorieIsEmpty extends Constraint
{
    public $message = 'La catégorie parente n\'est pas vide';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
