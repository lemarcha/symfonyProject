<?php

namespace App\Form;

use App\Entity\WordFour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class WordFourFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Mot à deviner',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Il va faloir donner un mot sinon y a pas de devinette !',
                    ]),
                    new Length([
                        'max' => 40,
                        'maxMessage' => 'Le mot ne peut pas dépasser {{ limit }} characters',
                    ]),
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Devinner ?',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WordFour::class,
        ]);
    }
}
