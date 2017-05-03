<?php

namespace PqrsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Sonata\AdminBundle\Datagrid\ORM\ProxyQuery;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UsuarioAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('nombre', 'text', array('label' => 'Nombre'))
                ->add('username', 'text', array('label' => 'UserName'))
                ->add('documento', 'text', array('label' => 'Documento'))
                ->add('correo', 'email', array('label' => 'Correo'))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'first_options' => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repite la contraseña'),
                    'invalid_message' => 'Las contraseñas no coinciden',
                    'required' => false,
                ))
                ->add('area', 'entity', array(
                    'class' => 'PqrsBundle\Entity\Area',
                    'multiple' => true,
                    'property' => 'nombre'
                ))
                ->add('portales', 'entity', array(
                    'class' => 'PqrsBundle\Entity\Portal',
                    'multiple' => true,
                    'property' => 'nombre'
                ))
                ->add('roles', 'entity', array(
                    'class' => 'PqrsBundle\Entity\Roles',
                    'property' => 'nombre',
                    'multiple' => true,
                    'label' => 'Roles'
                ))
                ->add('multiplex', 'entity', array(
                    'class' => 'PqrsBundle\Entity\Multiplex',
                    'property' => 'nombre',
                    'multiple' => true,
                    'label' => 'Multiplex',
                    'required' => false,
                ))
                ->add('firma', 'textarea', array(
                    'label' => 'Firma Correo',
                    'required' => false,
                ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('username')
                ->add('nombre')
                ->add('documento')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('username')
                ->add('nombre')
                ->add('documento')
        ;
    }

    public function preUpdate($object) {
        $salt = md5(time());
        $uniqid = $this->getRequest()->query->get('uniqid');
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $formData = $this->getRequest()->request->get($uniqid);
        if (array_key_exists('password', $formData) && $formData['password'] !== null && strlen($formData['password']['first']) > 0) {
            $object->setPassword($encoder->encodePassword($formData['password']['first'], $salt));
            $object->setSalt($salt);
        }
    }

    public function prePersist($object) {
        $salt = md5(time());
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $uniqid = $this->getRequest()->query->get('uniqid');
        $formData = $this->getRequest()->request->get($uniqid);
        if (array_key_exists('password', $formData) && $formData['password'] !== null && strlen($formData['password']['first']) > 0) {
            $object->setPassword($encoder->encodePassword($formData['password']['first'], $salt));
            $object->setSalt($salt);
        }
    }

    public function validate(ErrorElement $errorElement, $user_name) {
        $url = $_SERVER["REQUEST_URI"];
        $editar = strpos($url, '/edit');
        if($editar === false):
            $repetido = $this->getModelManager()
                    ->findBy('PqrsBundle:Usuario', array('username' => $user_name->getUsername()));
            if (count($repetido) > 0):
                $errorElement->with('username')
                        ->addViolation('Este username ya se encuentra registrado, utilice otro')
                        ->end();
            endif;
        endif;
    }
}
