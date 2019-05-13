<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PriorityType extends AbstractType
{
    /**
     * Define configurações do formulário
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'Baixa' => 'baixa',
                'Média' => 'media',
                'Alta'  => 'alta',
            ],
            'label'         => 'Prioridade',
            'placeholder'   => 'Selecione uma Opção',
            'multiple'      => true,
            'mapped'        => false
        ]);
    }

    /**
     * Define o tipo que campo que será herdado
     *
     * @return void
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
