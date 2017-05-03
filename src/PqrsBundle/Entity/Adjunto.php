<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\AdjuntoRepository")
 * @ORM\Table(name="adjunto")
 */
class Adjunto
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @ORM\Column(type="string")
     */
    protected $tipo;


    /**
     * @ORM\ManyToOne(targetEntity="Respuesta", inversedBy="adjuntos")
     * @ORM\JoinColumn(name="respuesta_id", referencedColumnName="id")
     **/
    private $respuesta;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pqrs", inversedBy="adjuntos_pqrs")
     * @ORM\JoinColumn(name="pqrs_id", referencedColumnName="id", nullable=TRUE)
     **/
    private $pqrs;

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
     * Set url
     *
     * @param integer $url
     * @return Adjunto
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return integer 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Adjunto
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     * @return Adjunto
     */
    public function setRespuesta(\PqrsBundle\Entity\Respuesta $respuesta = null)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return \PqrsBundle\Entity\Respuesta 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $pqrs
     * @return Adjunto
     */
    public function setPqrs(\PqrsBundle\Entity\Pqrs $pqrs = null)
    {
        $this->pqrs = $pqrs;

        return $this;
    }

    /**
     * Get pqrs
     *
     * @return \PqrsBundle\Entity\Pqrs 
     */
    public function getPqrs()
    {
        return $this->pqrs;
    }
}
