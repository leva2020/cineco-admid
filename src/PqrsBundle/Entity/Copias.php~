<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\CopiasRepository")
 * @ORM\Table(name="copias")
 */
class Copias
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
    protected $correo;
        
    /**
     * @ORM\ManyToMany(targetEntity="Respuesta", mappedBy="copia")
     **/
    private $respuesta;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->respuesta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set correo
     *
     * @param string $correo
     * @return Copias
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
     * Add respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     * @return Copias
     */
    public function addRespuestum(\PqrsBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     */
    public function removeRespuestum(\PqrsBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta->removeElement($respuesta);
    }

    /**
     * Get respuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }
}
