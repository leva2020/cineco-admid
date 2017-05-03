<?php

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;



$definition = new Definition('PqrsBundle\Admin\UsuarioAdmin', array('PqrsBundle\Entity\Usuario'));
$definition->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Crear usuario'));
$definition->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.usuario', $definition);

$definition_1 = new Definition('PqrsBundle\Admin\AreaAdmin', array('PqrsBundle\Entity\Area'));
$definition_1->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Crear area'));
$definition_1->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.area', $definition_1);

$definition_2 = new Definition('PqrsBundle\Admin\RolesAdmin', array('PqrsBundle\Entity\Roles'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Crear Roles'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.roles', $definition_2);

$definition_2 = new Definition('PqrsBundle\Admin\PermisosAdmin', array('PqrsBundle\Entity\Permisos'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Crear Permisos'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.permisos', $definition_2);

$definition_2 = new Definition('PqrsBundle\Admin\PortalAdmin', array('PqrsBundle\Entity\Portal'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Crear Portal'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.portal', $definition_2);

$definition_2 = new Definition('PqrsBundle\Admin\VariablesGlobalesAdmin', array('PqrsBundle\Entity\VariablesGlobales'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Crear Variables Globales'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.variablesglobales', $definition_2);

$definition_2 = new Definition('PqrsBundle\Admin\CopiasAdmin', array('PqrsBundle\Entity\Copias'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Ingresar correos para copias'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.copias', $definition_2);

$definition_2 = new Definition('PqrsBundle\Admin\CausasAdmin', array('PqrsBundle\Entity\Causas'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Ingresar causas'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.causas', $definition_2);

$definition_2 = new Definition('PqrsBundle\Admin\MultiplexAdmin', array('PqrsBundle\Entity\Multiplex'));
$definition_2->addTag('sonata.admin', array('manager_type' => 'orm', 'group' => 'Content', 'label' => 'Ingresar Teatros'));
$definition_2->addMethodCall('setTranslationDomain', array(new Reference('PqrsBundle')));
$container->setDefinition('sonata.admin.multiplex', $definition_2);

