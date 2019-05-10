<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

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
            ->add('escolha', ChoiceType::class, [
                'choices' => [
                    'descrição1' => 'chave1',
                    'descrição2' => 'chave2',
                    'descrição3' => 'chave3',
                    'descrição4' => 'chave4',
                ],
                'attr'          => ['class' => 'form-control'],
                'placeholder'   => 'Selecione uma Opção',
                'multiple'      => true,
                'mapped' => false
            ])
            ->add('scheduling', DateTimeType::class, [
                'widget' => 'single_text',
                'label'  => 'Agendamento',
                'attr'   => ['class' => 'form-control']
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