<?php
namespace App\Form;

use App\Entity\VehicleImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Image file'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Front view' => 'Front view',
                    'Rear view' => 'Rear view',
                    'Interior' => 'Interior',
                    'Engine' => 'Engine',
                    'Trunk' => 'Trunk',
                    'Detail' => 'Detail',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehicleImage::class,
        ]);
    }
}
