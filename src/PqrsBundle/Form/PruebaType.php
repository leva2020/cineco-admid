<?php

namespace PqrsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use PqrsBundle\Entity\Adjunto;
use PqrsBundle\Entity\Respuesta;

class RespuestaPqrsType extends AbstractType {

    public function buildForm() {

        //$transformer = new MultipleTagsTransformer();

        $builder->add('respuesta', 'textarea', array(
            'label' => 'Respuesta'
        ));
        $builder->add('causa', 'textarea', array(
            'label' => 'Causa',
            'required' => false
        ));

        $builder->add('estado', 'choice', array(
            'choices' => array(0 => 'Seleccione un estado', 2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado'),
            'label' => 'Estado',
            'preferred_choices' => array(0),
        ));
        $builder->add('id_usuario', null, array(
            'label' => 'Usuario'
        ));

//        $builder->add('adjuntos','file',array(
//            "label" => "Adjuntos",
//            "required" => false,
//        ));

        $builder->add('adjuntos', 'entity', array('label' => 'Adjuntos',
            'required' => true,
            'expanded' => false,
            'class' => 'PqrsBundle\Entity\Adjunto',
            'property' => 'display_text',
            'multiple' => true,
            'mapped' => false
        ));

        $builder->add('cancel', 'submit', array('label' => 'Cancelar'));
        $builder->add('save', 'submit', array('label' => 'Enviar'));
    }

}
