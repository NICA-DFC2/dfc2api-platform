<?php
namespace App\Validator\Constraints;
use App\Entity\ArticleCategorie;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ParentArticleCategorieIsEmptyValidator extends ConstraintValidator
{
    /**
     * @param ArticleCategorie $articleCategorie
     * @param Constraint $constraint
     */
    public function validate($articleCategorie, Constraint $constraint)
    {
        //var_dump($articleCategorie->getParent()->getArticles()[0]);
        /**
         * On verifie que la catégorie n'a pas d'articles
         * @var ArticleCategorie $articleCategorie
         */
        if ($articleCategorie->getParent()->getArticles()[0]) {
            $this->context->buildViolation($constraint->message)
                    ->addViolation();
        }

    }




}

