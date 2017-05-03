<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\UsuarioRepository")
 * @ORM\Table(name="usuario")
 */
class Usuario
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $correo;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $documento;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;
    
    /**
     * @ORM\ManyToMany(targetEntity="Area", inversedBy="usuarios", cascade={"persist"})
     * @ORM\JoinTable(name="usuarios_areas")
     **/
    private $area;

    /**
     * @ORM\ManyToMany(targetEntity="Roles", inversedBy="usuario", cascade={"persist"})
     * @ORM\JoinTable(name="usuarios_roles")
     **/
    private $roles;
    
    /**
     * @ORM\ManyToMany(targetEntity="Multiplex", inversedBy="usuario", cascade={"persist"})
     * @ORM\JoinTable(name="usuarios_multiplex")
     **/
    private $multiplex;
    
    /**
     * @ORM\ManyToMany(targetEntity="Portal", inversedBy="usuarios", cascade={"persist"})
     * @ORM\JoinTable(name="usuarios_portales")
     **/
    protected $portales;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $salt;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=TRUE))
     */
    protected $firma;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->area = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->multiplex = new \Doctrine\Common\Collections\ArrayCollection();
        $this->portales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set correo
     *
     * @param string $correo
     * @return Usuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set documento
     *
     * @param integer $documento
     * @return Usuario
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return integer 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set firma
     *
     * @param string $firma
     * @return Usuario
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return string 
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Add area
     *
     * @param \PqrsBundle\Entity\Area $area
     * @return Usuario
     */
    public function addArea(\PqrsBundle\Entity\Area $area)
    {
        $this->area[] = $area;

        return $this;
    }

    /**
     * Remove area
     *
     * @param \PqrsBundle\Entity\Area $area
     */
    public function removeArea(\PqrsBundle\Entity\Area $area)
    {
        $this->area->removeElement($area);
    }

    /**
     * Get area
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Add roles
     *
     * @param \PqrsBundle\Entity\Roles $roles
     * @return Usuario
     */
    public function addRole(\PqrsBundle\Entity\Roles $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \PqrsBundle\Entity\Roles $roles
     */
    public function removeRole(\PqrsBundle\Entity\Roles $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add multiplex
     *
     * @param \PqrsBundle\Entity\Multiplex $multiplex
     * @return Usuario
     */
    public function addMultiplex(\PqrsBundle\Entity\Multiplex $multiplex)
    {
        $this->multiplex[] = $multiplex;

        return $this;
    }

    /**
     * Remove multiplex
     *
     * @param \PqrsBundle\Entity\Multiplex $multiplex
     */
    public function removeMultiplex(\PqrsBundle\Entity\Multiplex $multiplex)
    {
        $this->multiplex->removeElement($multiplex);
    }

    /**
     * Get multiplex
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMultiplex()
    {
        return $this->multiplex;
    }

    /**
     * Add portales
     *
     * @param \PqrsBundle\Entity\Portal $portales
     * @return Usuario
     */
    public function addPortale(\PqrsBundle\Entity\Portal $portales)
    {
        $this->portales[] = $portales;

        return $this;
    }

    /**
     * Remove portales
     *
     * @param \PqrsBundle\Entity\Portal $portales
     */
    public function removePortale(\PqrsBundle\Entity\Portal $portales)
    {
        $this->portales->removeElement($portales);
    }

    /**
     * Get portales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortales()
    {
        return $this->portales;
    }
}
