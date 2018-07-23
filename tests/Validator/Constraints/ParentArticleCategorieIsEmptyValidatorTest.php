<?php
namespace App\Validator\Constraints;
use App\Entity\Article;
use App\Entity\ArticleCategorie;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ParentArticleCategorieIsEmptyValidatorTest extends KernelTestCase
{

    /**
     * Configure a ParentArticleCategorieIsEmptyValidator.
     *
     * @param string $expectedMessage The expected message on a validation violation, if any.
     *
     * @return ParentArticleCategorieIsEmptyValidator
     */
    public function configureValidator($expectedMessage = null)
    {
        // mock the violation builder
        $builder = $this->getMockBuilder('Symfony\Component\Validator\Violation\ConstraintViolationBuilder')
            ->disableOriginalConstructor()
            ->setMethods(['addViolation'])
            ->getMock();
        // mock the validator context
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation'])
            ->getMock();
        if ($expectedMessage) {
            $builder->expects($this->once())
                ->method('addViolation');
            $context->expects($this->once())
                ->method('buildViolation')
                ->with($this->equalTo($expectedMessage))
                ->will($this->returnValue($builder));
        } else {
            $context->expects($this->never())
                ->method('buildViolation');
        }
        // initialize the validator with the mocked context
        $validator = new ParentArticleCategorieIsEmptyValidator();
        $validator->initialize($context);
        // return the ParentArticleCategorieIsEmptyValidator
        return $validator;
    }

    public function testWithNotEmptyArticleCategorie(){

        $constraint = new ParentArticleCategorieIsEmpty();
        $validator = $this->configureValidator($constraint->message);


        $parentCategory = new ArticleCategorie();
        $parentCategory->setName("parent");

        $articleInParent = new Article();
        $articleInParent->addArticleCategory($parentCategory);

        $category = new ArticleCategorie();
        $category->setParent($parentCategory);


        $validator->validate($category, $constraint);


    }

    public function testWithEmptyArticleCategorie(){

        $constraint = new ParentArticleCategorieIsEmpty();
        $validator = $this->configureValidator();


        $parentCategory = new ArticleCategorie();
        $parentCategory->setName("parent");

        $category = new ArticleCategorie();
        $category->setParent($parentCategory);


        $validator->validate($category, $constraint);

    }

}
