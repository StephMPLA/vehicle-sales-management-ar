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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('year')
            ->add('horsePower')
            ->add('weight')

            ->add('description', TextareaType::class)

            ->add('price')
            ->add('mileage')

            ->add('isNew', CheckboxType::class, [
                'required' => false,
            ])

            ->add('model3dPath')

            // ✅ Relations direct Entity

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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class, // ✅ IMPORTANT
        ]);
    }
}
