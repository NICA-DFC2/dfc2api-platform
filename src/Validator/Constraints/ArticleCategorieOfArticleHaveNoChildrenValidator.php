<?php
namespace App\Validator\Constraints;
use App\Entity\Article;
use App\Entity\ArticleCategorie;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ArticleCategorieOfArticleHaveNoChildrenValidator extends ConstraintValidator
{
    /**
     * @param Article $article
     * @param Constraint $constraint
     */
    public function validate($article, Constraint $constraint)
    {
        $articleCategories = $article->getArticleCategories();

        /**
         * @var ArticleCategorie $articleCategory
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
