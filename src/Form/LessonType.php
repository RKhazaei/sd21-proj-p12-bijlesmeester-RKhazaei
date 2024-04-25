<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('time', null, [
                'widget' => 'single_text'
            ])
            ->add('location')
            ->add('subject')
            ->add('objective')
            ->add('comments')
            ->add('duration')
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('student', EntityType::class, [
                'class' => User::class,
'choice_label' => 'firstname',
            ])
            ->add('teacher', EntityType::class, [
                'class' => User::class,
'choice_label' => 'firstname',
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
