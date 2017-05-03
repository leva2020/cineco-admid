<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\TipoComunicacionRepository")
 * @ORM\Table(name="tipo_comunicacion")
 */
class TipoComunicacion
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
    protected $id_comunicacion;

    

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
     * @return TipoComunicacion
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
     * Set id_comunicacion
     *
     * @param integer $idComunicacion
     * @return TipoComunicacion
     */
    public function setIdComunicacion($idComunicacion)
    {
        $this->id_comunicacion = $idComunicacion;

        return $this;
    }

    /**
     * Get id_comunicacion
     *
     * @return integer 
     */
    public function getIdComunicacion()
    {
        return $this->id_comunicacion;
    }
}
