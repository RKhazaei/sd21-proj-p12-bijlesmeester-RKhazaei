<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
//            ->add('roles')
            ->add('password',PasswordType::class)
            ->add('firstname',TextType::class)
            ->add('lastname',TextType::class)
            ->add('adress',TextType::class)
            ->add('zipcode',TextType::class)
            ->add('city', TextType::class)
            ->add('level',ChoiceType::class,[
                'choices' => [
                    'havo'=> '1',
                    'mavo' => '2'
                ]
            ])
            ->add('date_of_birth', null, [
                'widget' => 'single_text',
            ])
//            ->add('iban')
//            ->add('subject')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
