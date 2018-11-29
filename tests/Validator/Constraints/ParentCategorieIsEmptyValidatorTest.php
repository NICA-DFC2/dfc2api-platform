<?php
namespace App\Validator\Constraints;
use App\Entity\Article;
use App\Entity\Categorie;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ParentCategorieIsEmptyValidatorTest extends KernelTestCase
{

    /**
     * Configure a ParentCategorieIsEmptyValidator.
     *
     * @param string $expectedMessage The expected message on a validation violation, if any.
     *
     * @return ParentCategorieIsEmptyValidator
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
        $validator = new ParentCategorieIsEmptyValidator();
        $validator->initialize($context);
        // return the ParentArticleCategorieIsEmptyValidator
        return $validator;
    }

    public function testWithNotEmptyArticleCategorie(){

        $constraint = new ParentCategorieIsEmpty();
        $validator = $this->configureValidator($constraint->message);


        $parentCategorie = new Categorie();
        $parentCategorie->setName("parent");

        $articleInParent = new Article();
        $articleInParent->addCategorie($parentCategorie);

        $category = new Categorie();
        $category->setParent($parentCategorie);


        $validator->validate($category, $constraint);


    }

    public function testWithEmptyCategorie(){

        $constraint = new ParentCategorieIsEmpty();
        $validator = $this->configureValidator();


        $parentCategorie = new Categorie();
        $parentCategorie->setName("parent");

        $category = new Categorie();
        $category->setParent($parentCategorie);


        $validator->validate($category, $constraint);

    }

}
