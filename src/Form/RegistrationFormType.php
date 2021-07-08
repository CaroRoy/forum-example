<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'required'=> false,
                'label' => 'Veuillez notifier votre email',
                'attr' => [
                    'placeholder' => 'Tapez l\'email ici...'
                ]
            ])
            ->add('pseudo',TextType::class,[
                'required'=> false,
                'label' => 'Veuillez choisir un pseudo',
                'attr' => [
                    'placeholder' => 'Tapez le pseudo ici...'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Veuillez accepter les CGU',
                'mapped' => false,
                'required'=> false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les CGU.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Veuillez choisir un mot de passe',
                'mapped' => false,
                'required'=> false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
