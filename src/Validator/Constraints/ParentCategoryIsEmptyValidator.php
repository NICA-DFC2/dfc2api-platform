<?php
namespace App\Validator\Constraints;
use App\Entity\Category;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ParentCategoryIsEmptyValidator extends ConstraintValidator
{
    /**
     * @param Category $category
     * @param Constraint $constraint
     */
    public function validate($category, Constraint $constraint)
    {
        /**
         * On verifie que la catégorie n'a pas d'articles
         * @var Category $category
         */
        if ($category->getParent()->getArticles()[0]) {
            $this->context->buildViolation($constraint->message)
                    ->addViolation();
        }

    }




}

