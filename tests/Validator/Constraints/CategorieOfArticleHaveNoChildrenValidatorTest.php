<?php

namespace App\Validator\Constraints;

use App\Entity\Article;
use App\Entity\Categorie;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieOfArticleHaveNoChildrenValidatorTest extends KernelTestCase
{

    /**
     * Configure a CategorieOfArticleHaveNoChildrenValidato.
     *
     * @param string $expectedMessage The expected message on a validation violation, if any.
     *
     * @return CategorieOfArticleHaveNoChildrenValidator
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
        $validator = new CategorieOfArticleHaveNoChildrenValidator();
        $validator->initialize ( $context );
        // return the ParentCategorieIsEmptyValidator
        return $validator;
    }

    public function testWithChildren()
    {

        $constraint = new CategorieOfArticleHaveNoChildren();
        $validator = $this->configureValidator ( $constraint->message );


        $parentCategory = new Categorie();
        $parentCategory->setName ( "testWithChildren-parent" );

        $category = new Categorie();
        $category->setName ( "testWithChildren-enfant" );
        $parentCategory->addChildren ($category);

        $article = new Article();
        $article->addCategory ( $parentCategory );



        $validator->validate ( $article, $constraint );


    }

    public function testWithoutChildren()
    {

        $constraint = new CategorieOfArticleHaveNoChildren();
        $validator = $this->configureValidator ();


        $parentCategory = new Categorie();
        $parentCategory->setName ( "testWithoutChildren-parent2" );

        $category = new Categorie();
        $category->setName ( "testWithoutChildren-enfant2" );
        $category->setParent ( $parentCategory );

        $article = new Article();
        $article->addCategory ( $category );


        $validator->validate ( $article, $constraint );

    }

}
