<?php

namespace App\Form;

use App\Entity\BookCopy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * Class BookCopyType
 * @package App\Form
 */
class BookCopyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('count', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => BookCopy::MAX_COUNT
                ]
            ])
            ->add('book', BookType::class)
            ->add('imagePath', FileType::class,[
//                'mapped' => false,
//                'data_class' => null,
//                'data_class' => 'Symfony\Component\HttpFoundation\File\File',
                'property_path' => 'imagePath',
                'required' => false,
                'empty_data' => '/image/camera_200.png'
            ])
            ->add('filePath', FileType::class, array('data_class' => null))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BookCopy::class,
        ));
    }
}