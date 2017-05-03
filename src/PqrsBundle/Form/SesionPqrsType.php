<?php

namespace PqrsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;


class SesionPqrsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', 'text', array(
            'label' => 'Usuario'
        ));
        $builder->add('password', 'password', array(
            'label' => 'Contraseña'
        ));
        
        $builder->add('save', 'submit', array(
            'label' => 'Enviar',
            'attr' => array('class' => 'btn btn-primary')
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'PqrsBundle\Entity\Usuario',
        ));
    }

    public function getName() {
        return 'sesion_pqrs_type';
    }

}
