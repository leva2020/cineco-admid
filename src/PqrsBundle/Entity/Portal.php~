<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\PortalRepository")
 * @ORM\Table(name="portal")
 */
class Portal
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $dominio;
    
    /**
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="portales")
     **/
    protected $usuarios;
    
    /**
     * @ORM\OneToMany(targetEntity="Pqrs", mappedBy="portal")
     */
    protected $portal_pqrs;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Portal
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add usuarios
     *
     * @param \PqrsBundle\Entity\Usuario $usuarios
     * @return Portal
     */
    public function addUsuario(\PqrsBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \PqrsBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\PqrsBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add portal_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $portalPqrs
     * @return Portal
     */
    public function addPortalPqr(\PqrsBundle\Entity\Pqrs $portalPqrs)
    {
        $this->portal_pqrs[] = $portalPqrs;

        return $this;
    }

    /**
     * Remove portal_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $portalPqrs
     */
    public function removePortalPqr(\PqrsBundle\Entity\Pqrs $portalPqrs)
    {
        $this->portal_pqrs->removeElement($portalPqrs);
    }

    /**
     * Get portal_pqrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortalPqrs()
    {
        return $this->portal_pqrs;
    }

    /**
     * Set dominio
     *
     * @param string $dominio
     * @return Portal
     */
    public function setDominio($dominio)
    {
        $this->dominio = $dominio;

        return $this;
    }

    /**
     * Get dominio
     *
     * @return string 
     */
    public function getDominio()
    {
        return $this->dominio;
    }

    /**
     * Set portal_pqrs
     *
     * @param integer $portalPqrs
     * @return Portal
     */
    public function setPortalPqrs($portalPqrs)
    {
        $this->portal_pqrs = $portalPqrs;

        return $this;
    }
}
