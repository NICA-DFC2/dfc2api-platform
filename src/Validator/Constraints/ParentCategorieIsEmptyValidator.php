<?php
namespace App\Validator\Constraints;
use App\Entity\Categorie;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ParentCategorieIsEmptyValidator extends ConstraintValidator
{
    /**
     * @param Categorie $categorie
     * @param Constraint $constraint
     */
    public function validate($categorie, Constraint $constraint)
    {
        //var_dump($categorie->getParent()->getArticles()[0]);
        /**
         * On verifie que la catégorie n'a pas d'articles
         * @var Categorie $categorie
         */
        if ($categorie->getParent()->getArticles()[0]) {
            $this->context->buildViolation($constraint->message)
                    ->addViolation();
        }

    }




}

