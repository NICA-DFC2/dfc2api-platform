<?php

namespace App\Validator\Constraints;

use App\Entity\Article;
use App\Entity\ArticleCategorie;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleCategorieOfArticleHaveNoChildrenValidatorTest extends KernelTestCase
{

    /**
     * Configure a ArticleCategorieOfArticleHaveNoChildrenValidato.
     *
     * @param string $expectedMessage The expected message on a validation violation, if any.
     *
     * @return ArticleCategorieOfArticleHaveNoChildrenValidator
     */
    public function configureValidator($expectedMessage = null)
    {
        // mock the violation builder
        $builder = $this->getMockBuilder ( 'Symfony\Component\Validator\Violation\ConstraintViolationBuilder' )
            ->disableOriginalConstructor ()
            ->setMethods ( ['addViolation'] )
            ->getMock ();
        // mock the validator context
        $context = $this->getMockBuilder ( 'Symfony\Component\Validator\Context\ExecutionContext' )
            ->disableOriginalConstructor ()
            ->setMethods ( ['buildViolation'] )
            ->getMock ();
        if ($expectedMessage) {
            $builder->expects ( $this->once () )
                ->method ( 'addViolation' );
            $context->expects ( $this->once () )
                ->method ( 'buildViolation' )
                ->with ( $this->equalTo ( $expectedMessage ) )
                ->will ( $this->returnValue ( $builder ) );
        } else {
            $context->expects ( $this->never () )
                ->method ( 'buildViolation' );
        }
        // initialize the validator with the mocked context
        $validator = new ArticleCategorieOfArticleHaveNoChildrenValidator();
        $validator->initialize ( $context );
        // return the ParentArticleCategorieIsEmptyValidator
        return $validator;
    }

    public function testWithChildren()
    {

        $constraint = new ArticleCategorieOfArticleHaveNoChildren();
        $validator = $this->configureValidator ( $constraint->message );


        $parentCategory = new ArticleCategorie();
        $parentCategory->setName ( "testWithChildren-parent" );

        $category = new ArticleCategorie();
        $category->setName ( "testWithChildren-enfant" );
        $parentCategory->addChildren ($category);

        $article = new Article();
        $article->addArticleCategory ( $parentCategory );



        $validator->validate ( $article, $constraint );


    }

    public function testWithoutChildren()
    {

        $constraint = new ArticleCategorieOfArticleHaveNoChildren();
        $validator = $this->configureValidator ();


        $parentCategory = new ArticleCategorie();
        $parentCategory->setName ( "testWithoutChildren-parent2" );

        $category = new ArticleCategorie();
        $category->setName ( "testWithoutChildren-enfant2" );
        $category->setParent ( $parentCategory );

        $article = new Article();
        $article->addArticleCategory ( $category );


        $validator->validate ( $article, $constraint );

    }

}
