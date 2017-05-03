<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\CausasRepository")
 * @ORM\Table(name="causas")
 */
class Causas
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
    protected $causa;
        
    /**
     * @ORM\ManyToMany(targetEntity="Respuesta", mappedBy="causa")
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
     * Set causa
     *
     * @param string $causa
     * @return Causas
     */
    public function setCausa($causa)
    {
        $this->causa = $causa;

        return $this;
    }

    /**
     * Get causa
     *
     * @return string 
     */
    public function getCausa()
    {
        return $this->causa;
    }

    /**
     * Add respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     * @return Causas
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
