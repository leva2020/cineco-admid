<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\LogErrorRepository")
 * @ORM\Table(name="log_error")
 */
class LogError
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
    protected $fecha;
    
    /**
     * @ORM\Column(type="string", length=1000)
     */
    protected $adjunto;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $pqrs;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $respuesta;

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
     * Set fecha
     *
     * @param string $fecha
     * @return LogError
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set adjunto
     *
     * @param string $adjunto
     * @return LogError
     */
    public function setAdjunto($adjunto)
    {
        $this->adjunto = $adjunto;

        return $this;
    }

    /**
     * Get adjunto
     *
     * @return string 
     */
    public function getAdjunto()
    {
        return $this->adjunto;
    }

    /**
     * Set pqrs
     *
     * @param integer $pqrs
     * @return LogError
     */
    public function setPqrs($pqrs)
    {
        $this->pqrs = $pqrs;

        return $this;
    }

    /**
     * Get pqrs
     *
     * @return integer 
     */
    public function getPqrs()
    {
        return $this->pqrs;
    }

    /**
     * Set respuesta
     *
     * @param integer $respuesta
     * @return LogError
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return integer 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }
}
