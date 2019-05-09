<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Task;

class TaskType extends AbstractType {

    /**
     * Define campos do formulário
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Digite o título'],
                'label' => "Título",
                //'required' => false
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Digite o título'],
                'label' => "Email",
                'mapped' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Digite a descrição'],
                'label' => 'Descrição'
            ])
            ->add('Criar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-default']
            ]);
    }

    /**
     * Define configurações do formulário
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class
        ]);
    }

}