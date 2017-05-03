<?php

namespace PqrsBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use PqrsBundle\Entity\Respuesta;


class AddComunicacionSubscriber implements EventSubscriberInterface
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

    private function addComunicacionForm($form, $estado)
    {
        var_dump($estado);
        //if($estado == 4):
            $form->add($this->factory->createNamed('comunicado', 'choice', array(
                /*'label'    => 'Comunicado',
                'empty_value'   => 'Comunicacion',
                'choices' => array(0 => 'Sin comunicar', 1 => 'Comunicado'),
                'preferred_choices' => array(0),*/
                'query_builder' => function (EntityRepository $repository) use ($estado) {
                    $qb = $repository->createQueryBuilder('comunicado');
                   if (is_numeric($estado)) {
                        $qb->where('estado.id = :estado')
                        ->setParameter('estado', $estado);
                    } else {
                        $qb->where('estado.name = :estado')
                        ->setParameter('estado', null);
                    }
                    return $qb;
                }
            )));
        //endif;
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }
        //print '<pre>';var_dump($data);print '</pre>';
        $estado = ($data->getComunicado()) ? $data->getEstado() : null ;
        $this->addComunicacionForm($form, $estado);
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
        $this->addComunicacionForm($form, $estado);
    }
}