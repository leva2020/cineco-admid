<?php

namespace PqrsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use PqrsBundle\Form\EventListener\AddComunicacionSubscriber;
use PqrsBundle\Form\EventListener\AddEstadoSubscriber;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;

class RespuestaPqrsType extends AbstractType {
    
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $session = new Session();
        $tokens = $session->get('tokens');
        $permisos = $tokens['permisos_nombres'];
        $areas = $tokens['areas'];
        if (in_array('COMUNICAR', $permisos)):
            $estados = array(2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado');
            $comun = true;
        else:
            $estados = array(2 => 'Progreso', 3 => 'Solucionado');
            $comun = false;
        endif;
        $builder->add('respuesta', null, array(
            'label' => 'Respuesta',
            'attr' => array('style'=> 'height: 367px; width:960px;'),
        ));
        if ($comun || (in_array(1, $areas))):
            $builder->add('causa', 'entity', array(
                'class' => 'PqrsBundle\Entity\Causas',
                'label' => 'Causas',
                'property' => 'causa',
                'multiple' => true,
                'required' => false,
                'attr' => array(
                    'hidden' => true,
                    'value' => 'Transporte',
                )
            ));
        endif;
        $builder->add('estado', 'choice', array(
            'choices' => $estados,
            'label' => 'Estado',
        ));
        if ($comun):
            $builder->add('comunicado', 'choice', array(
                'label' => 'Comunicado',
                'choices' => array(1 => 'ENVIAR AL CLIENTE', 0 => 'NO ENVIAR AL CLIENTE'),
                'preferred_choices' => array(0),
            ));

            $builder->add('comunicacion_previa', 'checkbox', array(
                'label' => 'Comunicación previa',
                'required' => false
            ));
        endif;
        $builder->add('area', 'entity', array(
            'required' => true,
            'class' => 'PqrsBundle:Area',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                                ->orderBy('u.nombre', 'ASC');
            },
            'preferred_choices' => array($this->em->getReference("PqrsBundle:Area", $areas[0])),
            'property' => 'nombre',
            'label' => 'Área'            
        ));

        $builder->add('copia', 'entity', array(
            'class' => 'PqrsBundle\Entity\Copias',
            'label' => 'Enviar copia a',
            'property' => 'correo',
            'multiple' => true,
            'required' => false,
            'attr' => array('hidden' => true)
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'PqrsBundle\Entity\Respuesta',
        ));
    }

    public function getName() {
        return 'respuesta_pqrs_type';
    }

}
