<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class TaskType extends AbstractType
{

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
                'attr' => ['placeholder' => 'Digite o título'],
                'label' => "Título",
                //'required' => false
            ])
            ->add('scheduling', DateTimeType::class, [
                'widget' => 'single_text',
                'label'  => 'Agendamento',
                'attr'   => []
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['placeholder' => 'Digite a descrição'],
                'label' => 'Descrição'
            ])
            ->add('attachment', FileType::class, [
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize'   => '2M',
                        "mimeTypes" => 'application/pdf'
                    ])
                ]
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
            'data_class' => Task::class,
            //'method'     => 'GET',
            'required'   => false
        ]);
    }
}
