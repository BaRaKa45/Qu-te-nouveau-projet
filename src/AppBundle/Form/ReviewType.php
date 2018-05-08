<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 08/05/18
 * Time: 09:35
 */

namespace AppBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextareaType::class, array('attr' => array('maxlength' => 250, 'label' => 'Description')))
            ->add('publicationDate', DateType::class, array('data' => new \DateTime('now')))
            ->add('note', IntegerType::class, array('attr' => array('min' => 0, 'max' => 5, 'label' => 'note')))
            ->add('agreeTerms', CheckboxType::class, array('mapped' => false))
            ->add('userRated', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.lastName', 'ASC');
                },
                'choice_label' => 'lastName'))
            ->add('reviewAuthor');
    }
}