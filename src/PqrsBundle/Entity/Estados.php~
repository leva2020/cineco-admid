<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\EstadosRepository")
 * @ORM\Table(name="estados")
 */
class Estados
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
    protected $id_estado;

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
     * @return Estados
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
     * Set id_estado
     *
     * @param integer $idEstado
     * @return Estados
     */
    public function setIdEstado($idEstado)
    {
        $this->id_estado = $idEstado;

        return $this;
    }

    /**
     * Get id_estado
     *
     * @return integer 
     */
    public function getIdEstado()
    {
        return $this->id_estado;
    }
}
