<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\MultiplexRepository")
 * @ORM\Table(name="multiplex")
 */
class Multiplex
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
     * @ORM\Column(type="integer")
     */
    protected $id_multiplex;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="multiplex")
     **/
    protected $usuario;
    

    
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return Multiplex
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
     * Set id_multiplex
     *
     * @param integer $idMultiplex
     * @return Multiplex
     */
    public function setIdMultiplex($idMultiplex)
    {
        $this->id_multiplex = $idMultiplex;

        return $this;
    }

    /**
     * Get id_multiplex
     *
     * @return integer 
     */
    public function getIdMultiplex()
    {
        return $this->id_multiplex;
    }

    /**
     * Add usuario
     *
     * @param \PqrsBundle\Entity\Usuario $usuario
     * @return Multiplex
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
