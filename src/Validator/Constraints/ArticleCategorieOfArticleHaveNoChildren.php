<?php
namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ArticleCategorieOfArticleHaveNoChildren extends Constraint
{
    public $message = 'Cette categorie n\'est pas une categorie de dernier niveau';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
