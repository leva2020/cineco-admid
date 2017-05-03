<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\RolesRepository")
 * @ORM\Table(name="roles")
 */
class Roles
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
     * @ORM\ManyToMany(targetEntity="Permisos", inversedBy="roles", cascade={"persist"})
     * @ORM\JoinTable(name="permisos_roles")
     **/
    protected $permisos;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="roles")
     **/
    protected $usuario;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permisos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Roles
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
     * Add permisos
     *
     * @param \PqrsBundle\Entity\Permisos $permisos
     * @return Roles
     */
    public function addPermiso(\PqrsBundle\Entity\Permisos $permisos)
    {
        $this->permisos[] = $permisos;

        return $this;
    }

    /**
     * Remove permisos
     *
     * @param \PqrsBundle\Entity\Permisos $permisos
     */
    public function removePermiso(\PqrsBundle\Entity\Permisos $permisos)
    {
        $this->permisos->removeElement($permisos);
    }

    /**
     * Get permisos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * Add usuario
     *
     * @param \PqrsBundle\Entity\Usuario $usuario
     * @return Roles
     */
    public function addUsuario(\PqrsBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \PqrsBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\PqrsBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
