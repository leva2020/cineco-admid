<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use PqrsBundle\Entity\Usuario;
use PqrsBundle\Form\SesionPqrsType;
use PqrsBundle\Form\PasswordType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class SesionController extends Controller {

    public function loginAction(Request $request) {
        $session = $request->getSession();

        if ($session->get('name')):
            return $this->redirectToRoute('pqrs_home');
        endif;

        $em = $this->getDoctrine()->getManager();
        $form_sesion = new Usuario();
        $form = $this->createForm(new SesionPqrsType($em), $form_sesion);
        $form->handleRequest($request);
        if ($form->isValid()):
            $username = $_POST['sesion_pqrs_type']['username'];
            $password = $_POST['sesion_pqrs_type']['password'];
            $permisos_nombre = array();
            $user = $em->getRepository('PqrsBundle:Usuario')->findBy(array(
                'username' => $username,
            ));

            if ($user):
                $pass = $user[0]->getPassword();
                $salt = $user[0]->getSalt();
                $uniqid = $this->getRequest()->query->get('uniqid');
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $password = $encoder->encodePassword($password, $salt);
                if ($pass == $password):
                    $datos_usuario['correo'] = $user[0]->getCorreo();
                    $datos_usuario['nombre'] = $user[0]->getNombre();
                    $datos_usuario['firma'] = $user[0]->getFirma();

                    foreach ($user[0]->getPortales() as $por):
                        $datos_usuario['portales'][] = $por->getId();
                    endforeach;
                    foreach ($user[0]->getMultiplex() as $mul):
                        $datos_usuario['multiplex'][] = $mul->getId();
                    endforeach;
                    foreach ($user[0]->getArea() as $ar):
                        $datos_usuario['areas'][] = $ar->getId();
                        $datos_usuario['nombresareas'][] = $ar->getNombre();
                    endforeach;

                    foreach ($user[0]->getRoles() as $rol):
                        //$id_roles[] = $rol->getId();
                        //$roles = $this->getDoctrine()->getManager()->getRepository('PqrsBundle:Roles')->find($rol->getId());
                        $datos_usuario['roles'][] = $rol->getNombre();
                        $permisos = $rol->getPermisos();
                        foreach ($permisos as $per):
                            $permisos_id[] = $per->getId();
                            $datos_usuario['permisos_nombres'][] = $per->getNombre();
                        endforeach;
                    endforeach;
                    $session->start();
                    $session->set('name', $username);
                    $session->set('tokens', $datos_usuario);
                    return $this->redirectToRoute('pqrs_home');
                else:
                    $this->get('session')->getFlashBag()->add(
                            'error', 'Datos incorrectos'
                    );
                endif;
            else:
                $this->get('session')->getFlashBag()->add(
                        'error', 'El usuario aun no se encuentra registrado.'
                );
            endif;
        endif;

        $usuario = '';
        if ($session->get('name')):
            $usuario = $session->get('name');
        endif;
        return $this->render('PqrsBundle:Sesion:login.html.twig', array(
                    'form' => $form->createView(),
                    'usuario' => $usuario
        ));
    }

    public function logoutAction(Request $request) {
        $session = $request->getSession();
        $session->invalidate();
        return $this->redirectToRoute('login');
    }

    public function passwordAction(Request $request) {
        $session = $request->getSession();
        if (!$session->get('name')) {
            return $this->redirectToRoute('pqrs_home');
        }
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
                ->add('password', 'password', array(
                    'required' => true,
                    'label' => 'Contraseña actual'
                ))
                ->add('password_0', 'password', array(
                    'required' => true,
                    'label' => 'Nueva contraseña'
                ))
                ->add('password_1', 'password', array(
                    'required' => true,
                    'label' => 'Repita su contraseña'
                ))
                ->add('save', 'submit', array(
                    'label' => 'Cambiar',
                    'attr' => array(
                        'class' => 'btn btn-primary',
                    )
                ))
                ->getForm();
        $user = $em->getRepository('PqrsBundle:Usuario')->findBy(array('username' => $session->get('name')));
        $user_em = $this->getDoctrine()->getManager();
        $user_em->persist($user[0]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($user) {
                $salt_1 = md5(time());
                $pass = $user[0]->getPassword();
                $password = $_POST['form']['password'];
                $salt = $user[0]->getSalt();
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $password = $encoder->encodePassword($password, $salt);
                if ($pass == $password) {
                    if ($_POST['form']['password_0'] == $_POST['form']['password_1']) {
                        $user[0]->setPassword($encoder->encodePassword($_POST['form']['password_0'], $salt_1));
                        $user[0]->setSalt($salt_1);
                        $user_em->persist($user[0]);
                        $user_em->flush();
                        $this->get('session')->getFlashBag()->add(
                                'error', 'La contraseña fue actualizada con exito!'
                        );
                    } else {
                        $this->get('session')->getFlashBag()->add(
                                'error', 'Las contraseñas no son iguales'
                        );
                    }
                } else {
                    $this->get('session')->getFlashBag()->add(
                            'error', 'La contraseña no es la registrada'
                    );
                }
            }
        }
        return $this->render('PqrsBundle:Sesion:password.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
