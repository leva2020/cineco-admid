<?php

namespace PqrsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EditarRespuestaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $session = new Session();
        $tokens = $session->get('tokens');
        $permisos = $tokens['permisos_nombres'];

        if(in_array('COMUNICAR', $permisos)):
            $estados = array(2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado');
        else:
            $estados = array(2 => 'Progreso', 3 => 'Solucionado');
        endif;
        
        $builder->add('respuesta', null, array(
            'label' => 'Respuesta'
        ));
        $builder->add('causa', null, array(
            'label' => 'Causa',
            'required' => false
        ));
        
        $builder->add('estado', 'choice', array(
            'choices'  => $estados,
            'label' => 'Estado',
        ));
        $builder->add('area', 'entity', array(
            'class' => 'PqrsBundle\Entity\Area',
            'property' => 'nombre'
        ));
        $builder->add('copia', 'text', array(
            'label' => 'Enviar copia a',
            'required' => false
        ));
        
        $builder->add('save', 'submit', array(
            'label' => 'Enviar',
            'attr' => array(
                'class' => "btn btn-primary",
            )
        ));
        $builder->add('cancel', 'button', array(
            'label' => 'Cancelar',
            'attr' => array(
                'onClick' => "window.history.back()",
                'class' => "btn btn-cancel",
            )
        ));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PqrsBundle\Entity\Respuesta',
        ));
    }
 
    public function getName()
    {
        return 'respuesta_pqrs_type';
    }

}
