<?php

namespace App\Form;

use App\Entity\Vehicle;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Fuel;
use App\Entity\VehicleStatus;
use App\Entity\VehicleTransmission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints as Assert;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Vehicle name'
            ])

            ->add('year', IntegerType::class, [
                'label' => 'Year',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Range(notInRangeMessage: 'Enter a valid vehicle year.', min: 1886, max: (int)date('Y') + 1)
                ]
            ])

            ->add('horsePower', IntegerType::class, [
                'label' => 'Horse power (HP)',
                'constraints' => [
                    new Assert\Positive(message: 'Horse power must be positive.')
                ]
            ])

            ->add('weight', IntegerType::class, [
                'label' => 'Weight (kg)',
                'constraints' => [
                    new Assert\Positive(message: 'Weight must be positive.')
                ]
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'constraints' => [
                    new Assert\Length(max: 2000, maxMessage: 'Description too long.')
                ]
            ])

            ->add('price', IntegerType::class, [
                'label' => 'Price (€)',
                'constraints' => [
                    new Assert\PositiveOrZero(message: 'Price cannot be negative.')
                ],
            ])

            ->add('mileage', IntegerType::class, [
                'label' => 'Mileage (km)',
                'constraints' => [
                    new Assert\PositiveOrZero(message: 'Mileage cannot be negative.')
                ],
            ])
            ->add('isNew', CheckboxType::class, [
                'required' => false,
            ])

            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a brand',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a category',
            ])
            ->add('fuel', EntityType::class, [
                'class' => Fuel::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a fuel',
            ])
            ->add('transmission', EntityType::class, [
                'class' => VehicleTransmission::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a transmission',
            ])
            ->add('status', EntityType::class, [
                'class' => VehicleStatus::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a status',
            ])
            ->add('model3dFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => '3D Model (.glb)',
                'constraints' => [
                    new File(maxSize: '50M', mimeTypes: ['model/gltf-binary', 'application/octet-stream'], extensions: ['glb'])
                ]
            ]);
//            ->add('model3dFile', FileType::class, [
//                'mapped' => false,
//                'required' => false,
//            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
