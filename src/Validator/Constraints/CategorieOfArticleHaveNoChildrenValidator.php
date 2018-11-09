<?php
namespace App\Validator\Constraints;
use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CategorieOfArticleHaveNoChildrenValidator extends ConstraintValidator
{
    /**
     * @param Article $article
     * @param Constraint $constraint
     */
    public function validate($article, Constraint $constraint)
    {
        $articleCategories = $article->getCategories();

        /**
         * @var Categorie $articleCategory
         */
        foreach ($articleCategories as $articleCategory){
            $children = $articleCategory->getChildren();
            foreach ($children as $child){
                if ($child) {
                    $this->context->buildViolation($constraint->message)
                        ->addViolation();
                }
            }




        }



    }
}
