<?php

namespace PqrsBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use PqrsBundle\Entity\Respuesta;


class AddEstadoSubscriber implements EventSubscriberInterface
{
    private $factory;

    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }

    private function addEstadoForm($form, $estado)
    {
        $estados = array(2 => 'Progreso', 3 => 'Solucionado', 4 => 'Comunicado');
        $form->add($this->factory->createNamed('estado', 'choice', array(
        //$form->add('estado', 'choice', array(
            //'choices'  => $estados,
            //'label' => 'Estado',
            'mapped' => false,
            'empty_value' => 'Elige un estado',
            'query_builder' => function (EntityRepository $repository) {
                //$qb = $repository->createQueryBuilder('estado');
                $qb[0] = array("id"=>2,"name"=>"Progreso","slug"=>"progreso");
                $qb[1] = array("id"=>3,"name"=>"Solucionado","slug"=>"solucionado");
                $qb[2] = array("id"=>4,"name"=>"Comunicado","slug"=>"comunicado");
                return json_encode($qb);
            }
        )));
        //));    
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }
        $estado = ($data->getComunicado()) ? $data->getEstado() : null ;
        $this->addEstadoForm($form, $estado);
    }

    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }
        $estado = array_key_exists('estado', $data) ? $data['estado'] : null;
        //$estado = 4;
        $this->addEstadoForm($form, $estado);
    }
}