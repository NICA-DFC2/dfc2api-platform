<?php
namespace App\Validator\Constraints;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CategoryOfArticleHaveNoChildrenValidator extends ConstraintValidator
{
    /**
     * @param Article $article
     * @param Constraint $constraint
     */
    public function validate($article, Constraint $constraint)
    {
        $categories = $article->getArticleCategories();

        /**
         * @var Category $articleCategory
         */
        foreach ($categories as $Category){
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
