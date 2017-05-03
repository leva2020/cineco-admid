<?php

namespace PqrsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class FiltroPqrsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('id', 'text', array(
            'label' => 'Id Pqrs',
            'required' => false
        ));
        $builder->add('documento_usuario', 'text', array(
            'label' => 'Documento',
            'required' => false            
        ));
        $builder->add('correo', null, array(
            'label' => 'Correo',
            'required' => false,
            'attr' => array('class' => 'input-small')
        ));
        $builder->add('estado', 'choice', array(
            'choices' => array(1 => 'Iniciado', 2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado'),
            'label' => 'Estado',
            'required' => false,
            //'preferred_choices' => array(0),
            'attr' => array('class' => 'input-small')
        ));

        
        $builder->add('save', 'submit', array(
            'label' => 'Enviar',
            'attr' => array('class' => 'btn btn-primary')
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'PqrsBundle\Entity\Pqrs',
        ));
    }

    public function getName() {
        return 'filtro_pqrs_type';
    }

}
